<?php

namespace App\Http\Controllers\Pc\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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


}
