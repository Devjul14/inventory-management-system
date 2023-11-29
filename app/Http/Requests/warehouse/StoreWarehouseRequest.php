<?php

namespace App\Http\Requests\warehouse;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'image|file|max:1024',
            'warehouse_name' => 'required|string|max:100',
            'location' => 'required|string|max:50',
            'size_capacity' => 'required|string|max:10',
        ];
    }
}
