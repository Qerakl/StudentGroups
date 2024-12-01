<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subjects', 'name')->ignore($this->route('subject')),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название группы" обязательно для заполнения.',
            'name.string' => 'Поле "Название группы" должно быть строкой.',
            'name.max' => 'Поле "Название группы" не должно превышать 255 символов.',
            'name.unique' => 'Группа с таким названием уже существует.',
        ];
    }
}
