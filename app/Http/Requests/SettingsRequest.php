<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'site_name'=>'required|string',
            'favicon'=>'image|mimes:png,jpg',
            'logo'=>'image|mimes:png,jpg',
            'email'=>'required|email',
            'small_description'=>'required|string|max:300',
            'facebook'=>'url',
            'instagram'=>'url',
            'twitter'=>'url',
            'youtube'=>'url',
            'phone'=>'required|numeric',
            'country'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
        ];
    }
}
