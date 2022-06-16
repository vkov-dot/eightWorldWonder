<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeadingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'image' => 'required'
        ];
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Введіть назву рубрики',
            'image.required' => 'Вкажіть аватар рубрики'
        ];
    }
}
