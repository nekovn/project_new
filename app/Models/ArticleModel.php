<?php

namespace App\Models;

use App\Models\ArticleModel as MainModel;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
class ArticleModel extends AdminModel
{
    public function __construct(array $attributes = [])
    {
        $this->table        = "article as a";
        $this->folderUpdate = "img/article";
        $this->fieldSearchAccepted        = [ 'name','content'];
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
            $query = self::select ('a.name', 'a.id', 'a.content', 'a.thumb', 'a.created', 'a.created_by', 'a.modified', 'a.modified_by', 'a.status','a.publish_at','a.type','c.name as category')
                        ->leftJoin('category as c', 'a.category_id', '=', 'c.id');

            if ($params['filter']['status'] !== 'all') {
                $query->where ('a.status', '=', $params['filter']['status']);
            }
            if ($params['search']['value'] != "") {

                if ($params['search']['field'] == "all"){

                    //chay vòng lặp rồi lập điện or where cho nó
                    //neu bằng all thì serach all dùng or where
                    $query->where(function($query) use ($params){
                        foreach ($this->fieldSearchAccepted as $colum){
                            $query->orWhere('a.'.$colum, 'like', "%{$params['search']['value']}%");
                        }


                    });
                }elseif (in_array ($params['search']['field'],$this->fieldSearchAccepted)){
                    $query->Where('a.'.$params['search']['field'], 'like', "%{$params['search']['value']}%");
                }

            }

            $result = $query->orderBy ('a.id', 'desc')
                ->paginate ($params["pagination"]["totalItemsPerPage"]);
        }
        if ($options['task']== 'news-list-items'){
            $query = $this->select('a.id','a.name','a.content','a.thumb')
                          ->where('a.status','=','active')
                          ->limit(5);
            $result = $query->get()->toArray();
        }

        if ($options['task']== 'news-list-items-featured'){
            $query = $this->select('a.id','a.name','a.content','a.thumb','a.created','a.category_id','c.name as category_name')
                          ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                          ->where('a.status','=','active')
                          ->where('a.type','=','feature')
                          ->orderBy('a.id','desc')
                          ->take(3); // lấy 3 phần tử
            $result = $query->get()->toArray();
        }

        if ($options['task']== 'news-list-items-latest'){
            $query = $this->select('a.id','a.name','a.thumb','a.created','a.category_id','c.name as category_name')
                          ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                          ->where('a.status','=','active')
                          ->orderBy('a.id','desc')
                          ->take(4); // lấy 3 phần tử
            $result = $query->get()->toArray();
        }
        if($options['task']=='news-list-in-category'){
            $query= $this->select('id','name','thumb','created','content')
                ->where('status','=','active')
                ->where('category_id','=',$params['category_id'])
                ->take(1000); // lấy 3 phần tử
            $result = $query->get()->toArray();
        }
        if($options['task']=='news-list-items-related-in-category'){
            $query = $this->select('id','name','content','thumb','created')
                ->where('status','=','active')
                ->where('id','!=',$params['article_id'])
                ->where('category_id','=',$params['category_id'])
                ->take(4);
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
        $this->table        = "article";
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



            self::insert($params); //upload vao database

        }
        if($options['task'] == 'edit-item'){
            if(!empty($params['thumb'])){ //nếu mà tồn tại thumb thì biết là đang upload hình mới lên
                //khi edit upload hình mới lên thì phải xóa hình cũ đi
                $this->deleteThumb($params['thumb']);
                //update tấm hình mới lên
                $params['thumb'] = $this->uploadThumb ($params['thumb']);
            }
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            $params['modified_by']  = $name;
            $params['modified']     = date ('y-m-d');
            //xóa các key ko cần thiết
            $params = $this->prepareParams ($params);
            self::where('id',$params['id'])->update($params);
        }
        if($options['task']=='change-type'){
            $type = $params['currentType'];
            self::where('id', $params['id'])
                ->update(['type'=> $type]);
        }

    }

    public function deleteItems($params = null ,$options = null){
        if($options['task'] == 'delete-item'){
            $this->table        = "article";
            $item = self::getItem ($params,['task'=>'get-thumb']);

            $pattern = '/<img\s.*?src=".*e\/(.*)"\ss.*/i';

            preg_match($pattern, $item['content'], $matches);
            if(!empty($matches)){
                //delete thumb content
                $thumbName=$matches[1];
                Storage::disk('zvn_storage_image')->delete($this->folderUpdate.'/'.$thumbName);
            }




            $this->deleteThumb($item['thumb']);



            self::where('id', $params['id'])->delete();
        }
    }

    public function getItem($params = null ,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result =  self::select ('name', 'id', 'content', 'thumb','status','category_id')
                    ->where('id',$params['id'])->first();
        }
        if($options['task']=='get-thumb'){
            $result =  self::select ( 'id', 'thumb','content')
                ->where('id',$params['id'])->first();
        }

        if($options['task']=='news-get-item'){
            $result =  self::select ('a.name', 'a.id','content','a.category_id','c.name as category_name','a.thumb','a.created','c.display')
                           ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                           ->where('a.status','=','active')
                           ->where('a.id','=',$params['article_id'])
                           ->first(); // lấy 3 phần tử
            if($result)$result=$result->toArray();
        }
        return $result;
    }



}
