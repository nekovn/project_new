<?php

namespace App\Models;

use App\Models\CategoryModel as MainModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminModel extends Model
{
    protected $table        = ""; // cấu hình lại tên bảng db slider
    protected $folderUpdate = "";
    public $timestamps = false; // ko muốn cập nhập tgian tự động
    const CREATED_AT = 'created'; // thiết lập lại tên bảng db cột created
    const UPDATED_AT = 'modified';// thiết lập lại tên bảng db cột update

    protected  $fieldSearchAccepted =[ //những field dc phép search
        'id',
        'name',
    ];

    protected $crudNotAccepted =[ //những crud dc phép save
        '_token',
        'thumb_current',

    ];


    public function uploadThumb($thumbObj){
        //có thể sử dụng pthuc move để upload hình lên cũng dc
        //update tấm hình mới lên
        $thumbName    = Str::random(10).'.'.$thumbObj->clientExtension();//tên tấm hình
        //zvn_storage_image : cấu hình điều chính src img trong file config/filesystem
        $thumbObj->storeAs($this->folderUpdate, $thumbName,'zvn_storage_image');


        return $thumbName;
    }
    public function deleteThumb($thumbName){
        Storage::disk('zvn_storage_image')->delete($this->folderUpdate.'/'.$thumbName);
    }

    public function prepareParams($params){
        return array_diff_key ($params,array_flip ($this->crudNotAccepted));
    }

}
