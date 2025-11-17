<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Mail\EmailVerificationCodeMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use ValidatesRequests;
    /**
     * Display the login view.
     */
    public function create(): View
    {   
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $input = $request->all();

        $this->validate($request, [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        
        // Check if input is email or phone number
        $login_type = filter_var($input['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // Try to login with email or phone
        if (auth()->attempt([$login_type => $input['email'], 'password' => $input['password']])) {
            $user = auth()->user();

            if (!$user->is_verified) {
                auth()->logout();

                $verificationCode = rand(100000, 999999);
                $user->update(['verification_code' => $verificationCode]);

                Mail::to($user->email)->send(new \App\Mail\EmailVerificationCodeMail($user));

                return redirect()->route('verification.code.form')
                    ->with('email', $input['email'])
                    ->with('error', 'Please verify your email first by entering the verification code.');
            }

            // Role-wise redirect
            if ($user->role_id == 1) {
                session(['superadmin_login' => 1]);
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->role_id == 3) {
                return redirect()->intended(route('frontend.index'));
            }

        } else {
            return redirect()->back()->with('error', 'Email/Phone or Password is incorrect.')->withInput();
        }
    }

    
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
