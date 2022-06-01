<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 14/05/2021
 * Time: 17:00
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'old_password'     => [
                'required',
                function ($attr, $value, $fail) {
                    $password = auth()->user()->password;
                    $check    = Hash::check($value, $password);
                    if ($check == false) {
                        $fail('Mật khẩu hiện tại không chính xác');
                    }
                },
            ],
            'password'         => 'required|string|min:6|max:32',
            'password_confirm' => 'required|string|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Mật khẩu hiện tại bắt buộc phải nhập',
            'password.required'         => 'Mật khẩu mới bắt buộc phải nhập',
            'password.max'              => trans('messages.validate.password') . trans('messages.validate.max') . 32,
            'password.min'              => trans('messages.validate.password') . trans('messages.validate.min') . 6,
            'password.string'           => trans('messages.validate.password') . trans('messages.validate.string'),
            'password_confirm.required' => 'Mật khẩu xác nhận bắt buộc phải nhập',
            'password_confirm.string'   => trans('messages.validate.password_confirm') . trans('messages.validate.string'),
            'password_confirm.same'     => trans('messages.validate.password_confirm') . trans('messages.validate.same'),
        ];
    }
}