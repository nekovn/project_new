<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    private $table = 'user';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //nếu như ta ko muốn nó validate thì để false thì nó chuyển vể trang 404error
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
            'email'             => 'bail|required|email|email',
            'password'          => 'bail|required|between:5,100',

        ];
    }
    public function messages()
    {
        return [
//            'name.required' => 'Name không được rỗng ! ',
//            'name.min' => 'Name ":input"chiều dài phải có ít nhất :min ký tự',
//             :min là giá trị số 5 ở trên validate
//             :input là giá trị người dùng nhập vào.
        ];
    }

    public function attributes() // thay đổi thuộc tính đoạn văn error
    {
        return [
//            'description' => 'Field Description:', // ví dụ từ description thành phamcuong
        ];
    }
}
