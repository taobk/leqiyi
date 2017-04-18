//复选框
$('.ui.checkbox').checkbox();

$('#rshow').hide();

var vm = avalon.define({
    
    $id          : 'login',
    current      : 'login',
    src          : '/captcha?'+Math.random().toString(36).substr(2),    //验证码图片
    remail       : "",    //注册的邮箱
    rpwd         : "",    //注册的密码
    rvcode       : "",    //注册的验证码
    vcode        : "",
    start        : 60,
    width        : "",
    vshow        : false,

    //切换卡
    onCurrentTab : function(key){
        vm.current = key;
    },
    onShow       : function () {
        vm.vshow = true;
    },
    onCaptcha    : function () {
        vm.src     = '/captcha?'+Math.random().toString(36).substr(2);
    },
    //获取邮箱验证码
    onVcode      : function () {
        if (vm.remail){
            $('.ui.register.error.message').hide();
            if (vm.start === 60){
                $.ajax({
                    url     : '/send?email='+vm.remail,
                    success : function (ret) {
                        if(!ret.success){
                            $('.ui.register.error.message').show();
                            $('.ui.register.error.message li').text(ret.msg);
                        }else{
                            vm.start = 59;
                            setTimeout(function () {
                                vm.onVcode()
                            }, 1000);
                        }
                    }
                })
            }
            if (vm.start > 0 && vm.start !==60) {
                $('#times').text('(' + vm.start + 's)');
                setTimeout(function () {
                    vm.onVcode()
                }, 1000);
                vm.start = vm.start - 1;
            } else {
                $('#times').text('');
                vm.start = 60;
                return false;
            }

            // $.ajax({
            //     url     : '/captcha/check?captcha='+vm.vcode,
            //     success : function (ret) {
            //         if (ret.success){
            //             vm.rvcode = vm.vcode;
            //             $('#rshow').show();
            //
            //         }
            //     }
            // });
        }else{
            $('.ui.register.error.message').show();
            $('.ui.register.error.message li').text('请输入邮箱地址!');
        }
    }
});

//表单验证
$('.ui.register.form').form({
    fields: {
        email: {
            identifier  : 'email',
            rules: [
                {
                    type   : 'empty',
                    prompt : '请输入邮箱号!'
                },
                {
                    type   : "email",
                    prompt : '邮箱格式不正确!'
                }
            ]
        },
        password: {
            identifier  : 'password',
            rules: [
                {
                    type   : 'empty',
                    prompt : '请输入密码!'
                },
                {
                    type   : "minLength[6]",
                    prompt : '长度不能小于6位数!'
                }
            ]
        },
        vcode: {
            identifier  : 'vcode',
            rules: [
                {
                    type   : 'empty',
                    prompt : '请输入验证码 !'
                }
            ]
        }
    },
    onSuccess:function () {
        var data = $('.ui.register.form form').serialize();
        $.ajax({
            url: '/register',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            cache: false,
            processData: false,
            contentType: false
        }).done(function(ret){
            if (!ret.success){
                $('.ui.register.error.message').show();
                $('.ui.register.error.message li').text(ret.msg);
            }
        });
        return false;
    }

});

