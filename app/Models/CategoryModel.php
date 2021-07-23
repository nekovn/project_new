<?php

namespace App\Models;

use App\Models\CategoryModel as MainModel;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryModel extends AdminModel
{
    public function __construct(array $attributes = [])
    {
        $this->table        = "category";
        $this->fieldSearchAccepted        = [ 'id','name'];
        $this->crudNotAccepted            = [ '_token'];




        parent::__construct ($attributes);
    }

    public function listItems($params = null, $options = null)
    {
        //params chứa ham số dành cho câu truy vấn
        //options dùng để viết dc nhiều trường hợp sử lý khác nhau
        $result = null;
        if ($options['task'] == "admin-list-items") {
            //ko nên select * vi lần sau ta gọi nữa thì nó lại select tất cả nữa
            $query = self::select ('name', 'id', 'is_home','display','created', 'created_by', 'modified', 'modified_by', 'status');

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
            $query = $this->select('id','name')
                ->where('status','=','active')
                ->limit(8)
                ->orderBy ('id','desc');
            $result = $query->get()->toArray();
        }
        if($options['task']=='news-list-items-is-home'){
            $query = $this->select('id','name','display')
                    ->where('status','=','active')
                    ->where('is_home','=','1');

            $result = $query->get()->toArray();
        }

        if($options['task']=='admin-list-items-in-selectbox'){
            $query = self::select ('name', 'id')
                           ->orderby('name','asc')
                           ->where('status','=','active');
            //in ra array [id]=>[name] , key : là id , name : value
            $result = $query->pluck('name','id');
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

            $params = $this->prepareParams ($params);
            self::insert($params); //upload vao database

        }
        if($options['task'] == 'edit-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            $params['modified_by']  = $name;
            $params['modified']     = date ('y-m-d');
            //xóa các key ko cần thiết
            $params = $this->prepareParams ($params);
            self::where('id',$params['id'])->update($params);
        }
        if($options['task']=='change-is-home'){
            $isHome = ($params['currentIsHome']=="1")?"0":"1";
            self::where('id', $params['id'])
                ->update(['is_home'=> $isHome]);
        }
        if($options['task']=='change-display'){
             $display = $params['currentDisplay'];
             self::where('id', $params['id'])
                ->update(['display'=> $display]);
        }
    }

    public function deleteItems($params = null ,$options = null){
        if($options['task'] == 'delete-item'){
            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null ,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result =  self::select ('name', 'id','status','is_home','display')
                    ->where('id',$params['id'])->first();
        }
        if($options['task']=='news-get-item'){
            $result =  self::select ('name', 'id','display')
                ->where('id',$params['category_id'])->first();

            if($result)$result=$result->toArray();

        }

        return $result;
    }



}
