<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon; // <<< IMPORTANTE

class EmployeesStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // normaliza salário "1.234,56" -> "1234.56"
    protected function prepareForValidation(): void
    {
        if (is_string($this->salary)) {
            $normalized = str_replace(['.', ','], ['', '.'], $this->salary);
            $this->merge(['salary' => $normalized]);
        }
    }

    public function rules(): array
    {
        return [
            'user_id'    => ['required', 'exists:users,id'],
            'position'   => ['required', 'in:manager,referee,cleaner,staff'],
            'salary'     => ['required', 'numeric', 'gt:0'],
            'hired_date' => [
                'required',
                'date_format:d/m/Y',
                function ($attribute, $value, $fail) {
                    try {
                        $date = Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
                        if ($date->isAfter(Carbon::today())) {
                            $fail(__('crud.all_employees.validation.hired_date_not_future'));
                        }
                    } catch (\Exception $e) {
                        // o date_format já vai acusar erro, então só ignoramos aqui
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'salary.gt'              => __('crud.all_employees.validation.salary_gt'),
            'salary.numeric'         => __('crud.all_employees.validation.salary_numeric'),
            'hired_date.date_format' => __('crud.all_employees.validation.hired_date_format'),
        ];
    }
}
