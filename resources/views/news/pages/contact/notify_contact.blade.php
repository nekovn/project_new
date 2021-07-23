@extends('news.main')
@section('content')
    @include('news.block.slider')
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <h2>この度は弊社サービスにお問い合わせをいただき、誠にありがとうございます。</h2>
                        <p>株式会社suki-vietnam・お客様サポート担当のクオンと申します。</p>
                        <h3>「■{{$content}}」</h3>
                        <span>ご質問いただいた内容につきまして、しばらく回答させていただきますので、お待ちくださいますようお願い申し上げます。</span><br>
                        <span>他にも何かご不明な点などありましたら、お気軽にお問い合わせくださいませ。</span>
                        <p><a href="{{route ('home')}}">ホームへ戻る</a> </p>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                    @include('news.block.latest_posts',['items'=>$itemsLatest])
                    <!-- Advertisement -->
                        <!-- Extra -->
                    @include('news.block.extra',['items'=>$itemsExtra])
                    <!-- Most Viewed -->
                        {{--                                @include('news.block.most_viewed',['itemsMostViewed'=>[]])--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
