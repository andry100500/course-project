<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
    }
    public function messages() {
        return [
            'name.required' => 'Укажите имя',

            'email.required' =>'Заполните поле email',
            'email.email' =>'Значение в поле email не соответствует формату адреса электронной почты.',
            'email.unique:users' =>'Пользователь с таким email уже существует.',

            'password.required' => 'Укажите пароль.',
            'password.confirmed' => 'Пароли не свопадают.',

        ];
    }
}
