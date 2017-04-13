//复选框
$('.ui.checkbox').checkbox();

var vm = avalon.define({
    $id         : 'login',
    current     : 'login',

    onLoads: function () {
        $('.ui.checkbox').checkbox();
    },

    onCurrentTab : function(key){
        vm.current = key;
    }
});
