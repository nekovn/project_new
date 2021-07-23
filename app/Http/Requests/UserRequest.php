<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $task = $this->task;
        $id   = $this->id;//nếu tồn tại id là chứng tỏ là edit,nếu là edit k cần validate thum
        $condAvatar     = '';
        $condUserName   = '';
        $condEmail      = '';
        $condPassword   = '';
        $condLevel      = '';
        $condStatus     = '';
        $condFullname   = '';

                switch ($task){
                            case 'add' :
                                $condUserName   = "bail|required|between:5,100|unique:$this->table,username";//unique la duy nhat ton tai 1 lan
                                $condEmail      = "bail|required|email|unique:$this->table,email";
                                $condFullname   = 'bail|required|min:5';
                                $condPassword   = 'bail|required|between:5,100|confirmed'; //xac nhan lai password co ton tai trong bang table ko
                                $condStatus     = 'bail|in:active,inactive';
                                $condLevel      = 'bail|in:admin,member';
                                $condAvatar     = 'bail|required|image|max:500';
                                break;
                            case 'edit-info' :
                                $condUserName   = "bail|required|between:5,100|unique:$this->table,username,$id";//unique la duy nhat ton tai 1 lan
                                $condEmail      = "bail|required|email|unique:$this->table,email,$id";
                                $condFullname   = 'bail|required|min:5';
                                $condStatus     = 'bail|in:active,inactive';
                                $condAvatar     = 'bail|image|max:500';
                                break;
                            case 'change-password':
                                $condPassword   = 'bail|required|between:5,100|confirmed'; //xac nhan lai password co ton tai trong bang table ko
                                break;
                            case 'change-level':
                                $condLevel      = 'bail|in:admin,member';
                                break;
                            default:
                                break;
                        }

        return [
            'username'          => $condUserName,
            'email'             => $condEmail,
            'fullname'          => $condFullname,
            'status'            => $condStatus,
            'level'             => $condLevel,
            'password'          => $condPassword,
            'avatar'            => $condAvatar,

        ];
    }
    public function messages()
    {
        return [
//              'username.min' => 'ユーザー名：１２３',
            // :min là giá trị số 5 ở trên validate
            // :input là giá trị người dùng nhập vào.
        ];
    }

    public function attributes() // thay đổi thuộc tính đoạn văn error
    {
        return [
//            'description' => 'Field Description:', // ví dụ từ description thành phamcuong
        ];
    }
}
