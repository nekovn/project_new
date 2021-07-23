<?php

namespace App\Models;



use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
class UserModel extends AdminModel
{
    public function     __construct(array $attributes = [])
    {
        $this->table        = "user";
        $this->folderUpdate = "img/user";
        $this->fieldSearchAccepted        = [ 'id','username','email','fullname'];
        $this->crudNotAccepted            = [ '_token','avatar_current','password_confirmation','task','checkbox'];




        parent::__construct ($attributes);
    }

    public function listItems($params = null, $options = null)
    {
        //params chứa ham số dành cho câu truy vấn
        //options dùng để viết dc nhiều trường hợp sử lý khác nhau
        $result = null;
        if ($options['task'] == "admin-list-items") {
            //ko nên select * vi lần sau ta gọi nữa thì nó lại select tất cả nữa
            $query = self::select ('username', 'id', 'email', 'fullname', 'avatar', 'created','level', 'created_by', 'modified', 'modified_by', 'status');

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
            if($options['task']=="change-level"){
                self::where('id', $params['id'])
                    ->update(['level' => $params['currentLevel']]);
            }
        if($options['task'] == 'add-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            $params['created_by']   = $name;
            $params['created']      = date ('y-m-d');
            //update tấm hình mới lên
            $params['avatar']       = $this->uploadThumb ($params['avatar']);
            //123456 mã hóa nó bằng md5
            $params['password']     = md5($params['password']);
            $params = $this->prepareParams ($params);



            self::insert($params); //upload vao database

        }
        //edit item
        if($options['task'] == 'edit-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            if(!empty($params['avatar'])){ //nếu mà tồn tại thumb thì biết là đang upload hình mới lên
                //khi edit upload hình mới lên thì phải xóa hình cũ đi
                $this->deleteThumb($params['avatar_current']);
                //update tấm hình mới lên
                $params['avatar'] = $this->uploadThumb ($params['avatar']);
            }
            $params['modified_by']  = $name;
            $params['modified']     = date ('y-m-d');
            //xóa các key ko cần thiết
            $params = $this->prepareParams ($params);
            self::where('id',$params['id'])->update($params);
        }
        //edit password
        if($options['task'] == 'change-password'){
            $password = md5 ($params['password']);
            self::where('id',$params['id'])->update(['password'=>$password]);
        }
        //edit level post
        if($options['task'] == 'change-level-post'){
            self::where('id',$params['id'])->update(['level'=>$params['level']]);
        }

        //register user
        if($options['task']=='add-item-register'){
            $params['created_by']   = $params['username'];
            $params['created']      = date ('y-m-d');
            //update tấm hình mới lên
            $params['avatar']       = '';
            $params['level']        = 'member';
            $params['status']       = 'active';
            //123456 mã hóa nó bằng md5
            $params['password']     = md5($params['password']);
            $params = $this->prepareParams ($params);
            self::insert($params); //upload vao database

        }
        //save forget new password
        if($options['task']=='save-new-password'){
                $password = md5 ($params['password']);
                self::where('email',$params['email'])
                    ->where('code',$params['code'])
                    ->update(['password'=>$password]);


        }

    }

    public function deleteItems($params = null ,$options = null){
        if($options['task'] == 'delete-item'){
            $item = self::getItem ($params,['task'=>'get-avatar']);
            $this->deleteThumb($item['avatar']);
            self::where('id', $params['id'])->delete();
        }
    }


    public function getItem($params = null ,$options = null){
        $result = null;
        if($options['task'] == 'get-item'){
            $result =  self::select ('username', 'id', 'email', 'fullname', 'avatar', 'status','level')
                    ->where('id',$params['id'])->first();
        }
        if($options['task']=='get-avatar'){
            $result =  self::select ( 'id', 'avatar')
                ->where('id',$params['id'])->first();
        }
        if($options['task']=='auth-login'){
            $result =  self::select ( 'id', 'username','fullname','email','level','avatar','status')
                            ->where('email',$params['email'])
                            ->where('password',md5 ($params['password']))
                            ->first();
            if($result)$result = $result->toArray();
        }

        if($options['task']=='auth-password-forget'){
            $result =  self::select (  'id', 'username')
                ->where('email',$params['email'])
                ->first();
            if($result)$result = $result->toArray();
        }

        return $result;
    }



}
