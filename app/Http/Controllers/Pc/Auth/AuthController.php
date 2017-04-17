<?php

namespace App\Http\Controllers\Pc\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\CaptchaModel;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //登陆

    public function getLogin()
    {
        return view('pc.auth.login');
    }

    public function postLogin()
    {

    }

    //注册

    public function getRegister()
    {

    }

    public function postRegister()
    {

    }

    //忘记密码

    public function getForget()
    {

    }

    public function postForget()
    {

    }

    //发送验证码(邮箱与短信)

    public function send(Request $request)
    {
        if ($request->has('email')){

            $data = [
                'email' => $request->input('email'),
            ];

            $validator = Validator::make($data,[
                'email' => 'required|email',
            ]);

            if ($validator->fails()){
                return response()->json(['success'=>false,'msg'=>'Email格式不正确!']);
            }

            $data['activationcode'] =  str_random(6);

            //判断验证码时间与错误次数

            $exis = CaptchaModel::where('email',$data['email'])->where('created_at','>=',time()-3600)->first();

            if ($exis){
                //如果错误的次数超过10次.看一下还有多少时间 才能继续发送验证码
                if ($exis->count >= 10){

                    $time = $exis->created_at + 3600;

                    if ( $time > time()){
                        $cha = $time - time();
                        return response()->json(['success'=>false,'msg'=>'很抱歉，您已输错多次,请于'.$cha.'秒后重试!']);
                    }else{
                        return response()->json(['success'=>false,'msg'=>'请输入您邮箱最近已存在的验证码!']);
                    }
                }else{

                    return response()->json(['success'=>false,'msg'=>'请输入您邮箱最近已存在的验证码!']);
                }
            }else{
                //过期的,和没有的 可以直接发送
                CaptchaModel::create(['email'=>$data['email'],'vcode'=>$data['activationcode']]);
                try{

                    Mail::send('activemail',$data,function($message) use($data){
                        $message->to($data['email'])->subject("欢迎您注册(了其意网站)");
                    });

                }catch (\Exception $e){

                    return response()->json(['success'=>false,'msg'=>'验证码发送失败!']);

                }

                return response()->json(['success'=>true,'msg'=>'邮件发送成功!']);

            }


        }elseif($request->has('mobile')){

            return response()->json(['success'=>false,'msg'=>'短信验证码暂未开通!']);

        }else{

            return response()->json(['success'=>false,'msg'=>'缺少必要的参数!']);

        }

    }

}
