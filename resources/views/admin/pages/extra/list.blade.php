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
                       $index           = $key+1;
                       $id              = $val['id'];
                       $class           = ($index%2==0)?'even':'odd';
                       $name            = Hightlight::show($val['name'],$params['search'],'name');
                       $link            = Hightlight::show($val['link'],$params['search'],'link');
                       $subtitle        = Hightlight::show($val['subtitle'],$params['search'],'subtitle');
                       $thumb           = Template::showItemThumb ($controllerName,$val['thumb'],$val['name']);
                       $status          = Template::showItemStatus ($controllerName,$id,$val['status']);
                       $sale_off        = $val['sale_off'];
                       $listBtnAction   = Template::showButtonAction ($controllerName,$id);
                   @endphp
                    <tr class="{{$class}} pointer">
                        <td class="">{{$index}}</td>
                        <td width="30%">
                            <p><strong>Name:</strong>{!! $name !!}</p>
                            <p><strong>Link:</strong>{!! $link !!}</p></td>
                        <td>{!! $subtitle !!}</td>
                        <td width="10%">{!! $thumb !!}</td>
                        <td>{!! $status !!}</td>
                        <td>{{$sale_off}}</td>
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
