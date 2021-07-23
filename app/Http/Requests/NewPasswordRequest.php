<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
        $condPassword   = 'bail|required|between:5,100|confirmed'; //xac nhan lai password co ton tai trong bang table ko

        return [
            'password'          => $condPassword,
        ];
    }


    public function attributes() // thay đổi thuộc tính đoạn văn error
    {
        return [
            'password' => 'パスワード',
        ];
    }
}
