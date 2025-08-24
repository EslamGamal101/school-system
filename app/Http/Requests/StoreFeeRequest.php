<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
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
            'grade_id'      => 'required|exists:grades,id',
            'classe_id'      => 'required|exists:classes,id',
            'section_id'    => 'required|exists:sections,id',
            'academic_year' => 'required|digits:4|integer|min:2020|max:2100',
            'amount'        => 'required|numeric|min:0',
            'fee_type'      => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
        ];
    }

    /**
     * Custom messages (optional)
     */
    public function messages(): array
    {
        return [
            'grade_id.required' => 'اختر الصف الدراسي.',
            'class_id.required' => 'اختر الفصل.',
            'section_id.required' => 'اختر القسم.',
            'academic_year.required' => 'ادخل السنة الدراسية.',
            'amount.required' => 'ادخل قيمة المصروف.',
            'fee_type.required' => 'ادخل نوع المصروف.',
        ];
    }
    public function attributes(): array
    {
        return [
            'grade_id' => 'grade',
            
        ];
    }
}
