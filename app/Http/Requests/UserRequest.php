<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'is_admin' => 'boolean',
        ];
    }

    // public function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'name' => strtoupper($this->name),
    //     ]);
    // }

    // protected $stopOnFirstFailure = true;

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => ':attributes field is required.',
    //         'email.required' => 'The email field is required.',
    //         'email.email' => 'Please provide a valid email address.',
    //     ];
    // }

    // public function attributes(): array
    // {
    //     return [
    //         'is_admin' => 'admin status',
    //     ];
    // }
}
