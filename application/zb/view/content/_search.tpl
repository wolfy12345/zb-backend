<form action="" method="post" class="search-single">
    <input type="hidden" name="r" value="zb/content/index">
    <select id="search" class="bs-select form-control input-small" name="Single[name]" data-style="btn-success">
        <option value="title"
                {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='title'}selected{/if}>标题</option>
        <option value="cat"
                {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='cat'}selected{/if}>分类</option>
    </select>
    <input id="title" type="text" class="form-control input-inline {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='cat'}hide{/if}" {if isset($search_attributes['Single']['name']) AND $search_attributes['Single']['name']=='cat'}disabled="disabled"{/if} placeholder=""
           value="{php}echo (isset($search_attributes['Single']['search_val'])&&$search_attributes['Single']['search_val']) ? $search_attributes['Single']['search_val'] : '';{/php}" name="Single[search_val]">
    <select id="cat" class="form-control input-inline {if empty($search_attributes['Single']['name']) OR $search_attributes['Single']['name']=='title'}hide{/if}" {if empty($search_attributes['Single']['name']) OR $search_attributes['Single']['name']=='title'}disabled="disabled"{/if} name="Single[search_val]">
        <option value="0">--请选择分类--</option>
        {foreach $catList as $cat}
            <option value="{$cat['cat_id']}" {if isset($search_attributes['Single']['search_val']) AND $search_attributes['Single']['search_val']==$cat['cat_id']}selected{/if}>{$cat['cat_name']}</option>
        {/foreach}
    </select>
    <button type="button" class="btn green search-submit">搜索</button>
    <input type="hidden" name="type" value="1" />
    <input type="hidden" name="_csrf" value="{$Request.token}" />
</form>