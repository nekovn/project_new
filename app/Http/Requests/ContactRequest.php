<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    private $table = 'contact';
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
        $id = $this->id;//nếu tồn tại id là chứng tỏ là edit,nếu là edit k cần validate thum
        $condName  = "bail|required|between:5,100|unique:$this->table,title";
        if(!empty($id)){
            $condName  = "bail|required|between:5,100|unique:$this->table,title,$id";//neu edit thì loại trừ id hiện tại
        }
        return [
            'title'         => $condName, //required : k dc bỏ trống ,
            'copyright'     => 'bail|required|min:5',
            'content'       => 'bail|required|min:5',
            'status'        => 'bail|in:active,inactive', // in : nằm trong 1 active hoặc inactive

        ];
    }
    public function messages()
    {
        return [

        ];
    }

    public function attributes() // thay đổi thuộc tính đoạn văn error
    {
        return [

        ];
    }
}
