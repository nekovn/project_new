@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            @php
                $listTitle = Template::showTitleTable($controllerName);
            @endphp
            {!! $listTitle !!}
            </thead>
            <tbody>

            @if (count($items) >0)
                @foreach ($items as $key=>$val)
                   @php
                       $index            = $key+1;
                       $id              = $val['id'];
                       $class           = ($index%2==0)?'even':'odd';
                       $username        = Hightlight::show($val['username'],$params['search'],'username');
                       $fullname        = Hightlight::show($val['fullname'],$params['search'],'fullname');
                       $email           = Hightlight::show($val['email'],$params['search'],'email');
                       $level           = Template::showItemDisplay ($controllerName,$id,$val['level'],'level');
                       $avatar          = Template::showItemThumb ($controllerName,$val['avatar'],$val['name']);
                       $status          = Template::showItemStatus ($controllerName,$id,$val['status']);
                       $createHistory   = Template::showItemHistory ($val['created_by'],$val['created']);
                       $modifiedHistory = Template::showItemHistory ($val['modified_by'],$val['modified']);
                       $listBtnAction   = Template::showButtonAction ($controllerName,$id);
                   @endphp
                    <tr class="{{$class}} pointer">
                        <td class="">{{$index}}</td>
                        <td width="10%">{{$username}}</td>
                        <td width="10%">{{$email}}</td>
                        <td width="10%">{{$fullname}}</td>
                        <td width="20%">{!! $level !!}</td>
                        <td width="10%">{!! $avatar !!}</td>
                        <td width="5%">{!! $status !!}</td>

                        <td>
                           {!! $createHistory !!}
                        </td>
                        <td>
                           {!! $modifiedHistory !!}
                        </td>
                        <td class="last">
                         {!! $listBtnAction  !!}
                        </td>
                    </tr>
                @endforeach

            @else
                @include('admin.templates.list_empty',['colspan'=>6])
            @endif


            </tbody>
        </table>
    </div>
</div>
