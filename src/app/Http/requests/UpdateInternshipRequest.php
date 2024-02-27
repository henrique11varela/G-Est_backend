<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateInternshipRequest extends FormRequest
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
            'student_id' => 'required',
            'student_collection_id' => 'required',
            'companies' => 'required',
            'started_internship.meal_allowance' => 'required_unless:started_internship,null',
            'started_internship.hq_shipping_address' => 'required_unless:started_internship,null',
            'started_internship.hourly_load' => 'required_unless:started_internship,null',
        ];
    }

}
