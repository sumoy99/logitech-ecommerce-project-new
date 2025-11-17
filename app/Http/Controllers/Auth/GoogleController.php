<?php

// app/Http/Controllers/Auth/GoogleController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $imageUrl = $googleUser->getAvatar();
        $imageContents = file_get_contents($imageUrl);
        $filename = uniqid() . '.jpg';
        $path = public_path('assets/upload/user_image/' . $filename);
        file_put_contents($path, $imageContents);

        // Check if user exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Generate a unique referral code only for new users
            do {
                $referralCode = Str::upper(Str::random(8));
            } while (User::where('referral_code', $referralCode)->exists());
            
            // Create new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'image' => $filename,
                'referral_code' => $referralCode,
                'role_id' => 3,
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(16)),
                'is_verified' => 1,
            ]);
        } else {
            // Update existing user data but keep referral_code as is
            $user->update([
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'image' => $filename,
                'email_verified_at' => now(),
                'is_verified' => 1,
            ]);
        }

        Auth::login($user);

        return redirect()->intended('/');
    }

}

