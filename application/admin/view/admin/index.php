<?php
use app\app\backend\widgets\LinkPager;
use app\app\backend\components\AppAdminAcl;
$this->title = '管理员管理';
$this->params['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'?r=admin/admin/index'],['label'=>'管理员管理']];
?>

<h3 class="page-title"> 管理员列表
    <small>后台管理员按照权限对后台的功能进行操作
        <a href="?r=admin/admin/index" class="btn btn-sm default"><i class="fa fa-refresh"></i>&nbsp;刷新</a>
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
                                <?php echo AppAdminAcl::filterButton('admin/admin/create',
                                    '<a href="?r=admin/admin/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->render('_search', $this->context->data);?>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table id="table" class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                        <tr>
<!--                            <th>-->
<!--                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />-->
                            </th>
                            <th> 操作 </th>
                            <th> 登录名 </th>
                            <th> 真实名 </th>
                            <th> 最后登录时间 </th>
                            <th> 最后登录IP </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataProvider as $v):?>
                            <tr class="odd gradeX">
<!--                                <td>-->
<!--                                    <input type="checkbox" class="checkboxes" value="1" /> </td>-->

                                <td>
                                    <?php if ($v['login_account'] != 'admin'):?>
                                        <?php echo AppAdminAcl::filterButton('admin/admin/cancel', '<a data-href="?r=admin/admin/cancel&user_id='.$v['user_id'].'" type="button" class="btn btn-sm btn-danger cancel">冻结</a>');?>

                                    <?php endif;?>
                                    <?php echo AppAdminAcl::filterButton('admin/admin/update', '<a href="?r=admin/admin/update&user_id='.$v['user_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>

                                </td>
                                <td>
                                    <?php echo $v['login_account'];?>
                                </td>
                                <td>
                                    <?php echo $v['truename'];?>
                                </td>
                                <td> <?php echo $v['last_login_time']>0?date('Y-m-d H:i:s', $v['last_login_time']):'';?> </td>
                                <td>
                                    <?php echo $v['last_login_ip'];?>
                                </td>
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