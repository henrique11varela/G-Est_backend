<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'number_students' => 'required',
            'activity_sector' => 'required',
            'is_partner' => 'required',
            'contact_name' => 'required',
            'contact_telephone' => 'required',
            'contact_email' => 'required',
            'website' => 'required',
            'locality' => 'required',
            'student_tasks' => 'required',
            //'company_id' => 'required',

            //'is_valid' => 'required',
        ];
    }
}
