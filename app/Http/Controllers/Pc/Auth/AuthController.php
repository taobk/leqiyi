<?php

namespace App\Http\Controllers\Pc\Auth;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function postRegister(Request $request)
    {
        $input = $request->only(['email','password','vcode']);

        $validator = Validator::make($input,[
            'email'         => 'required|email',
            'vcode'         => 'required',
            'password'      => 'required'
        ]);

        if ($validator->fails()){

            return response()->json(['success'=>false,'msg'=>'表单数据有误,请检查后重新提交']);

        }else{

            $email_exists    = UserModel::where('email',$input['email'])->exists();

            if ($email_exists){

                return response()->json(['success'=>false,'msg'=>'该邮箱已经注册使用过!']);

            }else{

                $captch_exists = CaptchaModel::where('email',$input['email'])->where('created_at','>=',time()-3600)->first();

                if (!$captch_exists)    return response()->json(['success'=>false,'msg'=>'请点击发送验证码!']);

                //如果错误次数超过10次,限制一小时内不得再发送
                if ($captch_exists->count >= 10){

                    $time = strtotime($captch_exists->created_at) + 3600;

                    //如果超过10次的时候 过了一个小时的时间的间隔,可以继续走下去.  没有的话,牵扯手机验证的 都用不了!
                    if ($time > time()){

                        $cha  = $time- time();

                        return response()->json(['success'=>false,'msg'=>'抱歉,您已多次输错,请于'.$cha.'秒后再尝试!']);

                    }

                }else{
                    if ($captch_exists->vcode !== $input['vcode']){
                        //验证码输错,计数+1
                        $captch_exists->count +=1;

                        $captch_exists->save();

                        return response()->json(['success'=>false,'msg'=>'输入的验证码错误!']);

                    }else{

                        try{

                            $user = UserModel::create(['email'=>$input['email'],'password' => Hash::make($input['password'])]);

                            Auth::loginUsingId($user->id);


                        }catch (\Exception $e){

                            return response()->json(['success'=>false,'msg'=>'注册失败!']);

                        }
                        //注册成功后 删掉之前使用过的验证码
                        $captch_exists->delete();



                    }
                }

                return response()->json(['success'=>true,'msg'=>'注册成功!']);
            }
        }


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
                    $time = strtotime($exis->created_at) + 3600;

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
                        $message->to($data['email'])->subject("欢迎您注册(乐其意网站)");
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
