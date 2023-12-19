<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'email_address' => 'required|email',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'instagram' => 'nullable|string|max:100',
            'linkedin' => 'nullable|string|max:100',
        ];
    }
}
