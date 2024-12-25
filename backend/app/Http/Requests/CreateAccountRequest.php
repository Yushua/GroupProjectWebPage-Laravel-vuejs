<?php

// app/Http/Requests/CreateAccountRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            // No email validation anymore
        ];
    }

    public function authorize()
    {
        return true; // Allow the request
    }
}

