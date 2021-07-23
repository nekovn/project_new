<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegisterRequest as Register;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;
use App\Models\ExtraModel;
use App\Models\CompanyModel;
use App\Models\ContactModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = "news.pages.home.";
    private $controllerName = 'home';
    private $params         = [];
    private $model;



    public function __construct()
    {
        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function index(Request $request)
    {
        $sliderModel    = new SliderModel();
        $categoryModel  = new CategoryModel();
        $extraModel     = new ExtraModel();
        $articleModel   = new ArticleModel();
        $companyModel   = new CompanyModel();
        $contactModel   = new ContactModel();

        $itemsSlider    = $sliderModel  -> listItems (null,['task'=>'news-list-items']);
        $itemsCategory  = $categoryModel-> listItems (null,['task'=>'news-list-items-is-home']);
        $itemsExtra     = $extraModel   -> listItems (null,['task'=>'news-list-items-extra']);
        $itemsCompany   = $companyModel -> listItems (null,['task'=>'news-list-items-company']);
        $itemsContact   = $contactModel -> listItems (null,['task'=>'news-list-items-contact']);
        $itemsFeatured  = $articleModel -> listItems (null,['task'=>'news-list-items-featured']);
        $itemsLatest    = $articleModel -> listItems (null,['task'=>'news-list-items-latest']);

        foreach ($itemsCategory as $key => $category){
            $itemsCategory[$key]['articles'] = $articleModel->listItems (['category_id'=>$category['id']],['task'=>'news-list-in-category']);
        }
        return view ($this->pathViewController.'index',[
                'params'            => $this->params,
                'itemsSlider'       => $itemsSlider,
                'itemsCategory'     => $itemsCategory,
                'itemsFeatured'     => $itemsFeatured,
                'itemsLatest'       => $itemsLatest,
                'itemsExtra'        => $itemsExtra,
                'itemsCompany'      => $itemsCompany,
                'itemsContact'      => $itemsContact,

        ]);
    }

}
