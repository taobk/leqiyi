<?php

namespace App\Http\Controllers\Pc\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    //发送邮箱验证码

    public function send(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'code'  => $request->input('code')
        ];

        $validator = Validator::make($data,[
            'email' => 'required|email',
            'code'  => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['success'=>false,'msg'=>'表单数据有误']);
        }

        try{
            Mail::send('activemail',$data,function($message) use($data){
                $message->to($data['email'])->subject("欢迎您注册(了其意网站)");
            });
        }catch (\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
        return response()->json(['success'=>true,'msg'=>'邮件发送成功!']);
    }

}
