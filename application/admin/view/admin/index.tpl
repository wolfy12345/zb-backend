{extend name="../../common/view/main"}

{block name="content"}
    {php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 管理员列表
    <small>后台管理员按照权限对后台的功能进行操作
        <a href="/admin/admin/index" class="btn btn-sm default"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
    </small>
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered dataTables_wrapper">

            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                {php}echo AppAdminAcl::filterButton('admin/admin/create',
                                    '<a href="/admin/admin/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');{/php}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {include file="admin/_search"}
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                        <tr>
<!--                            <th>-->
<!--                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />-->
<!--                            </th>-->
                            <th> 操作 </th>
                            <th> 登录名 </th>
                            <th> 真实名 </th>
                            <th> 最后登录时间 </th>
                            <th> 最后登录IP </th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach $list as $v}
                            <tr class="odd gradeX">
                                <td>
                                    {php}echo AppAdminAcl::filterButton('admin/admin/update',
                                        '<a href="/admin/admin/update/user_id/'.$v['user_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');{/php}
                                    {if $v['login_account'] != 'admin'}
                                        {php}echo AppAdminAcl::filterButton('admin/admin/cancel',
                                        '<a data-href="/admin/admin/cancel/user_id/'.$v['user_id'].'" type="button" class="btn btn-sm btn-danger cancel">冻结</a>');{/php}
                                    {/if}
                                </td>
                                <td>
                                    {$v['login_account']}
                                </td>
                                <td>
                                    {$v['truename']}
                                </td>
                                <td>
                                    {$v['last_login_time'] > 0 ? date('Y-m-d H:i:s', $v['last_login_time']) : ''}
                                </td>
                                <td>
                                    {$v['last_login_ip']}
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/backend/admin/admin.js"></script>
{/block}