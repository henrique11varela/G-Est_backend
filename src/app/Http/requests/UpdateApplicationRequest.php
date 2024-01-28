<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
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
            'company_name' => 'required',
            'activity_sector' => 'required',
            'locality' => 'required',
            'website' => 'required',
            'contact_name' => 'required',
            'contact_telephone' => 'required',
            'contact_email' => 'required',
            'number_students' => 'required',
            'student_profile' => 'required',
            'student_tasks' => 'required',
            'company_id' => 'required',
            'is_partner' => 'required',
            //'is_valid' => 'required',
        ];
    }
}
