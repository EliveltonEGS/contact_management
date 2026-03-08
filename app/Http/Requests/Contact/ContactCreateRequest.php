<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactCreateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:5',
                'max:100'
            ],
            'email' => [
                'required',
                'email',
                'max:80',
                Rule::unique('contacts', 'email')
            ],
            'phone' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'phone')
            ]
        ];
    }
}
