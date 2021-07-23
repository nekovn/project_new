{{--include admin/main--}}
@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formInputAttr      =   config('zvn.template.formInput');
    $formLabelAttr      =   config('zvn.template.formLabel');
    $statusValue        =   ['default'=>'Select status','active'=>config ('zvn.template.status.active.name'),'inactive'=>config ('zvn.template.status.inactive.name')];
    $isHomeValue        =   ['default'=>'Select home','1'=>config ('zvn.template.is_home.1.name'),'0'=>config ('zvn.template.is_home.0.name')];
    $displayValue       =   ['default'=>'Select display','list'=>config ('zvn.template.display.list.name'),'grid'=>config ('zvn.template.display.grid.name')];
    $inputHiddenID      =   Form::hidden('id', $item['id']);


    $element = [
        [
            'label'     =>  Form::label('name', 'Name',$formLabelAttr),
            'element'   =>  Form::text('name', $item['name'], $formInputAttr)
        ],

        [
            'label'     =>  Form::label('status', 'Status',$formLabelAttr),
            'element'   =>  Form::select('status', $statusValue, $item['status'],$formInputAttr)
        ],
        [
            'label'     =>  Form::label('display', 'Kiểu hiển thị',$formLabelAttr),
            'element'   =>  Form::select('display', $displayValue, $item['display'],$formInputAttr)
        ],
        [
            'label'     =>  Form::label('is_home', 'Hiển thị home',$formLabelAttr),
            'element'   =>  Form::select('is_home', $isHomeValue, $item['is_home'],$formInputAttr)
        ],

        [
            'element'     =>  $inputHiddenID.Form::submit('Save',['class' => 'btn btn-success']),
            'type'        =>  "btn-submit"
        ]
];


@endphp
@section('content')

    @include('admin.templates.page_header',['pageIndex'=>false])

{{--    hiển thị câu error khi validate--}}
    @include('admin.templates.error')
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title',['title'=>'Form'])
                <div class="x_content">
                    {!! Form::open([
                        'method'            => 'POST',
                        'url'               => route ("$controllerName/save"),
                        'accept-charset'    => 'UTF-8',
                        'enctype'           => 'multipart/form-data', //khi update lúc nào cũng phải có multipart/form-data
                        'class'             => 'form-horizontal form-label-left',
                        'id'                => 'main-form'
                        ]) !!}
                        {!! FormTemplate::show($element) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
