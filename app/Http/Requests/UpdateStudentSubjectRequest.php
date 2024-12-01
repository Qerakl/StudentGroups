<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentSubjectRequest extends FormRequest
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
            'grade' => 'required|integer|min:2|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'grade.required' => 'Поле "Оценка" обязательно для заполнения.',
            'grade.integer' => 'Оценка должна быть числом.',
            'grade.min' => 'Оценка должна быть не меньше 2.',
            'grade.max' => 'Оценка должна быть не больше 5.',
        ];
    }
}
