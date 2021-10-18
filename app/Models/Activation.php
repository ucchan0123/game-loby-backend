<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Activation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * The activation expiration time, in seconds.
     */
    const EXPIRES = 864000;

    public static function activationCreate($user_id)
    {
        $code = self::generateActivationCode();

        return self::create([
            'user_id' => $user_id,
            'code' => $code,
        ]);
    }

    /**
     * アクティベーション済みか確認
     * @param int $user_id
     * @return bool
     */
    public static function completed($user_id)
    {
        return self::where('user_id', $user_id)->whereNotNull('completed_at')->exists();
    }

    /**
     * アクティベーション実行
     * @param int $user_id
     * @param string $activation_code
     * @return bool アクティベーション完了：true、失敗した場合：false
     */
    public static function complete($user_id, $activation_code)
    {
        $activation = self::where('user_id', $user_id)
            ->where('code', $activation_code)
            ->whereNull('completed_at')
            ->where('created_at', '>', self::expires())
            ->first();

        if (! $activation) {
            return false;
        }

        $activation->fill([
            'completed_at' => Carbon::now(),
        ]);

        $activation->save();

        return true;
    }

    private static function generateActivationCode(): string
    {
        return Str::random(32);
    }

    private static function expires(): Carbon
    {
        return Carbon::now()->subSeconds(self::EXPIRES);
    }
}
