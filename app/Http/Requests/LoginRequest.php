<?php

namespace App\Http\Requests;

use App\Utilities\ValidationRulesUtility;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(ValidationRulesUtility $rules)
    {
        return $rules->getRules([
            'email_exists',
            'password',
        ]);
    }
}
