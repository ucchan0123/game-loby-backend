<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordResetNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'nick_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last_accessed_at' => 'datetime'
    ];

    protected $appends = [
        'is_online'
    ];

//     public function sendPasswordResetNotification($token)
//     {
//         $this->notify(new PasswordResetNotification($token));
//     }

//     public function googleTwoFactor()
// {
//     return $this->hasOne(GoogleTwoFactor::class);
// }

//     public static function userCreate($name, $email, $password, $nick_name = null)
//     {
//         return self::create([
//             'name' =>  $name,
//             'nick_name' =>  $nick_name,
//             'email' => $email,
//             'password' => Hash::make($password),
//         ]);
//     }

//     public static function findByEmail($email)
//     {
//         return self::where('email', $email)->first();
//     }

//     public static function changePassword($user_id, $password)
//     {
//         self::find($user_id)->fill([
//             'password' => Hash::make($password)
//         ])->save();
//     }

//     public static function changeInfo($user_id, $name, $nick_name, $email)
//     {
//         $user_info = self::find($user_id);
//         $user_info->name = $name;
//         $user_info->nick_name = $nick_name;
//         $user_info->email = $email;
//         $user_info->save();
//         return $user_info;
//     }

    // Accessor
    public function getIsOnlineAttribute() { // 👈 ここを追加しました

        $last_accessed_at = $this->last_accessed_at;

        return (
            !is_null($last_accessed_at) &&
            now()->diffInMinutes($last_accessed_at) <= 15 // 最終アクセスが15分以内の場合
        );

    }
}
