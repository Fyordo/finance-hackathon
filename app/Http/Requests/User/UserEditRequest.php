<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'dfa' => ['required', 'boolean'],
            'is_male' => ['required', 'boolean'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
        ];
    }
}
