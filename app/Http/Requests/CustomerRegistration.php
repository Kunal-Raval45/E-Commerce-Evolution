<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegistration extends FormRequest
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
            'profile_image' => 'required|mimes:jpeg,png,jpg,gif',
            'fullname' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'address_1' => 'required|max:1000',
            'address_2' => 'required|max:1000',
            'zipcode' => 'required|max:100',
            'password' => 'required|max:255',
        ];
    }
}