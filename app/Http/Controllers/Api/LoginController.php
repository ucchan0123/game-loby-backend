<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Models\Activation;
use App\Http\Requests\LoginRequest;
use App\Utilities\JsonResponseUtility;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return JsonResponseUtility::getJsonResponse([], 422, [__('auth.attempt_failed')]);
        }

        // アクティベーションチェック
        if (! Activation::completed(Auth::id())) {
            Auth::logout();
            return JsonResponseUtility::getJsonResponse('validation', 422, [__('auth.activation_failed')]);
        }

        // ログインログを残す
        ActivityLog::recordLogin(Auth::id());

        return JsonResponseUtility::getJsonResponse();
    }

    public function logout()
    {
        // ログアウトログを残す
        ActivityLog::recordLogout(Auth::id());

        //ログアウト
        Auth::logout();

        return JsonResponseUtility::getJsonResponse();
    }
}
