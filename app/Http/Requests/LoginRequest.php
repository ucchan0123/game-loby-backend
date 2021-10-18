<?php

namespace App\Http\Requests;

use App\Utilities\ValidationRulesUtility;

class LoginRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ValidationRulesUtility::getRules([
            'email_exists',
            'password',
        ]);
    }
}
