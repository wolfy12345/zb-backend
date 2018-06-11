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
        'Content[p_order]':{'required': true},
        // 'Content[page_type]':{'required': true, 'neq':0}
    },
    {
        'Content[cat_id]':{'required': '分类不能为空', 'min':'分类不能为空'},
        'Content[name]':{'required': '名称不能为空'},
        'Content[title]':{'required': '标题不能为空'},
        'Content[p_order]':{'required': '排序不能为空'},
        // 'Content[page_type]':{'required': '请完善输入页信息', 'neq':'请完善输入页信息'}
    }
);

$("#search").on("change", function () {
    var search = $(this).val();
    if(search == 'title') {
        $("#title").removeClass('hide').removeAttr("disabled");
        $("#cat").addClass('hide').attr("disabled", "disabled");
    } else if(search == 'cat') {
        $("#title").addClass('hide').attr("disabled", "disabled");
        $("#cat").removeClass('hide').removeAttr("disabled");
    }
});

$("#pageType").on('change', function() {
    var pageType = $(this).val();
    if(pageType == 'single') {
        $("#singleDiv").removeClass('hide');
        $("#multiDiv").addClass('hide');
    } else {
        $("#multiDiv").removeClass('hide');
        $("#singleDiv").addClass('hide');
    }
});

$(".optType").on('change', function() {
    var optType = $(this).val();
    if(optType == 'radio' || optType == 'select') {
        $(this).next().removeClass('hide');
    } else {
        $(this).next().addClass('hide');
        $("[name='Add[values]']").val('');
    }
});

$("#addOpt").on("click", function() {
    var text = $("[name='Add[text]']").val();
    var optType = $("[name='Add[optType]']").val();
    var values = $("[name='Add[values]']").val();
    
    var html = '<span class="label label-success margin-right-10 removeOpt">'+text+'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' +
        '<input type="hidden" name="text[]" value="'+text+'" />' +
        '<input type="hidden" name="optType[]" value="'+optType+'" />' +
        '<input type="hidden" name="values[]" value="'+values+'" /></span>';
    $("#list").append(html);

    return false;
})

$("#list").on("click", ".removeOpt", function() {
    $(this).remove();
})