<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        dd(Auth::id());
        return [
            'name' => 'required|between:3,25|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '用户名已被使用，请重新设置',
            'name.between' => '用户名必须介于 3 - 25 个字符',
            'name.requore' => '用户名不能为空'
        ];
    }
}
