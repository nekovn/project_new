@php
    $name               =   $item['name'];
    $thumb              =   asset ('admin/img/article/'.$item['thumb']);
    $class              =   'phamcuong';
    $attr               =   '';
    if(!empty($type) && $type == 'single'){
        $class  =   'img-fluid w-100 fix-image';
        $attr   =   'width: 848px;height: 521px';
    }
@endphp
<div class="post_image">
    <img style="{{$attr}}" src="{{$thumb}}"alt="{{$name}}"class="{{$class}}" >
</div>
