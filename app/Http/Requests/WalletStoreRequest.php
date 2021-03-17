<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'currency_id' => 'required|numeric'
        ];
    }
    public function messages() {
        return [
            'name.required' => 'Укажите имя.',
            'name.min:2' => 'Имя должно содержать от 2 до 50 символов.',
            'name.max:255' => 'Имя должно содержать от 2 до 50 символов.',
            'currency_id.required' => 'Выберите валюту.',
            'currency_id.numeric' => 'Что-то пошло не так. Повторите операцию, заполните все поля. Если проблема повторится, свяжитесь с техподдержкой.',

        ];
    }
}
