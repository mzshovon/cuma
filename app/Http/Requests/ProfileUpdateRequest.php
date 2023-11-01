<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->id],
            'contact' => ['required', 'string', 'max:11', 'unique:users,contact,'.$this->id],
            'nid' => ['required', 'string','unique:users,email,'.$this->id],
            'dob' => ['required', 'string'],
            'address' => ['required', 'string'],
            'blood_group' => ['nullable', 'string'],
            'batch' => ['required', 'string'],
            'employeer_name' => ['nullable', 'string'],
            'designation' => ['nullable', 'string'],
            'employeer_address' => ['nullable', 'string'],
            'reference' => ['nullable', 'string'],
            'reference_number' => ['nullable', 'string'],
        ];
    }
}