<?php

namespace App\Helpers;

use Config;
use Illuminate\Support\Str;

class Url
{
    public  static function linkCategory($id)
    {
      return route ('category/index',[
                          'category_id'=>$id,
                          'category_name'=>'search']);
    }
    public  static function linkArticle($id)
    {
        return route ('article/index',[
            'article_id'=>$id,
            'article_name'=>'title']);
    }


}

//class title icon route-name
//edit
//delete


