<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewPasswordRequest extends FormRequest
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
    public function rules()
    {
        return [
            'password' => 'required',
            'new_password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Укажите пароль.',
            'new_password.required' => 'Укажите новый пароль.',
            'new_password.confirmed' => 'Пароли не свопадают.',

        ];
    }
}
