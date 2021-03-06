{{--include admin/main--}}
@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formInputAttr      =   config('zvn.template.formInput');
    $formLabelAttr      =   config('zvn.template.formLabel');
    $statusValue        =   ['default'=>'Select status','active'=>config ('zvn.template.status.active.name'),'inactive'=>config ('zvn.template.status.inactive.name')];
    $inputHiddenID      =   Form::hidden('id', $item['id']);
    $inputHiddenThumb   =   Form::hidden('thumb_current', $item['thumb']);


    $element = [
        [
            'label'     =>  Form::label('name', 'Name',$formLabelAttr),
            'element'   =>  Form::text('name', $item['name'], $formInputAttr)
        ],

        [
            'label'     =>  Form::label('subtitle', 'Content', $formLabelAttr),
            'element'   =>  Form::text('subtitle', $item['subtitle'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('status', 'Status',$formLabelAttr),
            'element'   =>  Form::select('status', $statusValue, $item['status'],$formInputAttr)
        ],
        [
            'label'     =>  Form::label('sale_off', 'Sale',$formLabelAttr),
            'element'   =>  Form::text('sale_off', $item['sale_off'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('link', 'Link',$formLabelAttr),
            'element'   =>  Form::text('link', $item['link'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('thumb', 'Thumb', $formLabelAttr),
            'element'   =>  Form::file('thumb',$formInputAttr),
            'thumb'     =>  (!empty($item['id']))?Template::showItemThumb($controllerName,$item['thumb'],$item['name']):null,
            'type'        =>  "thumb"
        ],
        [
            'element'     =>  $inputHiddenID.Form::submit('Save',['class' => 'btn btn-success']).$inputHiddenThumb,
            'type'        =>  "btn-submit"
        ]
];


@endphp
@section('content')

    @include('admin.templates.page_header',['pageIndex'=>false])

{{--    hi???n th??? c??u error khi validate--}}
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
                        'enctype'           => 'multipart/form-data', //khi update l??c n??o c??ng ph???i c?? multipart/form-data
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
