<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\ContactModel;
use App\Models\ExtraModel;
use App\Models\ArticleModel;
use App\Models\SliderModel;

use Illuminate\Http\Request;

class NotifyController extends Controller
{
    private $pathViewController = "news.pages.notify.";
    private $controllerName = 'notify';
    private $params         = [];
    private $model;



    public function __construct()
    {
        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function noPermission(Request $request)
    {

        $articleModel   = new ArticleModel();
        $extraModel     = new ExtraModel();
        $categoryModel  = new CategoryModel();
        $sliderModel    = new SliderModel();
        $companyModel   = new CompanyModel();
        $contactModel   = new ContactModel();

        $itemsSlider    = $sliderModel->listItems (null,['task'=>'news-list-items']);
        $itemsLatest    = $articleModel->listItems (null,['task'=>'news-list-items-latest']);
        $itemsExtra     = $extraModel->listItems (null,['task'=>'news-list-items-extra']);
        $itemsCategory  = $categoryModel->listItems (null,['task'=>'news-list-items-is-home']);
        $itemsCompany   = $companyModel -> listItems (null,['task'=>'news-list-items-company']);
        $itemsContact   = $contactModel -> listItems (null,['task'=>'news-list-items-contact']);


        return view ($this->pathViewController.'no-permission',[
            'itemsLatest'       => $itemsLatest,
            'itemsExtra'        => $itemsExtra,
            'itemsCategory'     => $itemsCategory,
            'itemsSlider'       => $itemsSlider,
            'itemsCompany'      => $itemsCompany,
            'itemsContact'      => $itemsContact,
        ]);
    }

}
