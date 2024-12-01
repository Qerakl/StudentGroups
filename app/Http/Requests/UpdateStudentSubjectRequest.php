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
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|min:2|max:5',
            'date' => 'required|date|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Поле "Студент" обязательно для заполнения.',
            'student_id.exists' => 'Указанный студент не существует.',
            'subject_id.required' => 'Поле "Предмет" обязательно для заполнения.',
            'subject_id.exists' => 'Указанный предмет не существует.',
            'grade.required' => 'Поле "Оценка" обязательно для заполнения.',
            'grade.integer' => 'Оценка должна быть числом.',
            'grade.min' => 'Оценка должна быть не меньше 2.',
            'grade.max' => 'Оценка должна быть не больше 5.',
            'date.required' => 'Поле "Дата" обязательно для заполнения.',
            'date.date' => 'Неверный формат даты.',
            'date.date_format' => 'Дата должна быть в формате ГГГГ-ММ-ДД.',
        ];
    }
}
