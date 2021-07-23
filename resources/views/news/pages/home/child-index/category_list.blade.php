@if(!empty($item['articles']))
<div class="technology">
    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
        <div>
            <div class="section_title">{{ $item['name'] }}</div>
        </div>
        <div class="section_bar"></div>
    </div>

    <div class="technology_content">
        <div class="post_item post_h_large">
            @foreach($item['articles'] as $article)
                <div class="row">
                    <div class="col-lg-5">
                        @include('news.partials.article.image',['item'=>$article])
                    </div>
                    <div class="col-lg-7">
                        @include('news.partials.article.content',['item'=>$article,'lengthContent'=>150,'showCategory'=>false])
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endif
