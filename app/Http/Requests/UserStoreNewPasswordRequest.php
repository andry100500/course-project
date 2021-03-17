<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreNewPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_password' => 'required|confirmed',
        ];
    }
    public function messages() {
        return [
            'new_password.required' => 'Укажите новый пароль.',
            'new_password.confirmed' => 'Пароли не свопадают.',
        ];
    }
}
