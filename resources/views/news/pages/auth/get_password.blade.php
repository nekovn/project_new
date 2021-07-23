@extends('news.login')
@section('content')
@include('news.templates.error')
@include('news.templates.success')
@include('news.templates.alert')
@php
    use App\Helpers\Form as FormTemplate;
    $inputCode  = Form::hidden('code', $code);
    $inputEmail = Form::hidden('email', $email);
    $element = [
                    [
                        'element'   =>  '新しいパスワードを入力してください！',
                        'type'      =>  "text-header",
                        'css'       =>  "font-size: 20px;"

                    ],

                    [
                        'element'   =>  Form::text('email', $email,['class'=>'input100','name'=>'email','placeholder'=>'メールアドレス','required'=>true,'autofocus'=>true])
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
                        'element'     =>  $inputCode.$inputEmail.'送信',
                        'type'        =>  "btn-submit"
                    ],

                ];
@endphp

    {!! Form::open([
          'method'            => 'POST',
          'url'               => route ("$controllerName/post_new_password"),
          'accept-charset'    => 'UTF-8',
           'id'                => 'auth-form',
     ]) !!}

    {!! FormTemplate::show_auth($element) !!}

    {!! Form::close() !!}

@endsection
