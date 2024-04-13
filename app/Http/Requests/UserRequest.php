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
        $rules = [
            'name' => 'required|min:3',
            'phoneNumber' => 'required',
            'imageUrl' => 'sometimes|image|mimes:png,jpg,jpeg',
            'status' => 'in:active,inactive',
            'isAdmin' => 'required|boolean',
        ];
        if ($this->isMethod('post')) {
            return array_merge($rules, [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed'
            ]);
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return array_merge($rules, [
                'email' => 'required|email|unique:users,email,' . $this->user->id,
            ]);
        }

        return [];
    }
}
