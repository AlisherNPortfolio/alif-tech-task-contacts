<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'unique_name' => 'required|max:15|unique:users,unique_name',
            'contacts.*.type' => [Rule::in(['phone', 'email']), 'required', 'string'],
            'contacts.*.contact' => 'string|max:20'
        ];
    }
}
