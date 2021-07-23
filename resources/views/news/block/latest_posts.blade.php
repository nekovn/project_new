<!-- Latest Posts -->
@php
    use App\Helpers\Template as Template;
    use App\Helpers\Url;
@endphp
@if(count ($items)>0)
<div class="sidebar_latest">
    <div class="sidebar_news">速報・新着</div>
    <div class="latest_posts">
        <!-- Latest Post -->
        @foreach($items as $item)
        @php
            $name               =   $item['name'];
            $categoryName       =   $item['category_name'];
            $thumb              =   asset ('admin/img/article/'.$item['thumb']);
            $linkCategory       =   Url::linkCategory ($item['category_id'],$item['category_name']);
            $linkArticle        =   Url::linkArticle ($item['id'],$item['name']);
            $created            =   Template::showDatetimeFrontend($item['created']);
        @endphp
        <div class="latest_post d-flex flex-row align-items-start justify-content-start">
            <div>
                <div class="latest_post_image"><img src="{{$thumb}}"alt="{{$name}}"></div>
            </div>
            <div class="latest_post_content">
                <div class="post_category_small cat_video"><a href="{{$linkCategory}}">{{$categoryName}}</a></div>
                <div class="latest_post_title"><a
                        href="{{$linkArticle}}">{{$name}}</a></div>
                <div class="latest_post_date">{{$created}}</div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endif
