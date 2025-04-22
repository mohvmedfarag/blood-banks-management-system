<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:donors,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:100'],
            'age' => ['required', 'numeric', 'min:18', 'max:60'],
            'weight' => ['required', 'numeric', 'min:50'],
            'gender' => ['required', 'in:male,female'],
            'password' => ['required', 'min:6', 'confirmed'],
        ];
    }
}
