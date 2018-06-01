<?php
use app\app\backend\widgets\LinkPager;
use app\app\backend\components\AppAdminAcl;
$this->title = '分类管理';
$this->params['breadcrumbs'] = [['label'=>'装B分类','url'=>'?r=zb/cat/index'],['label'=>'装B分类']];
?>
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
                                <?php echo AppAdminAcl::filterButton('zb/cat/create',
                                    '<a href="?r=zb/cat/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
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
                                <th> 操作 </th>
                                <th> 名称 </th>
                                <th> 图片 </th>
                                <th> 排序 </th>
                                <th> 显示 </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataProvider as $v):?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo AppAdminAcl::filterButton('zb/cat/update', '<a href="?r=zb/cat/update&cat_id='.$v['cat_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <?php echo AppAdminAcl::filterButton('zb/cat/delete', '<a data-href="?r=zb/cat/delete&cat_id='.$v['cat_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');?>
                                </td>
                                <td>
                                    <?php echo $v['cat_name'];?>
                                </td>
                                <td>
                                    <?php if ($v['cat_img']):?>
                                        <img src="<?php echo Yii::$app->params['img_host'].$v['cat_img']?>" width="64" height="34">
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php echo $v['p_order'];?>
                                </td>
                                <td>
                                    <?php echo Yii::$app->params['bool_status'][$v['show_status']];?>
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
    </div>
</div>