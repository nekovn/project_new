@extends('news.main')
@section('content')
    @include('news.block.slider')
    <div class="content_container">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <h3>あなたは権利がございませんので、この機能にアクセスできません!!</h3>
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
