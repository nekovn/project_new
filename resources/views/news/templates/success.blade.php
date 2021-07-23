@if (session ('zvn_register_notify'))
    <div class="alert alert-info" role="alert">
        <button type="button"class="close"data-dismiss="alert"aria-label="Close"><span aria-hidden="true">x</span></button>
        <p><strong>{{ session ('zvn_register_notify') }}</strong></p>
        <p><a class="txt1" href="{{route ('auth/login')}}">ログインへ遷移しましょう！</a></p>
    </div>
@endif
