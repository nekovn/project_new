<?php

namespace App\Models;

use App\Models\ArticleModel as MainModel;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
class CompanyModel extends AdminModel
{
    public function __construct(array $attributes = [])
    {
        $this->table        = "company";
        $this->folderUpdate = "img/company";
        $this->fieldSearchAccepted        = [ 'title','content'];
        $this->crudNotAccepted            = [ '_token','logo_current'];


        parent::__construct ($attributes);
    }

    public function listItems($params = null, $options = null)
    {
        //params chứa ham số dành cho câu truy vấn
        //options dùng để viết dc nhiều trường hợp sử lý khác nhau
        $result = null;
        if ($options['task'] == "admin-list-items") {
            //ko nên select * vi lần sau ta gọi nữa thì nó lại select tất cả nữa
            $query = self::select ('title', 'id', 'logo', 'content', 'created', 'created_by', 'modified', 'modified_by');

            if ($params['search']['value'] != "") {

                if ($params['search']['field'] == "all"){

                    //chay vòng lặp rồi lập điện or where cho nó
                    //neu bằng all thì serach all dùng or where
                    $query->where(function($query) use ($params){
                        foreach ($this->fieldSearchAccepted as $colum){
                            $query->orWhere($colum, 'like', "%{$params['search']['value']}%");
                        }


                    });
                }elseif (in_array ($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->Where($params['search']['field'], 'like', "%{$params['search']['value']}%");
                }

            }

            $result = $query->orderBy ('id', 'desc')
                ->paginate ($params["pagination"]["totalItemsPerPage"]);
        }
        if($options['task']== 'news-list-items-company'){
            $query = $this->select('title', 'id', 'logo', 'content')
                ->where('title','!=','')->first();

            $result = $query->get()->toArray();
        }

        return $result;
    }


    public function saveItems($params = null ,$options = null){

        if($options['task'] == 'add-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            $params['created_by']  = $name;
            $params['created']     = date ('y-m-d');
            //update tấm hình mới lên
            $params['logo']       = $this->uploadThumb ($params['logo']);
            //lọc xem array nào có key khác nhau thì lấy
            $params = $this->prepareParams ($params);


            self::insert($params); //upload vao database

        }
        if($options['task'] == 'edit-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            if(!empty($params['logo'])){ //nếu mà tồn tại thumb thì biết là đang upload hình mới lên
                //khi edit upload hình mới lên thì phải xóa hình cũ đi
                $this->deleteThumb($params['logo_current']);
                //update tấm hình mới lên
                $params['logo'] = $this->uploadThumb ($params['logo']);
            }

            $params['modified_by']  = $name;
            $params['modified']     = date ('y-m-d');
            //xóa các key ko cần thiết
            $params = $this->prepareParams ($params);
            self::where('id',$params['id'])->update($params);
        }
    }

    public function deleteItems($params = null ,$options = null){
        if($options['task'] == 'delete-item'){
            $item = self::getItem ($params,['task'=>'get-thumb']);
            $this->deleteThumb($item['logo']);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null ,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result =  self::select ('title', 'id', 'content', 'logo')
                ->where('id',$params['id'])->first();
        }
        if($options['task']=='get-thumb'){
            $result =  self::select ( 'id', 'logo')
                ->where('id',$params['id'])->first();
        }
        return $result;
    }


}
