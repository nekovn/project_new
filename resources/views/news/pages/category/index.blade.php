@extends('news.main')
@section('content')

    <!-- Content Container -->
    <div class="section-category">
        @include('news.block.breadcrumb',['items'=>$itemsCategory])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            @include('news.pages.category.child-index.category',['item'=>$itemsCategory])
                        </div>
                        <!-- Sidebar -->
                        <div class="col-lg-3">
                            <div class="sidebar">
                            @include('news.block.latest_posts',['items'=>$itemsLatest])
                            <!-- Advertisement -->
                                <!-- Extra -->
                            @include('news.block.extra',['items'=>$itemsExtra])
                            <!-- Most Viewed -->
{{--                            @include('news.block.most_viewed',['itemsMostViewed'=>[]])--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
