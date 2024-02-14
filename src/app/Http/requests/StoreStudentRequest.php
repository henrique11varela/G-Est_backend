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
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'personal_email' => ['required', 'email'],
            'atec_email' => ['required', 'email'],
            'phone_number' => ['required'],
            'address' => ['required'],
            'postal_code' => ['required'],
            'locality' => ['required'],
            'soft_skills' => ['required'],
            'hard_skills' => ['required'],
        ];
    }
}
