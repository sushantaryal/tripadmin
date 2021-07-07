<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'guests.*.name.firstName' => 'required',
            'guests.*.name.lastName' => 'required',
            'guests.*.contact.phone' => 'required',
            'guests.*.contact.email' => 'required|email'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'guests.*.name.firstName' => 'first name',
            'guests.*.name.lastName' => 'last name',
            'guests.*.contact.phone' => 'phone',
            'guests.*.contact.email' => 'email'
        ];
    }
}
