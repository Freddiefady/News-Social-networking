<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name'=>'required | string | min: 5',
            'username'=>'required | string | unique:users,username',
            'email'=>'required | email| unique:users,email',
            'phone'=>'required | numeric| unique:users,phone',
            'image'=>'required | mimes:png,jpeg,jpg,gif,bmp,webp,svg | image',
            'email_verified_at'=>'in:0,1',
            'status'=>'in:0,1',
            'country'=>'required | string | min: 3| max: 40',
            'city'=>'required | string | min: 3| max: 40',
            'street'=>'required | min: 3| max: 40',
            'password'=>'required | confirmed',
            'password_confirmation'=>'required',
        ];
    }
}
