<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyPersonRequest extends FormRequest
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
            'phone_number' => ['required'],
            'email' => ['required', 'email', 'unique:company_people,email,'. $this->id],
            'company_id' => ['required'],
            'is_tutor' => ['required', 'boolean'],
            'is_contact' => ['required', 'boolean'],
        ];
    }
}
