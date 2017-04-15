//复选框
$('.ui.checkbox').checkbox();

jQuery.ajax({
    method : "GET",
    url    : '',
});

var vm = avalon.define({
    
    $id          : 'login',
    current      : 'login',
    lsrc         : '/captcha?'+Math.random().toString(36).substr(2),
    rsrc         : '/captcha?'+Math.random().toString(36).substr(2),
    remail       : "",
    rvcode       : "",

    onCurrentTab : function(key){
        vm.current = key;
    },
    onCaptcha    : function () {
        vm.rsrc = '/captcha?'+Math.random().toString(36).substr(2);
    },
    onVcode      : function () {
        $.ajax({
            url     : '/captcha/check?captcha='+vm.rvcode,
            success : function (ret) {
                if (ret.success){
                    console.log(1);
                }else{
                    vm.rsrc = '/captcha?'+Math.random().toString(36).substr(2);
                }
            } 
        });
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
