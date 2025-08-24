<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorestudentRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
            'national_id'   => 'required|string|max:20',
            'email'         => 'required|email|max:255|unique:students,email',
            'password'      => 'required|string|min:6',
            'birth_date'    => 'required|date',
            'religion_id'   => 'required|exists:religions,id',
            'grade_id'      => 'required|exists:grades,id',
            'classroom_id'  => 'required|exists:classes,id',
            'section_id'    => 'required|exists:sections,id',
            'parent_id'     => 'required|exists:my_parents,id',
            'address'       => 'required|string',
             
        ];
    }
}
