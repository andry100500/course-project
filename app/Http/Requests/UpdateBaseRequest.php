<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBaseRequest extends FormRequest
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
            'name'=>'required',
            'currency_id'=>'required|numeric'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Укажите имя.',
            'currency_id.required'=>'Вы не выбрали валюту.',
            'currency_id.numeric' =>'Что-то пошло нет так, попробуйте повторить операцию. Если проблема повторится, свяжитесь с техподдержкой.',
        ];
    }
}
