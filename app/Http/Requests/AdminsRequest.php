<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminsRequest extends FormRequest
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
        $admin_id = $this->route('admin');
        $rules = [
            'name'=>'required|string',
            'username'=>'required|string|unique:admins,username,'.$admin_id,
            'email'=>'email|required|unique:admins,email,'.$admin_id,
            'status'=>'in:0,1|required',
            'role_id'=>'exists:authorizations,id|required'
        ];
        if (in_array($this->method(), ['PUT','PATCH']))
        {
            $rules['password']='nullable|confirmed';
            $rules['password_confirmation']='nullable';
        }
        else
        {
            $rules['password']='required|confirmed';
            $rules['password_confirmation']='required';
        }
        return $rules;
    }
}
