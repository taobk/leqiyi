//复选框
$('.ui.checkbox').checkbox();

var vm = avalon.define({
    
    $id          : 'login',
    current      : 'login',
    lsrc        : '/captcha?'+Math.random().toString(36).substr(2),
    rsrc        : '/captcha?'+Math.random().toString(36).substr(2),

    onCurrentTab : function(key){
        vm.current = key;
    },
    onCaptcha    : function () {
        vm.rsrc = '/captcha?'+Math.random().toString(36).substr(2);
    }

});
