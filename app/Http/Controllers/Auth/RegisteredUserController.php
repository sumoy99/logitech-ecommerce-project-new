<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\EmailVerificationCodeMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());

    //     }

    //      // Generate a unique referral code
    //     do {
    //         $referralCode = Str::upper(Str::random(8));
    //     } while (User::where('referral_code', $referralCode)->exists());

    //     $user = User::create([
    //         'name' => $request->name,
    //         'role_id' => $request->role_id,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'referral_code' => $referralCode,
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect()->intended(route('frontend.index'));
    // }


    public function store(Request $request): RedirectResponse
    {  
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'lowercase'],
            'phone_number' => ['required'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            if ($existingUser->is_verified) {
                return redirect()->back()->withErrors(['email' => 'This email is already registered.'])->withInput();
            } else {
                $verificationCode = rand(100000, 999999);
                $existingUser->update([
                    'name' => $request->name,
                    'role_id' => $request->role_id,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                    'verification_code' => $verificationCode,
                ]);

                session(['redirect_after_verify' => url()->previous()]);

                Mail::to($existingUser->email)->send(new \App\Mail\EmailVerificationCodeMail($existingUser));

                return redirect()->route('verification.code.form')->with('email', $existingUser->email);
            }
        }

        //  Generate referral code
        do {
            $referralCode = Str::upper(Str::random(8));
        } while (User::where('referral_code', $referralCode)->exists());

        $verificationCode = rand(100000, 999999);

        // ✅ Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
            'referral_code' => $referralCode,
            'verification_code' => $verificationCode,
            'is_verified' => false,
        ]);

        session(['redirect_after_verify' => url()->previous()]);

        Mail::to($user->email)->send(new \App\Mail\EmailVerificationCodeMail($user));

        return redirect()->route('verification.code.form')->with('email', $user->email);
    }




}
