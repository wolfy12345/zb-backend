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

$('.switch-radio2').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == false) {
        $('#condition').show();
        $('.condition-all2').val(0);
    } else {
        $('#condition').hide();
        $('.condition-all2').val(1);
    }
});

$('.switch-radio3').on('switchChange.bootstrapSwitch', function(event, state) {
    if (state == false) {
        $('#condition').show();
        $('.condition-all3').val(0);
    } else {
        $('#condition').hide();
        $('.condition-all3').val(1);
    }
});

//表单验证
validate(
    {
        'Content[cat_id]':{'required': true, 'min':1},
        'Content[name]':{'required': true},
        'Content[title]':{'required': true},
        'Content[p_order]':{'required': true}
    },
    {
        'Content[cat_id]':{'required': '分类不能为空', 'min':'分类不能为空'},
        'Content[name]':{'required': '名称不能为空'},
        'Content[title]':{'required': '标题不能为空'},
        'Content[p_order]':{'required': '排序不能为空'}
    }
);