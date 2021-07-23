<?php

namespace App\Helpers;

use Config;

class Form
{

    //show form admin
    public static function Show($elements)
    {
        $xhtml = null;
        foreach ($elements as $element) {
            $xhtml .= self::formGroup ($element);

        }

        return $xhtml;
    }


    public static function formGroup($element, $param = null)
    {
        $type = isset($element['type']) ? $element['type'] : 'input';
        $xhtml = null;

        switch ($type) {
            case 'input' :
                $xhtml .= sprintf ('<div class="form-group">
                                            %s
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                            %s
                                            </div>
                                     </div>', $element['label'], $element['element']);
                break;
            case 'btn-submit' :
                $xhtml .= sprintf ('<div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                           %s
                                        </div>
                                    </div>', $element['element']);
                break;
            case 'btn-submit-edit' :
                $xhtml .= sprintf ('<div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                           %s
                                        </div>
                                    </div>', $element['element']);
                break;
            case 'thumb' :
                $xhtml .= sprintf ('<div class="form-group">
                                        %s
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            %s
                                            <p style="margin-top: 50px;">%s</p>
                                        </div>
                                    </div>', $element['label'], $element['element'], $element['thumb']);
                break;
            case 'avatar' :
                $xhtml .= sprintf ('<div class="form-group">
                                        %s
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            %s
                                            <p style="margin-top: 50px;">%s</p>
                                        </div>
                                    </div>', $element['label'], $element['element'], $element['avatar']);
                break;
            case 'logo' :
                $xhtml .= sprintf ('<div class="form-group">
                                        %s
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            %s
                                            <p style="margin-top: 50px;">%s</p>
                                        </div>
                                    </div>', $element['label'], $element['element'], $element['logo']);
                break;

        }
        return $xhtml;
    }


    //show form auth
    public static function show_auth($elements)
    {
        $xhtml = null;
        foreach ($elements as $element) {
            $xhtml .= self::FormAuth ($element);

        }

        return $xhtml;
    }

    public static function formAuth($element, $param = null)
    {
        $type  = isset($element['type']) ? $element['type'] : 'input';
        $css   = isset($element['css']) ? $element['css'] : '';
        $xhtml = null;

        switch ($type) {
            case 'text-header' :
                $xhtml .= sprintf ('<span class="login100-form-logo"><a href="%s"><i style="font-size: 90px"class="zmdi zmdi-landscape"></i></a></span>
                                    <span style="%s"class="login100-form-title p-b-34 p-t-27">%s</span>',route ('home'),$css, $element['element']);
                break;
            case 'input' :
                $xhtml .= sprintf ('<div class="wrap-input100 validate-input" data-validate="Enter username">
                                        %s
                                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                                    </div>', $element['element']);
                break;
            case 'btn-submit' :
                $xhtml .= sprintf ('<div  class="container-login100-form-btn">
                                        <button class="login100-form-btn">%s</button>
                                     </div>', $element['element']);
                break;
            case 'btn-submit-contact' :
                $xhtml .= sprintf ('<button type="submit" class="btn btn-sm btn-thm dbxshad btn-subscribe-email mt-2 mt-md-0 ml-md-2 py-2">%s</button>', $element['element']);
                break;
            case 'btn-showname' :
                $xhtml .= sprintf ('%s %s', $element['element'],'パスワード表示');
                break;
            case 'text-footer' :
                $xhtml .= sprintf (' <div class="text-center p-t-90">
                                        <a class="txt1" href="%s">%s</a>
                                    </div>',route ('home'),$element['element']);
                break;
            case 'text-forgot' :
                $xhtml .= sprintf (' <div class="text-center p-t-90">
                                        <a class="txt1" href="%s">%s</a>
                                    </div>',route ('auth/forgot_password'),$element['element']);
                break;



        }
        return $xhtml;
    }
}



