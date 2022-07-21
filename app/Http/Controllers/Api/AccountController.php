<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\AccountChangeEmailRequest;
use App\Http\Requests\AccountChangeNameRequest;
use App\Http\Requests\AccountChangeNicknameRequest;
use App\Http\Requests\AccountChangePasswordRequest;
use App\Http\Requests\AccountChangeModeRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\User;
use App\Models\EmailUpdate;
use App\Mail\BaseMail;

class AccountController extends ApiController
{
    public function getUser()
    {
        return $this->responder->response(User::findById(Auth::id()));
    }

    public function getUsers()
    {
        return $this->responder->response(User::all());
    }

    // public function confirmEmail(AccountChangeEmailRequest $request)
    // {
    //     DB::transaction(function () use ($request) {
    //         $user = Auth::user();
    //         $now = Carbon::now();
    //         $token = Str::random(32);

    //         EmailUpdate::createEmailUpdate(
    //             $user->id,
    //             $user->email,
    //             $request->email,
    //             $token,
    //             $now
    //         );

    //         Mail::send(
    //             new BaseMail(
    //                 $user->email,
    //                 __('mail.confirmation_mail.subject'),
    //                 'mail.confirmation_mail',
    //                 [
    //                     'user_name' => $user->name,
    //                     'action_url' => config('app.members_url') . '/account/confirm-email/' . $token,
    //                 ]
    //             ),
    //         );
    //     });
    //     return $this->responder->response();
    // }

    // public function changeEmail(Request $request, $confirmation_token)
    // {
    //     $email_update = EmailUpdate::findByToken($confirmation_token);
    //     if (! $email_update) {
    //         return $this->responder->response([], 200, [__('auth.invalid_change_mail_token')]);
    //     }

    //     User::changeEmail($request->user(), $email_update->new_email);
    //     return $this->getUser();
    // }

    // public function changeName(AccountChangeNameRequest $request)
    // {
    //     User::changeName($request->user(), $request->name);
    //     return $this->getUser();
    // }

    // public function changeNickname(AccountChangeNicknameRequest $request)
    // {
    //     User::changeNickname($request->user(), $request->nickname);
    //     return $this->getUser();
    // }

    // public function changePassword(AccountChangePasswordRequest $request)
    // {
    //     User::changePassword($request->user(), $request->password);
    //     return $this->responder->response();
    // }

    // public function changeMode(AccountChangeModeRequest $request)
    // {
    //     User::changeMode($request->user(), $request->display_mode);
    //     return $this->responder->response();
    // }
}
