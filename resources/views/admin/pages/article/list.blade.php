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
                         $content         = Hightlight::show($val['content'],$params['search'],'content');
                         $thumb           = Template::showItemThumb ($controllerName,$val['thumb'],$val['name']);
                         $category        = $val['category'];
                         $status          = Template::showItemStatus ($controllerName,$id,$val['status']);
                         $type            = Template::showItemDisplay ($controllerName,$id,$val['type'],'type');
                         $listBtnAction   = Template::showButtonAction ($controllerName,$id);
                   @endphp
                    <tr class="{{$class}} pointer">
                        <td class="">{{$index}}</td>
                        <td>
                            <p><strong>Name:</strong>{!! $name !!}</p>
                            <p><strong>Content:</strong>{!! $content !!}</p>
                        </td>

                        <td width="10%">{!! $thumb !!}</td>

                        <td>{!! $category !!}</td>

                        <td>{!! $type !!}</td>

                        <td width="30%">{!! $status !!}</td>



                        <td class="last" width="10%">
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
