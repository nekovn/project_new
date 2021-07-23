<div class="posts">
    <div class="post_item post_h_large">
        @foreach($item['related_articles'] as $article)
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

