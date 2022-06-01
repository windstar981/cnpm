<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'name' => 'required|min:5|max:100',
            'email' => 'email',
            'telephone' => 'numeric|min:10|nullable'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
       return  [];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'  => trans('messages.validate.name').trans('messages.validate.required'),
            'name.string'    => trans('messages.validate.name').trans('messages.validate.string'),
            'name.max'       => trans('messages.validate.name').trans('messages.validate.max'). 50,
            'name.min'       => trans('messages.validate.name').trans('messages.validate.min'). 5,
            'email.email'    => trans('messages.validate.email').trans('messages.validate.regex'),
            'email.unique'   => trans('messages.validate.email').trans('messages.validate.unique'),
            'phone.required' => trans('messages.validate.phone').trans('messages.validate.required'),
            'phone.string'   => trans('messages.validate.phone').trans('messages.validate.string'),
            'phone.unique'   => trans('messages.validate.phone').trans('messages.validate.unique'),
            'phone.regex'    => trans('messages.validate.phone').trans('messages.validate.regex'),
            'phone.phone'    => trans('messages.validate.phone').trans('messages.validate.regex'),
        ];
    }
}
