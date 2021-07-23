<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtraModel as MainModel;
use App\Http\Requests\ExtraRequest as MainRequest;

class ExtraController extends Controller
{
    private $pathViewController = "admin.pages.extra.";
    private $controllerName = 'extra';
    private $params         = [];
    private $model;



    public function __construct()
    {
        //share data with all view
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 3;
        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function index(Request $request)
    {
        //  vào resource->views->Slider-> index.blade.php
        // gọi chuẩn kiểu mô hình mvc trong controller gọi model
        // file model chỉ sử lý trong database , còn controller thì lấy ra kết quả dc sử lý trong model

        $this->params['filter']['status'] = $request->input('filter_status','all');
        $this->params['search']['field'] = $request->input('search_field',''); // all id description
        $this->params['search']['value'] = $request->input('search_value','');
        //id 5 => id : field , 5 : value
        $items              = $this->model->listItems ($this->params,['task'=>'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems ($this->params,['task'=>'admin-count-items-group-by-status']);

        return view ($this->pathViewController.'index',[
                'params'            => $this->params,
                'items'             => $items,
                'itemsStatusCount'  => $itemsStatusCount
        ]);
    }
    public function status(Request $request){
        $params['currentStatus'] = $request->status;
        $params['id']            = $request->id;

        $this->model->saveItems($params,['task'=>'change-status']);
         // quay ve trang chu slider vừa hiện lên câu thông báo
        return  redirect ()->route ($this->controllerName)->with('zvn_notify', 'Cập nhập trạng thái thành công!');
    }

    public function delete(Request $request){
        $params['id']            = $request->id;

        $this->model->deleteItems($params,['task'=>'delete-item']);
        // quay ve trang chu slider vừa hiện lên câu thông báo
        return  redirect ()->route ($this->controllerName)->with('zvn_notify', 'Xóa phần tử thành công!');
    }
    public function form(Request $request){
        $item = null;
        if($request->id != null){
            $params['id'] = $request->id;
            $item = $this->model->getItem($params,['task'=>'get-item']);
        }
        return view ($this->pathViewController.'form',[
            'item'  => $item
        ]);
    }
    public function save(MainRequest $request){
        if($request->method ()=='POST'){ //nếu method là post
            $params = $request->all(); // lấy tất cả param dc post qua
            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";
            if($params['id']!=null){    //id tồn tại là trường hợp edit
                $task   = "edit-item";
                $notify = "Cập nhập phần tử thành công !";

            }
            $this->model->saveItems ($params,['task'=>$task]);
            return redirect ()->route ($this->controllerName)->with ('zvn_notify',$notify);
        }

    }
}
