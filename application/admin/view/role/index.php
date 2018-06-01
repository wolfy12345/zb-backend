<?php
use app\app\backend\widgets\LinkPager;
use app\app\backend\components\AppAdminAcl;
$this->title = '角色管理';
$this->params['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'?r=admin/role/index'],['label'=>'角色管理']];
?>

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
                                <?php echo AppAdminAcl::filterButton('admin/role/create',
                                    '<a href="?r=admin/role/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
                                ?>
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
                            <?php foreach ($dataProvider as $v):?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo AppAdminAcl::filterButton('admin/role/update', '<a href="?r=admin/role/update&role_id='.$v['role_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <?php echo AppAdminAcl::filterButton('admin/role/cancel', '<a data-href="?r=admin/role/cancel&role_id='.$v['role_id'].'" type="button" class="btn btn-sm btn-danger cancel">冻结</a>');?>
                                </td>
                                <td>
                                    <?php echo $v['group_name'];?>
                                </td>
                                <td> <?php echo $v['last_modify']>0?date('Y-m-d H:i:s', $v['last_modify']):'';?> </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>