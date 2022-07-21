<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserAccessed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogAuthenticated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $user = $event->user;

        if(!$user->is_online) { // 👈 最終アクセスが15分より前の場合

            UserAccessed::dispatch(); // 👈 ここでイベントを実行しています

        }

        $user->last_accessed_at = now(); // 👈 アクセス日時を更新
        $user->save();
    }
}
