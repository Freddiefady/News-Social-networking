<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserSettingsRequest extends FormRequest
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
            'name'=>'required | string | min: 5| max: 50',
            'username'=>'required | string | unique:users,username,'.auth()->user()->id,
            'email'=>'required | email',Rule::unique('users','email')->ignore(auth()->user()->id),
            'phone'=>'required | numeric',Rule::unique('users','phone')->ignore(auth()->user()->id),
            'image'=>'nullable | mimes:png,jpeg,jpg | image',
            'country'=>'required | string | min: 3| max: 15',
            'city'=>'required | string | min: 3| max: 15',
            'street'=>'required | min: 3| max: 15',
        ];
    }
}
