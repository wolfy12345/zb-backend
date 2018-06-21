{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
{php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 装B广告
    <small></small>
</h3>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <li {if $type==0}class="active"{/if}>
                <a href="/zb/ad/index">全部</a>
            </li>
            {foreach $ad_type as $k=>$v}
                <li {if $type==$k}class="active"{/if}>
                    <a href="/zb/ad/index/type/{$k}">{$v}</a>
                </li>
            {/foreach}
        </ul>
    </div>
    <div class="col-md-12">
        <div class="portlet light bordered dataTables_wrapper">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                {php}echo AppAdminAcl::filterButton('zb/ad/create',
                                    '<a href="/zb/ad/create" class="btn sbold green" style="margin-right: 3px;"> 添加<i class="fa fa-plus"></i></a>');{/php}
                                {php}echo AppAdminAcl::filterButton('zb/ad/tabsetting',
                                    '<a href="/zb/ad/tabsetting" class="btn sbold green" style="margin-right: 3px;"> 底部导航条</a>');{/php}
                                {php}echo AppAdminAcl::filterButton('zb/ad/delete',
                                    '<a id="deletes" data-href="/zb/ad/delete" type="button" class="btn btn-danger delete">批量删除</a>');{/php}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {include file="ad/_search"}
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th>
                                    <label><input type="checkbox" id="checkall">全选</label>
                                </th>
                                <th width="15%"> 操作
                                <th> ID </th>
                                <th> 名称 </th>
                                <th> 类型 </th>
                                <th> 链接 </th>
                                <th> 图片 </th>
                                <th> 显示 </th>
                                <th> 排序 </th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $list as $v}
                            <tr class="odd gradeX">
                                <td>
                                    <input type="checkbox" value="{$v['ad_id']}" class="checkboxes">
                                </td>
                                <td>
                                    {php}echo AppAdminAcl::filterButton('zb/ad/update',
                                        '<a href="/zb/ad/update/ad_id/'.$v['ad_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');{/php}
                                    {php}echo AppAdminAcl::filterButton('zb/ad/delete',
                                        '<a data-href="/zb/ad/delete/id/'.$v['ad_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');{/php}
                                </td>
                                <td>
                                    {$v['ad_id']}
                                </td>
                                <td>
                                    {$v['title']}
                                </td>
                                <td>
                                    {$ad_type[$v['position_id']]}
                                </td>
                                <td>
                                    {$v['link']}
                                </td>
                                <td>
                                    {if $v['logo']}
                                        <img src="{$Think.config.img_host}/{$v['logo']}" width="64" height="16">
                                    {/if}
                                </td>
                                <td>
                                    {$Think.config.bool_status[$v['status']]}
                                </td>
                                <td>
                                    {$v['p_order']}
                                </td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                {$page|raw}
            </div>
        </div>
    </div>
</div>
{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
    <script src="/static/themes/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/static/themes/backend/zb/ad.js"></script>
{/block}