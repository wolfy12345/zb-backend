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
        'Ad[position_id]':{'required': true, 'min':1},
        'Ad[title]':{'required': true},
        'Ad[link]':{'required': true},
        'Ad[p_order]':{'required': true}
    },
    {
        'Ad[position_id]':{'required': '类型不能为空', 'min':'类型不能为空'},
        'Ad[title]':{'required': '标题不能为空'},
        'Ad[link]':{'required': '链接不能为空'},
        'Ad[p_order]':{'required': '排序不能为空'}
    }
);