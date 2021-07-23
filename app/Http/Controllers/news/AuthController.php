<?php


namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Http\Requests\AuthRegisterRequest as Register;
use App\Http\Requests\NewPasswordRequest as NewPassword;
use App\Models\UserModel;

use Mail;

class AuthController extends Controller
{
    private $pathViewController = "news.pages.auth.";
    private $controllerName = 'auth';
    private $params         = [];
    private $model;



    public function __construct()
    {

        view()->share ('controllerName', $this->controllerName);//đặt controllerName cho all action
    }

    public function login(Request $request)
    {
        return view($this->pathViewController.'login');
    }


    public function postLogin(MainRequest $request)
    {
        if($request->method() == 'POST'){
            $params     = $request->all();
            $userModel  = new UserModel();
            $userInfo   = $userModel->getItem ($params,['task'=>'auth-login']);

            if(!$userInfo){
                return redirect ()->route ($this->controllerName.'/login')->with ('new_notify','メールアドレスとパスワードを確認してください!');
            }elseif ($userInfo['status']=='inactive'){
                return redirect ()->route ($this->controllerName.'/login')->with ('new_notify','アカウントがロックされています !');
            }

            $request->session ()->put('userInfo',$userInfo);//khi đăng nhập thành công thì lưu nó vào session
            return  redirect ()->route ('home');
        }
    }

    public function register(Request $request)
    {
            return view($this->pathViewController.'register');

    }

    public function forgot_password(Request $request)
    {
            return view($this->pathViewController.'forgot_password');

    }
    public function post_forgot_password(Request $request)
    {
        if($request->method() == 'POST') {
            $params = $request->all ();
            $userModel = new UserModel();
            $email     = $params['email'];
            $checkUser = $userModel::Where('email',$email)->first();
            if (!$checkUser) {
                return redirect ()->route ($this->controllerName . '/forgot_password')->with ('new_notify', 'メールアドレスが存在してない!');
            }
            $code = bcrypt (md5 (time().$email));
            $checkUser->code      = $code;
            $checkUser->time_code = Carbon::now ();
            $checkUser->save();
            //truyên thông tin user sang file get_password
            $url   = route ($this->controllerName.'/get_password',['code'=>$checkUser->code,'email'=>$email]);
            $data  = [
                'route'     => $url,
                'username'  => $checkUser->username
            ];
            $subject    ='【suki_vietnam】サブユーザ登録のお知らせ';
            Mail::send('email.reset_password',$data, function($message) use($email,$subject){
                $message->to($email)->subject($subject);
            });

            return redirect ()->route ($this->controllerName.'/forgot_password')->with ('zvn_register_notify',"リンクを送りましたので、アドレスメールを確認してください！");

        }

    }

    //get password
    public function get_password(Request $request){
        $code       = $request->code;
        $email      = $request->email;
        $userModel  = new UserModel();
        $checkUser  = $userModel::where([
            'code'  => $code,
            'email'=> $email
        ])->first();
        if(!$checkUser){
            return redirect ()->route ($this->controllerName . '/get_password')->with ('new_notify', '申し訳ございませんが、現在、リンクが間違いましたので、もう一度　試してみてください!');
        }

        return view($this->pathViewController.'get_password',['email'=>$email,'code'=>$code]);
    }
    //nhan password moi truyen sang
    public function post_new_password(NewPassword $requestNewPassword){
        if($requestNewPassword->method() == 'POST') {
            $userModel  = new UserModel();
            $params     = $requestNewPassword->all ();
            $code       = $requestNewPassword->code;
            $email      = $requestNewPassword->email;



            $checkUser  = $userModel::where([
                'code'  => $code,
                'email' => $email
            ])->first();

            if(!$checkUser){
                return redirect ()->route ($this->controllerName . '/forgot_password')->with ('new_notify', '申し訳ございませんが、現在、リンクが間違いましたので、もう一度　試してみてください!');
            }else{
                $userModel->saveItems ($params,['task'=>'save-new-password']);
            }

            return redirect ()->route ($this->controllerName.'/login')->with ('zvn_register_notify',"パスワードの変更を完了しました!");






        }
    }


    public function postRegister(Register $request){
        if($request->method() == 'POST'){
            $userModel  = new UserModel();
            $params     = $request->all();

            $userModel->saveItems ($params,['task'=>'add-item-register']);
            return redirect ()->route ($this->controllerName.'/register')->with ('zvn_register_notify',"登録を完了しました。!");

        }

    }




    public function logout(Request $request){
        //pull là xóa session
            if($request->session ()->has ('userInfo')) $request->session ()->pull ('userInfo');
            return  redirect ()->route ('home');
    }
}
