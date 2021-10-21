<?php

namespace App\Http\Responders;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

class JsonResponder
{
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function response($data = [], int $error_code = 200, ?array $error_messages = null): JsonResponse
    {
        return $this->responseFactory->json([
            'data' => $data,
            'error_messages' => $error_messages,
        ], $error_code);
    }
}
