<form action="" method="post" class="search-single">
    <input type="hidden" name="r" value="zb/content/index">
    <select class="bs-select form-control input-small" name="Single[name]" data-style="btn-success">
        <option value="name"
                {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='name'}selected{/if}>名称</option>
        <option value="cat"
                {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='cat'}selected{/if}>分类</option>
    </select>
    <input type="text" class="form-control input-inline" placeholder=""
           value="{php}echo (isset($search_attributes['Single']['search_val'])&&$search_attributes['Single']['search_val']) ? $search_attributes['Single']['search_val'] : ''{/php}" name="Single[search_val]">
    <button type="button" class="btn green search-submit">搜索</button>
    <input type="hidden" name="type" value="1" />
    <input type="hidden" name="_csrf" value="{$Request.token}" />
</form>