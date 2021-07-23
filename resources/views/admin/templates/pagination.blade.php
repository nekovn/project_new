@php
    $totalItems         = $items->total();//lấy tổng số phần tử
    $totalPage          = $items->lastPage();//lấy tổng số trang
    $totalItemsPerPage  = $items->perPage();//tổng phần tử trên 1trang
@endphp
<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            Tổng số phần tử trên 1 trang: <span class="label label-info label-pagination">{{$totalItemsPerPage}}</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng số phần tử :<span class="label label-success label-pagination">{{$totalItems}}</span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng số trang :<span class="label label-danger label-pagination">{{$totalItems}}</span>
        </div>
        <div class="col-md-6">
            <nav aria-label="Page navigation example">
{{--                 nếu đặt là paginator thì ko cần truyền vào tham số thứ 2 cũng dc
     còn nếu paginator 123,items32 gì đó thì pải truyền vào tham số t2 tên của muốn đặt--}}
{{--                {{ $items->links('pagination.pagination_backend',['paginator'=>$items]) }}--}}

                {{--  ->appends(request ()->input ()) : lấy url hiện tại appends vào links
                        :để giữ nguyên phàn search khi qua trang khác--}}

                {{ $items->appends(request ()->input ())->links('pagination.pagination_backend',['paginator'=>$items]) }}
            </nav>
        </div>
    </div>
</div>
