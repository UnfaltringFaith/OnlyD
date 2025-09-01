<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailableCarsRequest extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,id',
            'starts_at' => 'required|date',
            'finishes_at' => 'required|date|after:starts_at',
            'comfort_category_id' => 'nullable|string',
            'car_model_id' => 'nullable|string',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'employee_id.required' => 'ID сотрудника обязателен',
            'employee_id.exists' => 'Сотрудник не найден',
            'starts_at.required' => 'Время начала поездки обязательно',
            'finishes_at.required' => 'Время окончания поездки обязательно',
            'finishes_at.after' => 'Время окончания должно быть позже времени начала',
        ];
    }
}
