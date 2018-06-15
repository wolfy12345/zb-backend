{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
{php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 回收站
    <small></small>
</h3>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            {foreach $page_list as $k=>$v}
                <li {if $type==$k}class="active"{/if}>
                    <a href="/zb/recycle/index/type/{$k}">{$v}</a>
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
                                {php}echo AppAdminAcl::filterButton('zb/recycle/restore',
                                    '<a id="deletes" data-href="/zb/recycle/restore/type/'.$type.'" type="button" class="btn btn-danger green">批量恢复</a>');{/php}
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
                                <th>
                                    <label><input type="checkbox" id="checkall">全选</label>
                                </th>
                                <th> 操作 </th>
                                <th> ID </th>
                                <th> 名称 </th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $list as $v}
                            <tr class="odd gradeX">
                                <td>
                                    <input type="checkbox" value="{$v['id']}" class="checkboxes">
                                </td>
                                <td>
                                    {php}echo AppAdminAcl::filterButton('zb/recycle/restore',
                                        '<a data-href="/zb/recycle/restore/type/'.$type.'/id/'.$v['id'].'" type="button" class="btn btn-sm btn-danger delete">恢复</a>');{/php}
                                </td>
                                <td>
                                    {$v['id']}
                                </td>
                                <td>
                                    {$v['title']}
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