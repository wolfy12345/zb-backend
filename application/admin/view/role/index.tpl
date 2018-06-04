{extend name="../../common/view/main"}

{block name="content"}
{php}use  app\common\components\AppAdminAcl;{/php}
<h3 class="page-title"> 权限列表
    <small>管理员将后台用户划分多个角色进行方便管理</small>
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
                                {php}echo AppAdminAcl::filterButton('admin/role/create',
                                    '<a href="/admin/role/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');{/php}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th> 操作 </th>
                                <th> 角色名 </th>
                                <th> 更改时间 </th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $list as $v}
                                <tr class="odd gradeX">
                                    <td>
                                        {php}echo AppAdminAcl::filterButton('admin/role/update',
                                            '<a href="/admin/role/update/role_id/'.$v['role_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');{/php}
                                        {php}echo AppAdminAcl::filterButton('admin/role/cancel',
                                            '<a data-href="/admin/role/cancel/role_id/'.$v['role_id'].'" type="button" class="btn btn-sm btn-danger cancel">冻结</a>');{/php}
                                    </td>
                                    <td>
                                        {$v['group_name']}
                                    </td>
                                    <td>{$v['last_modify'] > 0 ? date('Y-m-d H:i:s', $v['last_modify']):''} </td>
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