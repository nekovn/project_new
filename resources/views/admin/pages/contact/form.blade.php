{{--include admin/main--}}
@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formInputAttr      =   config('zvn.template.formInput');
    $formLabelAttr      =   config('zvn.template.formLabel');
    $formCkeditor       =   config ('zvn.template.form_ckeditor');
    $statusValue        =   ['default'=>'Select status','active'=>config ('zvn.template.status.active.name'),'inactive'=>config ('zvn.template.status.inactive.name')];
    $inputHiddenID      =   Form::hidden('id', $item['id']);

    $content            =
    $element = [
        [
            'label'     =>  Form::label('title', 'Title',$formLabelAttr),
            'element'   =>  Form::text('title', $item['title'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('content', 'Content',$formLabelAttr),
            'element'   =>  Form::textArea('content', $item['content'],$formInputAttr)
        ],
        [
            'label'     =>  Form::label('social', 'Social',$formLabelAttr),
            'element'   =>  Form::textArea('social', $item['social'],$formInputAttr)
        ],

        [
            'label'     =>  Form::label('copyright', 'Copyright',$formLabelAttr),
            'element'   =>  Form::text('copyright', $item['copyright'], $formInputAttr)
        ],

        [
            'label'     =>  Form::label('status', 'Status',$formLabelAttr),
            'element'   =>  Form::select('status', $statusValue, $item['status'],$formInputAttr)
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
