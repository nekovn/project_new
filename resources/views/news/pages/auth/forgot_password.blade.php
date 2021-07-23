@extends('news.login')
@section('content')
@include('news.templates.error')
@include('news.templates.success')
@include('news.templates.alert')
@php
        use App\Helpers\Form as FormTemplate;

        $element = [
                        [
                            'element'   =>  'メールアドレスを入力してください！',
                            'type'      =>  "text-header",
                            'css'       =>  "font-size: 20px;"

                        ],

                        [
                            'element'   =>  Form::text('email', null,['class'=>'input100','name'=>'email','placeholder'=>'メールアドレス','required'=>true,'autofocus'=>true])
                        ],

                        [
                            'element'     =>  '送信',
                            'type'        =>  "btn-submit"
                        ],

                    ];
    @endphp
    {!! Form::open([
          'method'            => 'POST',
          'url'               => route ("$controllerName/post_forgot_password"),
          'accept-charset'    => 'UTF-8',
           'id'                => 'auth-form',
     ]) !!}

    {!! FormTemplate::show_auth($element) !!}

    {!! Form::close() !!}

@endsection
