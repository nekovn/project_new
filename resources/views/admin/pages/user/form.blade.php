{{--include admin/main--}}
@extends('admin.main')

@section('content')

    @include('admin.templates.page_header',['pageIndex'=>false])

    {{--    hiển thị câu error khi validate--}}
    @include('admin.templates.error')

    <!--box-lists-->
    @if($item['id'])
        {{--        edit--}}
        <div class="row">
        @include('admin.pages.user.form_info')
        @include('admin.pages.user.form_change_password')
        @include('admin.pages.user.form_change_level')
        </div>
    @else
        {{--        nếu như ko tồn tại id thì nó là add--}}
        @include('admin.pages.user.form_add')
    @endif


@endsection
