{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
    {php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 装B分类
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
                                {php}echo AppAdminAcl::filterButton('zb/cat/create',
                                    '<a href="/zb/cat/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');{/php}
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th> 操作 </th>
                                <th> 名称 </th>
                                <th> 图片 </th>
                                <th> 排序 </th>
                                <th> 显示 </th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $list as $v}
                            <tr class="odd gradeX">
                                <td>
                                    {php}echo AppAdminAcl::filterButton('zb/cat/update',
                                        '<a href="/zb/cat/update/cat_id/'.$v['cat_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');{/php}
                                    {php}echo AppAdminAcl::filterButton('zb/cat/delete',
                                        '<a data-href="/zb/cat/delete/cat_id/'.$v['cat_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');{/php}
                                </td>
                                <td>
                                    {$v['cat_name']}
                                </td>
                                <td>
                                    {if $v['cat_img']}
                                        <img src="{$Think.config.img_host}/{$v['cat_img']}" width="64" height="34">
                                    {/if}
                                </td>
                                <td>
                                    {$v['p_order']}
                                </td>
                                <td>
                                    {$Think.config.bool_status[$v['show_status']]}
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
    <script src="/static/themes/backend/zb/cat.js"></script>
{/block}