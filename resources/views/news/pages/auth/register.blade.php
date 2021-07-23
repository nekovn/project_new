@extends('news.login')
@section('content')
@include('news.templates.error')
@include('news.templates.success')
@include('news.templates.alert')

@php
    use App\Helpers\Form as FormTemplate;

    $element = [
                    [
                        'element'   =>  '登録',
                        'type'      =>  "text-header"

                    ],
                    [
                        'element'   =>  Form::text('username', null,['class'=>'input100','name'=>'username','placeholder'=>'ユーザー名','required'=>true,'autofocus'=>true])

                    ],
                    [
                        'element'   =>  Form::text('fullname', null,['class'=>'input100','name'=>'fullname','placeholder'=>'名前（漢字）','required'=>true,'autofocus'=>true])

                    ],
                    [
                        'element'   =>  Form::text('email', null,['class'=>'input100','name'=>'email','placeholder'=>'メールアドレス','required'=>true,'autofocus'=>true])
                    ],
                    [
                        'element'   =>  Form::password('password',['id'=>'myInput','class'=>"input100",'name'=>'password','placeholder'=>'パスワード','required'=>true,'autofocus'=>true,'data-eye'=>true])

                    ],
                    [
                        'element'   =>  Form::password('password_confirmation',['id'=>'myInput','class'=>"input100",'name'=>'password_confirmation','placeholder'=>'パスワード（確認)','required'=>true,'autofocus'=>true,'data-eye'=>true])

                    ],
                    [
                        'element'   =>  Form::checkbox('showname', '1', null,  ['class' => 'showpass','onclick'=>'myFunction()']),
                        'type'      =>  "btn-showname"

                    ],

                    [
                        'element'     =>  'ログイン',
                        'type'        =>  "btn-submit"
                    ],
                    [
                        'element'   =>  'ホームへ戻る',
                        'type'      =>  "text-footer"

                    ],
                ];
@endphp


    {!! Form::open([
          'method'            => 'POST',
          'url'               => route ("$controllerName/postRegister"),
          'accept-charset'    => 'UTF-8',
           'id'                => 'auth-form',
     ]) !!}

    {!! FormTemplate::show_auth($element) !!}

    {!! Form::close() !!}

@endsection
