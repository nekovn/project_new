@php
    use App\Helpers\Url;
    $linkCategory       =   Url::linkCategory ($items['category_id'],$items['category_name']);
@endphp
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll"
         data-image-src="{{asset ('news/images/suki-vietnam-background.png')}}"
         data-speed="0.8"></div>
    <div class="home_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title">{{$items['name']}}</div>
                        <div class="breadcrumbs">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="{!! route ('home') !!}">ホーム</a></li>
                                <li><a href="{!! $linkCategory !!}">{{$items['category_name']}}</a></li>
                                <li>{{$items['name']}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
