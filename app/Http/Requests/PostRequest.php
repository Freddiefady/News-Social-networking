<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'title'=>'required | max:50 | string',
            'description'=>'required | min:10',
            'small_description'=>'min:50|max:200|required',
            'category_id'=>'exists:categories,id',
            'comment_able'=>'in:on,off,0,1',
            'status'=>'nullable|in:0,1',
            'image.*'=>'mimes:png,jpg,jpeg | image',
        ];
        if (in_array($this->method(), ['PUT','PATCH']))
        {
            $rules['images']='nullable';
        }else{
            $rules['images']='required';
        }
        return $rules;
    }
    public function messages(): array
    {
        return
        [
            //
        ];
    }
    public function attributes(): array
    {
        return
        [
            'category_id' => 'categories',
            'title' => 'title of post',
        ];
    }
}
