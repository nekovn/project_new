@if(count ($items)>0)
@php
        $item               =   $items[0];
        $name               =   $item['name'];
        $subtitle           =   $item['subtitle'];
        $sale_off           =   $item['sale_off'];
        $thumb              =   asset ('admin/img/extra/'.$item['thumb']);
        $linkExtra          =   $item['link'];
@endphp

<div class="sidebar_extra">
    <a href="{{$linkExtra}}" target="_blank">
        <div class="sidebar_news">{{$name}}</div>
        <div class="sidebar_extra_container">
            <div class="background_extra"
                 style="background-image:url({{$thumb}})"></div>
            <div class="sidebar_extra_content">
                @if($sale_off>0)
                <div class="sidebar_extra_title">{{$sale_off}}%</div>
                <div class="sidebar_extra_title_off">割引</div>
                @endif
                <div class="sidebar_extra_subtitle">{{$subtitle}}</div>
            </div>
        </div>
    </a>
</div>
@endif
