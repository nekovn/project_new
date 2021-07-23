<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    private $pathViewController = "admin.dashboard.";
    private $controllerName = 'dashboard';



    public function __construct()
    {
        //share data with all view
        view()->share ('controllerName', $this->controllerName);//cach viet thu 2
    }

    public function index()
    {
        //  vào resource->views->Slider-> index.blade.php
        return view ($this->pathViewController.'index',[

        ]);
    }



}
