<?php

namespace App\Utilities;

class JsonResponseUtility
{
    /**
     * JSONレスポンスの取得
     * @param $data 付属データ
     */
    public static function getJsonResponse($data = [], ?int $error_code = 200, ?array $error_messages = null)
    {
        return response()->json(
            [
                'data' => $data,
                'error_messages' => $error_messages,
            ],
            $error_code, [], JSON_UNESCAPED_UNICODE
        );
    }
}
