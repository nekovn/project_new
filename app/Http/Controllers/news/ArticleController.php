<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\ExtraModel;
use App\Models\ArticleModel;
use App\Models\CompanyModel;
use App\Models\ContactModel;

use Faker\Provider\File;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $pathViewController = "news.pages.article.";
    private $controllerName = 'article';
    private $params         = [];
    private $model;



    public function __construct()
    {
        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function index(Request $request)
    {

        $params['article_id'] =    $request->article_id;

        $articleModel   = new ArticleModel();
        $extraModel     = new ExtraModel();
        $companyModel   = new CompanyModel();
        $contactModel   = new ContactModel();





        $itemsArticle    = $articleModel->getItem ($params,['task'=>'news-get-item']);
        if(empty($itemsArticle)) return redirect ()->route ('home');


        $params['category_id']  =   $itemsArticle['category_id'];

        $itemsArticle['related_articles']    = $articleModel->listItems ($params,['task'=>'news-list-items-related-in-category']);
        $itemsExtra       = $extraModel->listItems (null,['task'=>'news-list-items-extra']);
        $itemsLatest      = $articleModel->listItems (null,['task'=>'news-list-items-latest']);
        $itemsCompany     = $companyModel -> listItems (null,['task'=>'news-list-items-company']);
        $itemsContact     = $contactModel -> listItems (null,['task'=>'news-list-items-contact']);
        return view ($this->pathViewController.'index',[
                'params'            => $this->params,
                'itemsLatest'       => $itemsLatest,
                'itemsExtra'        => $itemsExtra,
                'itemsArticle'      => $itemsArticle,
                'itemsCompany'      => $itemsCompany,
                'itemsContact'      => $itemsContact,

        ]);
    }

}
