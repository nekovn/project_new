<?php

namespace App\Helpers;

use Config;

class Template
{
    public static function showItemHistory($by, $time)
    {
        //sprintf():Viết chuỗi được định dạng thành biến
        $xhtml = sprintf (
            '<p><i class="fa fa-user"></i> %s</p>
                    <p><i class="fa fa-clock-o"></i> %s</p>', $by, date ((Config::get ('zvn.format.short_time')), strtotime ($time)));
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmplStatus = Config::get ('zvn.template.status');
        //kiểm tra xem status truyền vào có nằm trong key của array tmlStatus ko
        $statusValue = array_key_exists ($status, $tmplStatus) ? $status : 'default';
        $currentTemplateStatus = $tmplStatus[$statusValue];
        $link = route ($controllerName . '/status', ['status' => $status, 'id' => $id]);

        $xhtml = sprintf ('<a href="%s" type="button" class="btn btn-round %s"> %s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;

    }


    public static function showItemIsHome($controllerName, $id, $isHomeValue)
    {
        $tmplIsHome  = Config::get ('zvn.template.is_home');
        //kiểm tra xem status truyền vào có nằm trong key của array tmlStatus ko
        $isHomeValue = array_key_exists ($isHomeValue, $tmplIsHome) ? $isHomeValue : '0';
        $currentTemplateIsHome = $tmplIsHome[$isHomeValue];
        $link = route ($controllerName . '/is_home', ['is_home' => $isHomeValue, 'id' => $id]);

        $xhtml = sprintf ('<a href="%s" type="button" class="btn btn-round %s"> %s</a>', $link, $currentTemplateIsHome ['class'], $currentTemplateIsHome ['name']);
        return $xhtml;

    }

    public static function showItemDisplay($controllerName, $id, $displayValue,$filedName)
    {
        $tmplDisplay  = Config::get ('zvn.template.'.$filedName);
        //kiểm tra xem status truyền vào có nằm trong key của array tmlStatus ko
        $displayValue = array_key_exists ($displayValue, $tmplDisplay) ? $displayValue : 'list';
//        $currentTemplateDisplay = $tmplDisplay[$displayValue];
        $link = route ($controllerName . '/'.$filedName, [$filedName => 'value_new', 'id' => $id]);

        $xhtml = sprintf ('<select name="select_change_attr" data-url="%s"class="form-control">', $link);

        foreach ($tmplDisplay as $key => $value){
            $xhtmlSelected = '';
            if($key==$displayValue) $xhtmlSelected = 'selected="selected"';
            $xhtml.= sprintf ('<option value="%s" %s>%s</option>',$key,$xhtmlSelected,$value['name']);

        }
        $xhtml.='</select>';
        return $xhtml;

    }



    public static function showTitleTable($controllerName)
    {
        $tmplTitle = Config::get('zvn.template.titleInAreaTable');

        $titleInArea = Config::get('zvn.config.titleInAreaTable');
        $controllerName = (array_key_exists ($controllerName, $titleInArea)) ? $controllerName : 'default';

        $xhtml = '<tr class="headings">';
        $listTitle = $titleInArea[$controllerName];
        foreach ($listTitle as $title) {
            $currentTitle = $tmplTitle[$title];
            $xhtml .= sprintf ('<th class="column-title"> %s</th>', $currentTitle['name']);
        }
        $xhtml .= '</tr>';
        return $xhtml;

    }

    public static function showItemThumb($controlerName, $thumbName, $thumbAlt)
    {
        $srcName = 'admin/img/' . $controlerName . '/' . $thumbName;
        $xhtml = sprintf (
            '<img src=" %s" alt=" %s" class="zvn-thumb">',asset ( $srcName), $thumbAlt);
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        //thu 1: dat cac properties
        $tmplButton = Config::get('zvn.template.button');
        // thu 2 : neu slider thi hien nut edit ,delete , con neu category thi hien nut edit delete
        $buttonInArea = Config::get('zvn.config.button');
        $controllerName = (array_key_exists ($controllerName, $buttonInArea)) ? $controllerName : 'default';

        $xhtml = '<div class="zvn-box-btn-filter">';
        $listButton = $buttonInArea[$controllerName];//['edit','delete']
        foreach ($listButton as $btn) {
            $currentButton = $tmplButton[$btn];
            $link = route ($controllerName.$currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf ('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip"
                                      data-placement="top" data-original-title="%s">
                                      <i class="fa %s"></i>
                                      </a>', $link, $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }
        $xhtml .= '</div>';
        return $xhtml;
    }

    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus,$paramsSearch)
    {
        $xhtml = null;
        if (count ($itemsStatusCount) > 0) {
            $tmplStatus = Config::get ('zvn.template.status');
            array_unshift ($itemsStatusCount, [
                //array_column($array,'count'):lấy cột count trong mãng $array và trả vể mãng colum đó
                //array_sum(): cộng 2 mãng có value lại với nhau
                'count' => array_sum (array_column ($itemsStatusCount, 'count')),
                'status' => 'all'
            ]);// thêm mãng mới  vào trên cùng của mãng $countBystatus
            foreach ($itemsStatusCount as $item) {
                //$value['status'] => active , inactive
                $statusValue = $item['status'];
                //kiểm tra $key của $item có tồn tại trong $tmpStatus ko
                $statusValue = array_key_exists ($statusValue, $tmplStatus) ? $statusValue : 'default';
                $currentTemplateStatus = $tmplStatus[$statusValue];
                $link = route ($controllerName) . "?filter_status=" . $statusValue; // truyền url change status
                //neu nhu người dùng search thì sữa lại url để nó giữ lại giá trị đã search trong mục tìm kiếm
                if($paramsSearch['value']!=''){
                    $link .= "&search_field=".$paramsSearch['field']."&search_value=".$paramsSearch['value'];
                }
                $class = ($currentFilterStatus == $statusValue) ? 'btn-danger' : 'btn-success';
                $xhtml .= sprintf ('<a href="%s" type="button" class="btn %s">
                                        %s <span class="badge bg-white">%s</span>
                                        </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }


        }


        return $xhtml;
    }

    public static function showAreaSearch($controllerName,$paramsSearch)
    {

        $xhtml = null;
        $tmplField = Config::get('zvn.template.search');
        $fieldInController = Config::get('zvn.config.search');
        $controllerName = array_key_exists ($controllerName,$fieldInController)?$controllerName:'default';
        $xhtmlFiled = null;

        foreach ($fieldInController[$controllerName] as $field){ // all , id
            $xhtmlFiled.=sprintf ('<li><a href="#"class="select-field" data-field="%s">%s</a></li>',$field,$tmplField[$field]['name']);
        }
        //kiểm tra xem params filed có nằm trong mãng slider hay ko
        $searchField = (in_array ($paramsSearch['field'],$fieldInController[$controllerName]))?$paramsSearch['field']:'all';
        $xhtml .= sprintf ( '<div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button"
                                            class="btn btn-default dropdown-toggle btn-active-field"
                                            data-toggle="dropdown" aria-expanded="false">
                                        %s <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        %s


                                    </ul>
                                </div>
                                <input type="text" class="form-control" name="search_value" value="%s">
                                <input type="hidden" name="search_field" value="%s">
                                <span class="input-group-btn">
                                    <button id="btn-clear" type="button" class="btn btn-success"
                                            style="margin-right: 0px">Xóa tìm kiếm</button>
                                    <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                                    </span>

                            </div>',$tmplField[$searchField]['name'],$xhtmlFiled,$paramsSearch['value'],$searchField);

        return $xhtml;
    }

    public static function showDatetimeFrontend($dateTime){
        return  date_format (date_create ($dateTime),Config::get('zvn.format.short_time'));
    }
    public static function showContent($content,$length,$prefix='...'){

            if(is_numeric ($length)){
                $prefix     =   ($length==0)?'':$prefix;
                $content    =   str_replace (['<p>','</p>'],'',$content);//xóa những thẻ p
                //cắt các khoảng trắng thành 1 khoảng trắng
                $str    = html_entity_decode($content);//xóa các thẻ &nbsp;
                return preg_replace ('/\s+?(\s+)?$/','',mb_substr ($str,0,$length)).$prefix;
            }
            if(is_string ($length)){
                return $content;
            }




    }


}

//class title icon route-name
//edit
//delete


