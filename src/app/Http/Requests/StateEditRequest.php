<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateEditRequest extends FormRequest
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
            'body' => 'required',
            'logo' => 'file|max:5120',
            'author' => 'required'
        ];
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Введіть назву статті',
            'body.required' => 'Заповніть поле для тексту статті',
            'author.required' => 'Введіть ім\'я автора'
        ];
    }
}
