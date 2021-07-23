{{--include admin/main--}}
@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    $ButtonSearch = Template::showAreaSearch($controllerName,$params['search']);
@endphp
@section('content')

    @include('admin.templates.page_header',['pageIndex'=>true])
{{--    hiện cau thong bao khi cap nhap thanh cong--}}
    @include('admin.templates.zvn_notify')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-5">{!! $ButtonSearch !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Danh sách'])

            @include('admin.pages.company.list')
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    @if (count($items) >0)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    @include('admin.templates.x_title',['title'=>'Phân trang'])
                </div>
                @include('admin.templates.pagination')
            </div>
        </div>
    </div>
    @endif
@endsection
