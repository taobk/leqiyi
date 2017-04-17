<!doctype html>
<html lang="en">
<head>
    <meta name="keywords" content="了其意,淘宝客平台"/>
    <meta name="description" content="懂你的淘宝客平台"/>
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta charset="UTF-8">
    <title>了其意 -登陆注册</title>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/semantic.min.css') }}">
    <style type="text/css">
        body {
            background-color: #F1F1F1;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 400px;
        }
        .ui.secondary.pointing.menu {
            margin:  2em auto;
            width: 160px;
        }
    </style>
</head>
<body ms-controller="login">

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h1 class="ui blue image header">
            {{--<img src="assets/images/logo.png" class="image">--}}
            <div class="content" style="margin-bottom: 20px;">
                了其意
            </div>
        </h1>

            <div class="ui stacked segment">
                <div class="ui center aligned secondary pointing menu">
                    <a class="item"  ms-class="[@current==='login' ? 'active' : '']"  ms-click="@onCurrentTab('login')">登录</a>
                    <span class="item">·</span>
                    <a class="item"  ms-class="[@current==='register' ? 'active' : '']"  ms-click="@onCurrentTab('register')">注册</a>
                </div>
                {{--登录--}}
                <div ms-visible="@current==='login'">
                    <form class="ui form" ms-validate="@validate">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="请输入邮箱地址">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="请输入账号密码">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="twelve wide field">
                                <div class="ui toggle checkbox" style="float: left">
                                    <input type="checkbox" tabindex="0" class="hidden">
                                    <label>记住我</label>
                                </div>
                            </div>
                            <div class="five wide field">
                                <label style="float: right"><a>登陆遇到问题?</a></label>
                            </div>
                        </div>
                        <input class="ui fluid large blue submit button" type="submit" value="登录">
                    </form>
                </div>
                {{--注册--}}
                <div ms-visible="@current==='register'">
                    <form class="ui form" ms-validate="@validate">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" ms-duplex="@remail" placeholder="请输入注册邮箱地址" ms-rules="{required:true,email:true}">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" ms-duplex="@rpwd" placeholder="请输入注册账号密码" ms-rules="{required:true,minlength:6}">
                            </div>
                        </div>
                        {{--<div class="two fields">--}}
                            {{--<div class="ten wide field">--}}
                                {{--<div class="ui left icon input">--}}
                                    {{--<i class="lock icon"></i>--}}
                                    {{--<input type="vcode" name="password" ms-duplex="@vcode" ms-blur="@onVcode" placeholder="请输入验证码" ms-rules="{required:true}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="six wide field">--}}
                                {{--<img ms-attr="{src:@src}" alt="验证码" title="点击刷新验证码" ms-click="@onCaptcha">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="fields">--}}
                            {{--<div class="sixteen wide field">--}}
                                {{--<label style="float: right"><a>登陆遇到问题?</a></label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="field">
                            <div class="ui left icon action input">
                                <i class="lock icon"></i>
                                <input type="text" placeholder="请输入邮箱的验证码" style="width: 180px;" ms-duplex="@rvcode" ms-rules="{required:true,minlength:6}">
                                <span class="ui button" ms-click="@onVcode"  ms-class="[@start !== 60 ? 'disabled': '']">获取验证码<span id="times"></span></span>
                            </div>
                        </div>
                        <input class="ui fluid large blue submit button" type="submit" value="注册">
                    </form>
                </div>
            </div>
            {{--<div class="ui error message"></div>--}}
        {{--</form>--}}
        <div class="ui message">
            忘记密码 ?&nbsp;<a href="#">找回密码</a>
        </div>
    </div>
</div>

</body>
<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/semantic.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/avalon.min.js') }}"></script>
<script src="{{ URL::asset('assets/build/modules/auth/login.js') }}"></script>
</html>