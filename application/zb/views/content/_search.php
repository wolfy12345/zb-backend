<form action="" method="get" class="search-single">
    <input type="hidden" name="r" value="zb/content/index">
    <select class="bs-select form-control input-small" name="Single[name]" data-style="btn-success">
        <option value="name"
                <?php if (isset($search_attributes['Single']['name'])&&$search_attributes['Single']['name']=='name'):?>selected<?php endif;?>
        >名称</option>
        <option value="cat"
                <?php if (isset($search_attributes['Single']['name'])&&$search_attributes['Single']['name']=='cat'):?>selected<?php endif;?>
        >分类</option>
    </select>
    <input type="text" class="form-control input-inline" placeholder=""
           value="<?php echo isset($search_attributes['Single']['search_val'])&&$search_attributes['Single']['search_val']?$search_attributes['Single']['search_val']:'';?>" name="Single[search_val]">
    <button type="button" class="btn green search-submit">搜索</button>
    <input type="hidden" name="type" value="1" />
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
</form>