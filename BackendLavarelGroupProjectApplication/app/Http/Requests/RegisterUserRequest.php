<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest // Extend FormRequest
{
    public function authorize()
    {
        return true; // Allow all requests; adjust if authorization logic is needed
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:user_profiles,username',
            'password' => 'required|string|min:8|confirmed', // Assuming you have a password_confirmation field
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'The username is already taken.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
