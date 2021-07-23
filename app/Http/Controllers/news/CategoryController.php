<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\CompanyModel;
use App\Models\ExtraModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Models\ContactModel;

use Faker\Provider\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $pathViewController = "news.pages.category.";
    private $controllerName = 'category';
    private $params         = [];
    private $model;



    public function __construct()
    {
        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function index(Request $request)
    {

        $params['category_id'] =    $request->category_id;
        $articleModel   = new ArticleModel();
        $extraModel     = new ExtraModel();
        $categoryModel  = new CategoryModel();
        $companyModel   = new CompanyModel();
        $contactModel   = new ContactModel();




        $itemsCategory    = $categoryModel->getItem ($params,['task'=>'news-get-item']);
        if(empty($itemsCategory)) return redirect ()->route ('home');
        $itemsExtra       = $extraModel->listItems (null,['task'=>'news-list-items-extra']);
        $itemsLatest      = $articleModel->listItems (null,['task'=>'news-list-items-latest']);
        $itemsCompany     = $companyModel -> listItems (null,['task'=>'news-list-items-company']);
        $itemsContact     = $contactModel -> listItems (null,['task'=>'news-list-items-contact']);
        $itemsCategory['articles'] = $articleModel->listItems (['category_id'=>$itemsCategory['id']],['task'=>'news-list-in-category']);


        return view ($this->pathViewController.'index',[
                'params'            => $this->params,
                'itemsLatest'       => $itemsLatest,
                'itemsExtra'        => $itemsExtra,
                'itemsCategory'     => $itemsCategory,
                'itemsCompany'      => $itemsCompany,
                'itemsContact'      => $itemsContact,

        ]);
    }

}
