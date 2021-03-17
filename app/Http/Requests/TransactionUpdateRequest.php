<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
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
            'wallet_id' => 'required|numeric',
            'type' => 'required|in:+,-',
            'summ' => 'required|numeric',
        ];
    }
    public function messages() {
        return [
            'wallet_id.required'=>'Выберите кошелек.',
            'wallet_id.numeric'=>'Что-то пошло не так. Повторите операцию, заполните все поля. Если проблема повторится, свяжитесь с техподдержкой.',

            'type.required'=>'Выберите тип транзакции.',
            'type.in:+,-'=>'Что-то пошло не так. Повторите операцию, заполните все поля. Если проблема повторится, свяжитесь с техподдержкой.',

            'summ.required'=>'Укажите сумму',
            'summ.numeric'=>'Что-то пошло не так. Повторите операцию, заполните все поля. Если проблема повторится, свяжитесь с техподдержкой.',
        ];
    }

}
