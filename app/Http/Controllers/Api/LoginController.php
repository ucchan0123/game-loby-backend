<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Models\Activation;
use App\Http\Requests\LoginRequest;
use App\Utilities\JsonResponseUtility;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class LoginController extends ApiController
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // ログイン認証
        if (! Auth::attempt($credentials)) {
            return $this->responder->response([], 422, [__('auth.attempt_failed')]);
        }

        // メールアドレス認証チェック
        if ($request->user() instanceof MustVerifyEmail && ! $request->user()->hasVerifiedEmail()) {
            Auth::logout();
            return $this->responder->response([], 401, [__('auth.email_not_verified')]);
        }

        // ログインログを残す
        ActivityLog::recordLogin(Auth::id());

        return $this->responder->response();
    }

    public function logout()
    {
        // ログアウトログを残す
        ActivityLog::recordLogout(Auth::id());

        //ログアウト
        Auth::logout();

        return $this->responder->response();
    }
}
