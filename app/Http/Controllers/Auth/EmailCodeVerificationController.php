<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmailCodeVerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.verify-code');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->code)
                    ->first();

        if (! $user) {
            return back()->withErrors(['code' => 'Invalid verification code or email.']);
        }

        $user->update([
            'is_verified' => true,
            'verification_code' => null,
        ]);

        Auth::login($user);

        return redirect()->intended(route('frontend.index'));
    }
}
