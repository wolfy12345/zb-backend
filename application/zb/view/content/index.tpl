{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
    {php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 装B素材
    <small></small>
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered dataTables_wrapper">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                {php}echo AppAdminAcl::filterButton('zb/content/create',
                                    '<a href="/zb/content/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');{/php}
                                &nbsp;
                                {php}echo AppAdminAcl::filterButton('zb/content/delete',
                                    '<a id="deletes" data-href="/zb/content/delete" type="button" class="btn btn-danger delete">批量删除</a>');{/php}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {include file="content/_search"}
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th width="2%">
                                    <label><input type="checkbox" id="checkall">全选</label>
                                </th>
                                <th width="14%"> 操作 </th>
                                <th width="1%"> ID </th>
                                <th width="7%"> 名称 </th>
                                <th width="7%"> 分类 </th>
                                <th width="7%"> 标题图片 </th>
                                <th> 标题 </th>
                                <th width="10%"> 短链接 </th>
                                <th width="5%"> 前台显示 </th>
                                <th width="5%"> 参与数量 </th>
                                <th width="5%"> 热门 </th>
                                <th width="5%"> 推荐 </th>
                                <th width="5%"> 排序 </th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $list as $v}
                            <tr class="odd gradeX">
                                <td>
                                    <input type="checkbox" value="{$v['content_id']}" class="checkboxes">
                                </td>
                                <td>
                                    {php}echo AppAdminAcl::filterButton('zb/content/update',
                                        '<a href="/zb/content/update/content_id/'.$v['content_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');{/php}
                                    {php}echo AppAdminAcl::filterButton('zb/content/delete',
                                        '<a data-href="/zb/content/delete/id/'.$v['content_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');{/php}
                                </td>
                                <td>
                                    {$v['content_id']}
                                </td>
                                <td>
                                    {$v['name']}
                                </td>
                                <td>
                                    {$v['cat_name']}
                                </td>
                                <td>
                                    {if $v['img_icon']}
                                        <img src="{$Think.config.img_host}/{$v['img_icon']}" width="50" height="50">
                                    {/if}
                                </td>
                                <td>
                                    {$v['title']}
                                </td>
                                <td><a href="{$v['short_url']}" target="_blank"> {$v['short_url']}</a></td>
                                <td>
                                    {$Think.config.bool_status[$v['show_status']]}
                                </td>
                                <td>
                                    {$v['take_num']}
                                </td>
                                <td>
                                    {$Think.config.bool_status[$v['is_hot']]}
                                </td>
                                <td>
                                    {$Think.config.bool_status[$v['is_recommend']]}
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
    <script src="/static/themes/backend/zb/content.js"></script>
{/block}