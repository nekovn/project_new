<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefixAdmin = config('zvn.url.prefix_admin');
$prefixNews  = config('zvn.url.prefix_new');

Route::group (['prefix'=>$prefixAdmin,'namespace'=>'admin','middleware'=>['permission.admin']],function (){
    //==========DASHBOARD================//
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

    });
    //============footer==============//
    $prefix         = 'company';
    $controllerName = 'company';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);



        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);


        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('upload', [
            'as' => $controllerName.'/upload',// tên router để gọi
            'uses' => $controller . 'upload' // tên action
        ]);

    });

    //contact
    $prefix         = 'contact';
    $controllerName = 'contact';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);
        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

    });


    //==========Slider================//
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);


        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

    });
    //==========extra================//
    $prefix         = 'extra';
    $controllerName = 'extra';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);


        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

    });

    //==========Category================//
    $prefix         = 'category';
    $controllerName = 'category';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('change-is-home-{is_home}/{id}', [
            'as' => $controllerName.'/is_home',// tên router để gọi
            'uses' => $controller . 'is_home' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('change-display-{display?}/{id?}', [
            'as' => $controllerName.'/display',// tên router để gọi
            'uses' => $controller . 'display' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);


        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

    });

    //==========Article================//
    $prefix         = 'article';
    $controllerName = 'article';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-type-{type?}/{id?}', [
            'as' => $controllerName.'/type',// tên router để gọi
            'uses' => $controller . 'type' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);


        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

        Route::post ('upload', [
            'as' => $controllerName.'/upload',// tên router để gọi
            'uses' => $controller . 'upload' // tên action
        ]);
    });

    //==========User================//
    $prefix         = 'user';
    $controllerName = 'user';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);

        Route::get ('change-type-{level?}/{id?}', [
            'as' => $controllerName.'/level',// tên router để gọi
            'uses' => $controller . 'level' // tên action
        ])->where ('id','[0-9]+');

        Route::get ('change-status-{status}/{id}', [
            'as' => $controllerName.'/status',// tên router để gọi
            'uses' => $controller . 'status' // tên action
        ])->where ('id','[0-9]+');




        //change form
        Route::get ('form/{id?}', [
            'as' => $controllerName.'/form',// tên router để gọi
            'uses' => $controller . 'form' // tên action
        ])->where ('id','[0-9]+');
        //save form
        Route::post ('save', [
            'as' => $controllerName.'/save',// tên router để gọi
            'uses' => $controller . 'save' // tên action
        ]);
        //change password
        Route::post ('change-password', [
            'as' => $controllerName.'/change-password',// tên router để gọi
            'uses' => $controller . 'changePassword' // tên action
        ]);
        //change level
        Route::post ('change-level', [
            'as' => $controllerName.'/change-level',// tên router để gọi
            'uses' => $controller . 'changeLevel' // tên action
        ]);

        Route::get ('delete/{id}', [
            'as' => $controllerName.'/delete',// tên router để gọi
            'uses' => $controller . 'delete' // tên action
        ])->where ('id','[0-9]+');

    });


});

//news

//namespace => news có nghĩa là  folder là news
//news/homecontroller.php,categorycontroller.php
Route::group (['prefix'=>$prefixNews,'namespace'=>'news'],function (){
    //==========HomePage================//
    $prefix         = '';
    $controllerName = 'home';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/', [
            'as' => $controllerName,// tên router
            'uses' => $controller . 'index' // tên action
        ]);


    });
    //=========contact form =======//
    $prefix         = 'post-contact';
    $controllerName = 'contact';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::post ('content', [
            'as' => $controllerName.'/postContact_content',// tên router để gọi
            'uses' => $controller . 'postContact_content' // tên action
        ]);


    });


    //==========Category================//
    $prefix         = 'vietnam';
    $controllerName = 'category';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/{category_name}-{category_id}.html', [
            'as' => $controllerName.'/index',// tên router
            'uses' => $controller . 'index' // tên action
        ])->where ('category_name','[0-9a-zA-Z_-]+')
          ->where ('category_id','[0-9]+');

    });

    //==========Article================//
    $prefix         = 'bai-viet';
    $controllerName = 'article';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/{article_name}-{article_id}.html', [
            'as' => $controllerName.'/index',// tên router
            'uses' => $controller . 'index' // tên action
        ])->where ('article_name','[0-9a-zA-Z_-]+')
            ->where ('article_id','[0-9]+');

    });

    //==========NoTIFY================//
    $prefix         = '';
    $controllerName = 'notify';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/no-permission', [
            'as' => $controllerName.'/noPermission',// tên router
            'uses' => $controller . 'noPermission' // tên action
        ]);

    });
     //========Disclaimer=========//
//    $prefix     = '';
//    $controllerName ='disclaimer';
//    Route::group (['prefix'=>$prefix],function() use ($controllerName){
//       $controller = ucfirst ($controllerName).'Controller@';
//       Route:get('/rules-page',[
//           'as' => $controllerName.'/rules-page',
//            'uses'=> $controller.'/rules-page'
//        ]);
//    });



    //==========Login================//
    $prefix         = '';
    $controllerName = 'auth';
    Route::group (['prefix' => $prefix], function () use ($controllerName) { // để gọi dc biến $prefix trong function static thì gọi use()
        $controller = ucfirst ($controllerName) . 'Controller@';//ucfirst() :: chữ đầu tiên viêt hoa

        Route::get ('/login', [
            'as' => $controllerName.'/login',// tên router
            'uses' => $controller . 'login' // tên action
        ]);//->middleware ('check.login')

        Route::post ('postLogin', [
            'as' => $controllerName.'/postLogin',// tên router để gọi
            'uses' => $controller . 'postLogin' // tên action
        ])->middleware ('check.login');//khai bao cánh cửa middleware

        //==========Logout================//
        Route::get ('/logout', [
            'as' => $controllerName.'/logout',// tên router để gọi
            'uses' => $controller . 'logout' // tên action
        ]);

        //===========Register==============//
        Route::get ('/register', [
            'as' => $controllerName.'/register',// tên router để gọi
            'uses' => $controller . 'register' // tên action
        ]);//
        Route::post ('postRegister', [
            'as' => $controllerName.'/postRegister',// tên router để gọi
            'uses' => $controller . 'postRegister' // tên action
        ]);
        Route::post ('post_forgot_password', [
            'as' => $controllerName.'/post_forgot_password',// tên router để gọi
            'uses' => $controller . 'post_forgot_password' // tên action
        ]);
        Route::get ('forgot_password', [
            'as' => $controllerName.'/forgot_password',// tên router để gọi
            'uses' => $controller . 'forgot_password' // tên action
        ]);
        Route::get ('get_password', [
            'as' => $controllerName.'/get_password',// tên router để gọi
            'uses' => $controller . 'get_password' // tên action
        ]);
        Route::post ('post_new_password', [
            'as' => $controllerName.'/post_new_password',// tên router để gọi
            'uses' => $controller . 'post_new_password' // tên action
        ]);


    });



});





