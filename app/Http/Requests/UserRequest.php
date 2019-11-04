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
        return [
            'name' => 'required|between:3,25|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar'=>'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes'=>'头像必须是jpeg,bmp,png,gif的图片格式',
            'avatar.dimensions'=>'图片清晰度不够，宽度和高度需在 208px 以上',
            'name.unique' => '用户名已被使用，请重新设置',
            'name.between' => '用户名必须介于 3 - 25 个字符',
            'name.requore' => '用户名不能为空'
        ];
    }
}
