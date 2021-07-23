<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ExtraModel;
use App\Models\ArticleModel;
use App\Models\SliderModel;
use App\Models\CompanyModel;
use App\Models\ContactModel;
use Illuminate\Http\Request;

use Mail;

class ContactController extends Controller
{

    private $pathViewController = "news.pages.contact.";
    public function postContact_content(Request $request)
    {
        $params    = $request->all ();
        $content   = $params['email'];
        $email     = 'sukivietnam19092811@gmail.com';
        $data  = [
            'email'     => $content,
            'title'     => 'このメールは【suki_vietnam】でお客さんのお問い合わせから届いていただきました。'
        ];
        $subject    ='【suki_vietnam】から届いてきました';
        Mail::send('email.content_contact',$data, function($message) use($email,$subject){
            $message->to($email)->subject($subject);
        });
        $articleModel   = new ArticleModel();
        $extraModel     = new ExtraModel();
        $categoryModel  = new CategoryModel();
        $sliderModel    = new SliderModel();
        $companyModel   = new CompanyModel();
        $contactModel   = new ContactModel();

        $itemsSlider    = $sliderModel->listItems (null,['task'=>'news-list-items']);
        $itemsLatest    = $articleModel->listItems (null,['task'=>'news-list-items-latest']);
        $itemsExtra       = $extraModel->listItems (null,['task'=>'news-list-items-extra']);
        $itemsCategory  = $categoryModel->listItems (null,['task'=>'news-list-items-is-home']);
        $itemsCompany   = $companyModel -> listItems (null,['task'=>'news-list-items-company']);
        $itemsContact   = $contactModel -> listItems (null,['task'=>'news-list-items-contact']);

        return view($this->pathViewController.'notify_contact',[
            'itemsLatest'       => $itemsLatest,
            'itemsExtra'        => $itemsExtra,
            'itemsCategory'     => $itemsCategory,
            'itemsSlider'       => $itemsSlider,
            'content'           => $content,
            'itemsCompany'      => $itemsCompany,
            'itemsContact'      => $itemsContact,
        ]);


    }

}
