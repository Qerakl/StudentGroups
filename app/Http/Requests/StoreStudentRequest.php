<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'login' => 'required|string|unique:students,login|max:255',
            'group_id' => 'required|integer|exists:groups,id',
            'password' => 'required|string|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Имя обязательно.',
            'first_name.string' => 'Имя должно быть строкой.',
            'first_name.max' => 'Имя не может быть длиннее 255 символов.',
            'last_name.required' => 'Фамилия обязательна.',
            'last_name.string' => 'Фамилия должна быть строкой.',
            'last_name.max' => 'Фамилия не может быть длиннее 255 символов.',
            'group_id.required' => 'Необходимо указать Группы.',
            'group_id.integer' => 'ID группы должен быть целым числом.',
            'group_id.exists' => 'Выбранная группа не существует.',
            'login.required' => 'Логин обязателен.',
            'login.string' => 'Логин должен быть строкой.',
            'login.unique' => 'Этот логин уже занят.',
            'login.max' => 'Логин не может быть длиннее 255 символов.',

            'password.required' => 'Пароль обязателен.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.max' => 'Пароль не может быть длиннее 255 символов.',
        ];
    }
}
