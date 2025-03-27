<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttributeRequest extends FormRequest
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
            'product_type' => ['required', 'string'],
            'attribute_group_id' => ['nullable', 'exists:attributes,id'],
            'name' => ['required', 'string'],
            'vi_translation' => ['required', 'string'],

        ];
    }
}
