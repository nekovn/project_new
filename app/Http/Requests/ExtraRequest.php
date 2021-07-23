<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtraRequest extends FormRequest
{
    private $table = 'extra';
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
        $condThumb = 'bail|required|image|max:500';
        $condName  = "bail|required|between:1,100|unique:$this->table,name";
        if(!empty($id)){
            $condThumb = 'bail|image|max:500';
            $condName  = "bail|required|between:1,100|unique:$this->table,name,$id";//neu edit thì loại trừ id hiện tại
        }
        return [
            'name'          => $condName, //required : k dc bỏ trống ,
            'subtitle'      => 'bail|required|min:2',
            'status'        => 'bail|in:active,inactive', // in : nằm trong 1 active hoặc inactive
            'sale_off'      => 'bail|required|integer',
            'thumb'         => $condThumb, // max:dung lượng bao nhieu bite

        ];
    }
    public function messages()
    {
        return [
//            'name.required' => 'Name không được rỗng ! ',
//            'name.min' => 'Name ":input"chiều dài phải có ít nhất :min ký tự',
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
