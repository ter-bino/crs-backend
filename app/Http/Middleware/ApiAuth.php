<?php

namespace App\Http\Middleware;

use App\Models\UserAccount;
use App\Models\UserToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ApiAuth
{
    protected static $TOKEN_SESSION_MINUTE_DURATION = 60;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        if(!$request->cookie('CRS-API-SESSION-TOKEN')) {
            return response()->json(
                [
                    'message' => 'Unauthorized. Please login using your Office 365 account.'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        $userToken = UserToken::where('user_session_token', $request->cookie('CRS-API-SESSION-TOKEN'))->first();

        if(!$userToken) {
            return response()->json(
                [
                    'message' => 'Unauthorized. Your session token is invalid.'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        if(Carbon::now()->diffInMinutes(Carbon::parse($userToken->last_used)) > $this::$TOKEN_SESSION_MINUTE_DURATION) {
            return response()->json(
                [
                    'message' => 'Unauthorized. Your session token has expired.'
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $user = UserAccount::find($userToken->user_account_id);

        if(!$user) {
            return response()->json(
                [
                    'message'=> 'Unauthorized. Missing user account information.'
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        if ($role !== null && !$user->roles->pluck('role_name')->contains(strtoupper($role))) {
            return response()->json(
                [
                    'message' => 'Unauthorized. You do not have the appropriate permissions for this request.'
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        $userToken->last_used = now();
        $userToken->save();

        return $next($request);
    }
}
