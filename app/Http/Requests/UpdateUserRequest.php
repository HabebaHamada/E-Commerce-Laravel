<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'profile_picture' => ['nullable', 'sometimes', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'address' => ['sometimes','nullable', 'string', 'max:255'],
            'city' => ['sometimes','nullable', 'string', 'max:100'],
            'country' => ['sometimes','nullable', 'string', 'max:100'],
            'phone_number' => ['sometimes','nullable', 'string', 'unique:users,phone_number,' . $this->user()->id],
        ];
    }
}
