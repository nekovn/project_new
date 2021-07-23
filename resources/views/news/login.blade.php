@include('news.elements.head_login')
<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset ('auth/images/bg-01.jpg')}});">
        <div class="wrap-login100">
            @yield('content')
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
@include('news.elements.script_login')
