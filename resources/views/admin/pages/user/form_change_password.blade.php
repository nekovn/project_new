@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $formInputAttr      =   config('zvn.template.formInput');
    $formLabelAttr      =   config('zvn.template.form_label_edit');

    $inputHiddenID      =   Form::hidden('id', $item['id']);
    $inputHiddenTask    =   Form::hidden('task', 'change-password');


    $element = [
        [
            'label'     =>  Form::label('password', 'Password',$formLabelAttr),
            'element'   =>  Form::password('password', $item['password'], $formInputAttr)
        ],
        [
            'label'     =>  Form::label('password_confirmation', 'Password Confirmation',$formLabelAttr),
            'element'   =>  Form::password('password_confirmation', $item['password'], $formInputAttr)
        ],

        [
            'element'     =>  $inputHiddenID.$inputHiddenTask.Form::submit('Save',['class' => 'btn btn-success']),
            'type'        =>  "btn-submit-edit"
        ]
];


@endphp
<div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.templates.x_title',['title'=>'Form Change Password'])
            <div class="x_content">
                {!! Form::open([
                    'method'            => 'POST',
                    'url'               => route ("$controllerName/change-password"),
                    'accept-charset'    => 'UTF-8',
                    'class'             => 'form-horizontal form-label-left',
                    'id'                => 'main-form'
                    ]) !!}
                {!! FormTemplate::show($element) !!}

                {!! Form::close() !!}
            </div>
        </div>
</div>

