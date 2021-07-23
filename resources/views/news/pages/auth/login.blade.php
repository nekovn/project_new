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
                        'element'   =>  Form::text('email', null,['class'=>'input100','name'=>'email','placeholder'=>'メールアドレス','required'=>true,'autofocus'=>true])
                    ],

                    [
                        'element'   =>  Form::password('password',['id'=>'myInput','class'=>"input100",'name'=>'password','placeholder'=>'パスワード','required'=>true,'autofocus'=>true,'data-eye'=>true])

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
                        'element'   =>  'パスワード忘れ',
                        'type'      =>  "text-forgot"

                    ],
                ];
@endphp
    {!! Form::open([
          'method'            => 'POST',
          'url'               => route ("$controllerName/postLogin"),
          'accept-charset'    => 'UTF-8',
           'id'                => 'auth-form',
     ]) !!}

    {!! FormTemplate::show_auth($element) !!}

    {!! Form::close() !!}

@endsection
