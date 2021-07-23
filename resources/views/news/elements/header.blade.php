@php
    use App\Models\CategoryModel as CategoryModel;
    use App\Helpers\Url;
    use App\Helpers\Template as Template;
    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->listItems (null,['task'=>'news-list-items']);
    $xhtmlMenu='';
    $xhtmlMenuAd='';
    $xhtmlMenuMobile   = '';
    $xhtmlInfoUser     ='';
    $xhtmlRegisterUser ='';
    if(count ($itemsCategory)>0){
         $xhtmlMenu.= '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
         $xhtmlMenuMobile .= '<nav class="menu_nav"><ul class="menu_mm">';
         $categoryIdCurrent  = Route::input('category_id');//lấy category_id hiện tại trên url
         foreach ($itemsCategory as $item){
            $link               = Url::linkCategory ($item['id'],$item['name']);
            $classActive        = ($categoryIdCurrent == $item['id'])?'class="active"':'';
            $xhtmlMenu.=sprintf ('<li %s><a href="%s">%s</a></li>',$classActive,$link,$item['name']);
            $xhtmlMenuMobile.=sprintf ('<li class="menu_mm"><a href="%s">%s</a></li>',$link,$item['name']);
         }
         $userInfo  =  session ('userInfo');
         if($userInfo){
              $srcImg          = ($userInfo['avatar']!='')?$userInfo['avatar']:'user.png';
              $avatar          = '<img  style="width:25px;height:25px;border-radius: 50px 20px;"src="'.asset ('admin/img/user/'.$srcImg.'').'" alt="'.$userInfo['username'].'">';
              $xhtmlMenuUser = sprintf ('<li><a href="%s">%s</a></li>',route ('auth/logout'),'ログアウト');
              if($userInfo['level']=='admin'){
                    $xhtmlMenuAd   = sprintf ('<li><a href="%s">%s</a></li>',route ('slider'),'アドミン');
              }
              $xhtmlInfoUser       = sprintf ('<li><a href="%s">%s %s</a><li>','#',$avatar,$userInfo['username']);
         }else{
              $xhtmlMenuUser       = sprintf ('<li><a href="%s">%s</a></li>',route ('auth/login'),'ログイン');
              $xhtmlRegisterUser   = sprintf ('<li><a href="%s">%s</a></li>',route ('auth/register'),'登録');
         }

         $xhtmlMenu.=$xhtmlMenuUser.$xhtmlMenuAd.$xhtmlInfoUser.$xhtmlRegisterUser.'</ul></nav>';
         $xhtmlMenuMobile .=$xhtmlMenuUser.$xhtmlMenuAd.$xhtmlInfoUser.$xhtmlRegisterUser.'</ul></nav>';
    }

@endphp

<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{!! route ('home') !!}">
                                <div class="logo"><span>好き</span>ベトナム</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="logo-vn"><img src="{!! asset ('news/images/suki-vietnam-logo.png') !!}"></div>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>好き</span>ベトナム</div>
                            </a>
                        </div>
                        <!-- Navigation -->

                    {!! $xhtmlMenu !!}
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                                                  aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Menu -->
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    {!! $xhtmlMenuMobile !!}

</div>
