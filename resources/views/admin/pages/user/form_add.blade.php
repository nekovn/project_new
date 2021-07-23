@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formInputAttr      =   config('zvn.template.formInput');
    $formLabelAttr      =   config('zvn.template.formLabel');
    $statusValue        =   ['default'=>'Select status','active'=>config ('zvn.template.status.active.name'),'inactive'=>config ('zvn.template.status.inactive.name')];
    $levelValue         =   ['default'=>'Select level','admin'=>config ('zvn.template.level.admin.name'),'member'=>config ('zvn.template.level.member.name')];
    $inputHiddenID      =   Form::hidden('id', $item['id']);
    $inputHiddenThumb   =   Form::hidden('avatar_current', $item['avatar']);
    $inputHiddenTask    =   Form::hidden('task', 'add');


    $element = [
        [
            'label'     =>  Form::label('username', 'Username',$formLabelAttr),
            'element'   =>  Form::text('username', $item['username'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('email', 'email', $formLabelAttr),
            'element'   =>  Form::text('email', $item['email'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('fullname', 'FullName',$formLabelAttr),
            'element'   =>  Form::text('fullname', $item['fullname'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('password', 'Password',$formLabelAttr),
            'element'   =>  Form::password('password', $item['password'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('password_confirmation', 'Password Confirmation',$formLabelAttr),
            'element'   =>  Form::password('password_confirmation', $item['password'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('status', 'Status',$formLabelAttr),
            'element'   =>  Form::select('status',$statusValue, $item['status'],$formInputAttr)
        ],
        [
            'label'     =>  Form::label('level', 'Level',$formLabelAttr),
            'element'   =>  Form::select('level',$levelValue, $item['level'],$formInputAttr)
        ],

        [
            'label'     =>  Form::label('avatar', 'Avatar', $formLabelAttr),
            'element'   =>  Form::file('avatar',$formInputAttr),
            'avatar'    =>  (!empty($item['id']))?Template::showItemThumb($controllerName,$item['avatar'],$item['name']):null,
            'type'      =>  "avatar"
        ],
        [
            'element'     =>  $inputHiddenID.$inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success']).$inputHiddenThumb,
            'type'        =>  "btn-submit"
        ]
];


@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title'=>'Form Add'])
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
