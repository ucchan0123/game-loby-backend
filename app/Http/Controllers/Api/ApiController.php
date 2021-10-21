<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responders\JsonResponder;

class ApiController extends Controller
{
    protected $responder;

    public function __construct(JsonResponder $responder)
    {
        $this->responder = $responder;
    }
}
