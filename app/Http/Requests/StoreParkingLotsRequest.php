<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParkingLotsRequest extends FormRequest
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
            //
            'parking_name' => 'required',
            'capacity' => 'required|integer',
            'address' => 'required',
            'cost' => 'required | integer',
            'photo' => 'required | image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required',
        ];
    }
}
