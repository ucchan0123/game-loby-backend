<?php

namespace App\Utilities;

use Illuminate\Validation\Rule;
use App\Rules\PasswordCurrentRule;
use Illuminate\Support\Facades\Auth;

class ValidationRulesUtility
{
    private $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    private function rules(): array
    {
        return [
            'name'                      => [ 'name' => ['required', 'max:255'] ],
            'nick_name'                 => [ 'nick_name' => ['max:255'] ],
            'email'                     => [ 'email' => [ 'required', 'email', 'max:255' ] ],
            'email_exists'              => [ 'email' => [ 'required', 'email', 'max:255', Rule::exists('users', 'email')->whereNull('deleted_at') ] ],
            'email_unique'              => [ 'email' => [ 'required', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at') ], ],
            'password'                  => [ 'password' => ['required', 'between:8,255'] ],
            'password_current'          => [ 'password_current' => ['required', 'between:8,255', new PasswordCurrentRule] ],
        ];
    }

    /**
     * バリデーションルールを取得します
     *
     * @param array $attributes
     * @return array
     */
    public function getRules(array $attributes): array
    {
        $rules = [];
        foreach ($attributes as $attribute) {
            $rules += $this->rules()[$attribute] ?? [];
        }
        return $rules;
    }
}
