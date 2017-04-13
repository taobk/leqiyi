<!doctype html>
<html lang="en">
<head>
    <meta name="keywords" content="了其意,淘宝客平台"/>
    <meta name="description" content="懂你的淘宝客平台"/>
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.4/semantic.min.css">
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
            <div class="content">
                Login
            </div>
        </h1>
        <form class="ui form">
            <div class="ui stacked segment">
                <div class="ui center aligned secondary pointing menu">
                    <a class="item"  ms-class="[@current==='login' ? 'active' : '']"  ms-click="@onCurrentTab('login')">登录</a>
                    <span class="item">·</span>
                    <a class="item"  ms-class="[@current==='register' ? 'active' : '']"  ms-click="@onCurrentTab('register')">注册</a>
                </div>
                <div ms-visible="@current==='login'">
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
                    <div class="ui fluid large blue submit button">登录</div>
                </div>
                <div ms-visible="@current==='register'">
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
                    <div class="ui fluid large blue submit button">注册</div>
                </div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
            忘记密码 ?&nbsp;<a href="#">找回密码</a>
        </div>
    </div>
</div>

</body>
<script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.4/semantic.min.js"></script>
<script src="{{ URL::asset('assets/js/avalon.min.js') }}"></script>
<script src="{{ URL::asset('assets/build/modules/auth/login.js') }}"></script>
</html>