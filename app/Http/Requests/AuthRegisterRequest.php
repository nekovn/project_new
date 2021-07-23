<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
        $condUserName   = "bail|required|between:3,100|unique:$this->table,username";//unique la duy nhat ton tai 1 lan
        $condEmail      = "bail|required|email|unique:$this->table,email";
        $condFullname   = 'bail|required|min:3';
        $condPassword   = 'bail|required|between:5,100|confirmed'; //xac nhan lai password co ton tai trong bang table ko

        return [
            'username'          => $condUserName,
            'email'             => $condEmail,
            'fullname'          => $condFullname,
            'password'          => $condPassword,

        ];
    }


    public function attributes() // thay đổi thuộc tính đoạn văn error
    {
        return [
            'username'=>'ユーザー名',
            'fullname'=>'お名前',
            'email'=>'メールアドレス',
            'password'=>'パスワード',
        ];
    }
}
