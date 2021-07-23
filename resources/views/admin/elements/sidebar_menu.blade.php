<!-- menu profile quick info -->
@php
    $userInfo  =  session ('userInfo');

@endphp
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{asset ('admin/img/user/'.$userInfo['avatar'].'')}}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome!</span>
        <h2>{{$userInfo['username']}}</h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
{{--            <li><a href="{{route ('dashboard')}}"><i class="fa fa-home"></i>Dashboard</a></li>--}}
            <li><a href="{{route ('user')}}"><i class="fa fa-user"></i> User</a></li>
            <li><a href="{{route ('category')}}"><i class="fa fa fa-building-o"></i> Category</a></li>
            <li><a href="{{route ('article')}}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li><a href="{{route ('slider')}}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{route ('extra')}}"><i class="fa fa-picture-o" aria-hidden="true"></i>Extra</a></li>
            <li><a href="{{route ('company')}}"><i class="fa fa-asterisk" aria-hidden="true"></i>Company</a></li>
            <li><a href="{{route ('contact')}}"><i class="fa fa-phone" aria-hidden="true"></i>Contact</a></li>

        </ul>
    </div>
</div>
<!-- /sidebar menu -->

