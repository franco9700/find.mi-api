<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerUser extends FormRequest
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
            'name' => 'required|string',
            'lastname' => 'required|string',
            'birthplace' => 'required|string',
            'birthdate' => 'required|date',
            'sex_gen' => 'required|string|max:4',
            'address' => 'required|string',
            'phone' => 'required|string|max:10',
            'cellphone' => 'required|string|max:10',
            'emergency_phone' => 'string|max:10|nullable',
            'email' => 'required|email|unique:users',
            'contact_email' => 'required|email|different:email|nullable',
            'medical_summary' => 'required_if:health_risk,1|string',
            'health_risk' => 'required|boolean',
            'password' => 'required|string|min:8',
            'image' => 'file|nullable',
            'role_id' => 'exists:roles,id',
        ];
    }
}
