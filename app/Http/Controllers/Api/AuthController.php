<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\UserAccount;
use App\Models\UserToken;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'access_token' => 'required',
        ]);

        $userEmail = $this->getMicrosoftUser($request->access_token)->getEmail();

        $user = UserAccount::where('plm_email_address', $userEmail)->first();

        if (!$user) {
            return response()->json([
                'message' => 'No user account is available for your email address'
            ], 404);
        }

        do {
            $randomToken = Str::random(64);
        } while (UserToken::where('user_session_token', $randomToken)->first());

        $userToken = UserToken::create([
            'user_account_id' => $user->user_account_id,
            'user_session_token' => $randomToken,
            'last_used' => now()
        ]);

        $roles = $user->roles->map(function ($role) {
            return [
                'id' => $role->role_id,
                'name' => $role->role_name,
            ];
        })->toArray();

        $cookie = Cookie::make(
            'CRS-API-SESSION-TOKEN',
            $userToken->user_session_token,
            60
        )->withSameSite('None')->withSecure(true);
        
        return response()->json([
            'message' => 'Successful login',
            'user' => $user->plm_email_address,
            'roles' => $roles,
        ])->cookie($cookie);
    }

    public function logout() {
        $sessionToken = Cookie::get('CRS-API-SESSION-TOKEN');

        if($sessionToken) {
            $userToken = UserToken::where('user_session_token', $sessionToken)->first();

            if($userToken) {
                $userToken->delete();
            }
        }

        return response()->json([
            'message' => 'Successful logout'
        ])->withCookie(Cookie::forget('CRS-API-SESSION-TOKEN'));
    }

    protected function getMicrosoftUser($accessToken)
    {
        return Socialite::driver('azure')->userFromToken($accessToken);
    }
}
