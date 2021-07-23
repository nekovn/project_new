<?php

namespace App\Models;

use App\Models\SliderModel as MainModel;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderModel extends AdminModel
{
    public function __construct(array $attributes = [])
    {
        $this->table        = "slider";
        $this->folderUpdate = "img/slider";
        $this->fieldSearchAccepted        = [ 'id','name','description','link'];
        $this->crudNotAccepted            = [ '_token','thumb_current'];




        parent::__construct ($attributes);
    }

    public function listItems($params = null, $options = null)
    {
        //params chứa ham số dành cho câu truy vấn
        //options dùng để viết dc nhiều trường hợp sử lý khác nhau
        $result = null;
        if ($options['task'] == "admin-list-items") {
            //ko nên select * vi lần sau ta gọi nữa thì nó lại select tất cả nữa
            $query = self::select ('name', 'id', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

            if ($params['filter']['status'] !== 'all') {
                $query->where ('status', '=', $params['filter']['status']);
            }
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
        if($options['task']== 'news-list-items'){
            $query = $this->select('id','name','description','link','thumb')
                          ->where('status','=','active')
                          ->limit(5);
            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function countItems($params = null, $options = null)
    {
        //params chứa ham số dành cho câu truy vấn
        //options dùng để viết dc nhiều trường hợp sử lý khác nhau
        $result = null;
        if ($options['task'] == "admin-count-items-group-by-status") {
            //SELECT `status`, COUNT(id) as count FROM `slider` group by `status`
            //lay ra groupBy cua status

            $query = self::groupBy('status')
                         ->select(self::raw ('count(id) as count, status'));// db::raw khi dua vao select câu query gi do

            //neu ma khi search thi count cac status cung thay doi theo
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
            $result = $query->get()->toArray();//to array chuyen obj sang 1 mãng

        }

        return $result;
    }

    public function saveItems($params = null ,$options = null){
            if($options['task'] == 'change-status'){
                $status = ($params['currentStatus']=="active")?"inactive":"active";
                self::where('id', $params['id'])
                    ->update(['status' => $status]);
            }
        if($options['task'] == 'add-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            $params['created_by']  = $name;
            $params['created']     = date ('y-m-d');
            //update tấm hình mới lên
            $params['thumb']       = $this->uploadThumb ($params['thumb']);
            //lọc xem array nào có key khác nhau thì lấy
            $params = $this->prepareParams ($params);
//            $paramsInsert['name']        = $params['name'];
//            $paramsInsert['description'] = $params['description'];
//            $paramsInsert['link']        = $params['link'];
//            $paramsInsert['status']      = $params['status'];



            self::insert($params); //upload vao database

        }
        if($options['task'] == 'edit-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            if(!empty($params['thumb'])){ //nếu mà tồn tại thumb thì biết là đang upload hình mới lên
                //khi edit upload hình mới lên thì phải xóa hình cũ đi
                $this->deleteThumb($params['thumb_current']);
                //update tấm hình mới lên
                $params['thumb'] = $this->uploadThumb ($params['thumb']);
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
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null ,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result =  self::select ('name', 'id', 'description', 'link', 'thumb','status')
                    ->where('id',$params['id'])->first();
        }
        if($options['task']=='get-thumb'){
            $result =  self::select ( 'id', 'thumb')
                ->where('id',$params['id'])->first();
        }
        return $result;
    }



}
