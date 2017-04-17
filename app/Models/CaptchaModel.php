<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaptchaModel extends Model
{

    protected $table      = 'tbk_captcha';

    protected $fillable   = ['user_id','mobile','vcode','email'];

    //存入UNIX时间戳
    protected $dateFormat = 'U';
    //不让转换成字符串
    public $timestamps    = false;

}
