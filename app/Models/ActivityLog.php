<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'details',
        'ip_address',
        'user_agent',
    ];

    /**
     * ログインのログを記録する
     */
    public static function recordLogin($user_id)
    {
        return self::newLog($user_id, 'Login');
    }

    /**
     * ログアウトのログを記録する
     */
    public static function recordLogout($user_id)
    {
        return self::newLog($user_id, 'Logout');
    }

    /**
     * メールアドレス変更確認メール送信のログを記録する
     */
    public static function recordSentEmailUpdate($user_id, $old_email, $new_email)
    {
        return self::newLog(
            $user_id,
            'SentEmailUpdate',
            "{$old_email} -> {$new_email}",
        );
    }

    /**
     * メールアドレス変更のログを記録する
     */
    public static function recordEmailUpdate($user_id, $old_email, $new_email)
    {
        return self::newLog(
            'EmailUpdate',
            "{$old_email} -> {$new_email}",
            $user_id
        );
    }

    /**
     * 新規ログの登録
     */
    private static function newLog($user_id, $action, $details = null)
    {
        return self::create([
            'user_id' => $user_id,
            'action' => $action,
            'details' => $details,
            'ip_address' => Request::ip(),
            'user_agent' => self::getUserAgent()
        ]);
    }

    /**
     * ユーザーエージェントの取得
     */
    private static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'No UserAgent';
    }
}
