<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
                'category_id' => 'nullable|exists:categories,id',
                'name' => 'required|min:3|unique:food,name',
                'image' => 'sometimes|image|mimes:png,jpg,jpeg',
                'price' => 'required',
                'status' => 'in:active,inactive',
                'menu' => 'in:foods,drinks',
            ];
        } else if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'category_id' => 'nullable|exists:categories,id',
                'name' => 'required|min:3|unique:food,name,' . $this->food->id,
                'image' => 'sometimes|image|mimes:png,jpg,jpeg',
                'price' => 'required',
                'status' => 'in:active,inactive',
                'menu' => 'in:foods,drinks',
            ];
        }
    }
}
