<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
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
        $rules = [
            'email' => 'required|unique:users,email|email',
            'name' => 'required',
            'password' => 'required|confirmed|min:8'
        ];

        $route_name = Route::currentRouteName();

        if($route_name == 'auth.login') {
            $rules['email'] = 'required|email';
            $rules['password'] = 'required|min:8';
            $rules['name'] = 'nullable';
        }
        
        return $rules;
    }
}
