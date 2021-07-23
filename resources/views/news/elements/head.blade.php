@php
    use App\Models\CategoryModel as CategoryModel;
    $categoryModel = new CategoryModel();
    $itemsCategory = $categoryModel->listItems (null,['task'=>'news-list-items']);
    if(count ($itemsCategory)>0){
         $categoryIdCurrent  = Route::input('category_id');//lấy category_id hiện tại trên url
         if($categoryIdCurrent!=''){
              $title='Blog | ';
           foreach ($itemsCategory as $item){
               $title        .= ($categoryIdCurrent == $item['id'])?$item['name']:'';
            }
         }else{
             $title='Home';
         }

    }

@endphp
<title>{{$title}}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Tech Mag template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset ('news/images/vietnam-c.jpg')}}" rel="icon" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{asset ('news/css/bootstrap-4.1.2/bootstrap.min.css')}}">
<link href="{{asset ('news/css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset ('news/js/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('news/js/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('news/js/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('news/css/main_styles.css?v=10')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('news/css/responsive.css?v=10')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('news/css/my-style.css?v=10')}}">
