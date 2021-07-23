
@php
    use App\Helpers\Form as FormTemplate;

    $element = [

                    [
                        'element'   =>  Form::text('email', null,['class'=>'form-control','name'=>'email','placeholder'=>'お問い合わせの内容','required'=>true])
                    ],

                    [
                        'element'     =>  '送信',
                        'type'        =>  "btn-submit-contact"
                    ],

                ];
@endphp
<footer class="footer">
    <div class="footer_social">
        <div class="container">
            <div class="row">
                @if(count ($company)>0)
                <div class="col-sm-6 col-md-6 col-lg-5">
                    <div class="footer_support_widget">
                            @php
                                $item               =   $company[0];
                                $title              =   $item['title'];
                                $content            =   $item['content'];
                                $logo               =   asset ('admin/img/company/'.$item['logo']);

                            @endphp
                        <h4 class="text-white">{{$title}}</h4>
                        <a href="#" target="_blank"><img src="{{$logo}}" class="img-fluid mb-3" alt="{{$title}}"></a>
                        {!! $content !!}
                    </div>
                </div>
                @endif
                <div class="col-sm-6 col-lg-3 d-block d-md-none d-lg-block">
                </div>
                    @if(count ($contact)>0)
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="footer_support_widget">
                        @php
                            $item               =   $contact[0];
                            $title              =   $item['title'];
                            $content            =   $item['content'];
                            $social             =   $item['social'];
                            $status             =   $item['status'];
                            $copyright          =   $item['copyright'];

                        @endphp

                        <h4 class="text-white">{{$title}}</h4>
                        <div class="footer_social_widget mb-3">
                           {!! $social !!}
                        </div>
                        <ul class="list-unstyled">
                            {!! $content !!}
                        </ul>
                        @if($status=='active')
                        <h5 class="mt-4 mb-2 text-white">お問い合わせ</h5>
                        <div class="d-flex">

                            {!! Form::open([
                                  'method'            => 'POST',
                                  'url'               => route ("contact/postContact_content"),
                                  'accept-charset'    => 'UTF-8',
                                  'id'                => 'form-email',
                                  'class'             => 'form-inline mailchimp_form',
                            ]) !!}
                            {!! FormTemplate::show_auth($element) !!}
                            {!! Form::close() !!}
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>


        </div>
        <div class="copyright-suki">
          {{$copyright}}
        </div>
    </div>
</footer>
