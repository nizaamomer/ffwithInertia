<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|min:3|unique:categories,name',
                'image' => 'required|image|mimes:png,jpg',
                'status' => 'in:active,inactive',
            ];
        } else if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name' => 'required|min:3|unique:categories,name,' . $this->category->id,
                'image' => 'sometimes|image|mimes:png,jpg',
                'status' => 'in:active,inactive',
            ];
        }
    }
}
