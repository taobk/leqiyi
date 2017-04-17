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




    onCurrentTab : function(key){
        vm.current = key;
    },
    // onCaptcha    : function () {
    //     vm.src     = '/captcha?'+Math.random().toString(36).substr(2);
    // },
    onVcode      : function () {
        if (vm.remail){
            if (vm.start === 60){
                $.ajax({
                    url     : '/send?email='+vm.remail,
                    success : function (ret) {
                        if(!ret.success){
                            console.log(ret.message);
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
            console.log(1);
        }
    },

    validate     : {
        onError: function (reasons) {
            reasons.forEach(function (reason) {
                console.log(reason.getMessage())
            })
        },
        onValidateAll: function (reasons) {
            if (reasons.length) {
                console.log('有表单没有通过')
            } else {
                console.log('全部通过')
            }
        }
    }
});
