//单选按钮
$('.switch-radio1').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == false) {
        $('#condition').show();
        $('.condition-all1').val(0);
    } else {
        $('#condition').hide();
        $('.condition-all1').val(1);
    }
});

//表单验证
validate(
    {
        'Cat[cat_name]':{'required': true},
        'File[logo]':{'required': true},
        'Cat[p_order]':{'required': true},
    },
    {
        'Cat[cat_name]':{'required': '名称不能为空'},
        'File[logo]':{'required': '图片不能为空'},
        'Cat[p_order]':{'required': '排序不能为空'},
    }
);