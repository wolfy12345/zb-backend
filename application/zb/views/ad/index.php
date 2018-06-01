<?php
use app\app\backend\widgets\LinkPager;
use app\app\backend\components\AppAdminAcl;
$this->title = '广告管理';
$this->params['breadcrumbs'] = [['label'=>'装B广告','url'=>'?r=zb/ad/index'],['label'=>'装B广告']];
?>
<h3 class="page-title"> 装B广告
    <small></small>
</h3>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <li <?php if ($type==0):?>class="active"<?php endif;?>>
                <a href="?r=zb/ad/index">全部</a>
            </li>
            <?php foreach ($this->context->data['ad_type'] as $k=>$v):?>
                <li <?php if ($k==$type):?>class="active"<?php endif;?>>
                    <a href="?r=zb/ad/index&type=<?php echo $k;?>"><?php echo $v;?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="col-md-12">
        <div class="portlet light bordered dataTables_wrapper">
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <?php echo AppAdminAcl::filterButton('zb/ad/create',
                                    '<a href="?r=zb/ad/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
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
                                <th> 类型 </th>
                                <th> 链接 </th>
                                <th> 图片 </th>
                                <th> 显示 </th>
                                <th> 排序 </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataProvider as $v):?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo AppAdminAcl::filterButton('zb/ad/update', '<a href="?r=zb/ad/update&ad_id='.$v['ad_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <?php echo AppAdminAcl::filterButton('zb/ad/delete', '<a data-href="?r=zb/ad/delete&ad_id='.$v['ad_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');?>
                                </td>
                                <td>
                                    <?php echo $v['title'];?>
                                </td>
                                <td>
                                    <?php echo $ad_type[$v['position_id']];?>
                                </td>
                                <td>
                                    <?php echo $v['link'];?>
                                </td>
                                <td>
                                    <?php if ($v['logo']):?>
                                        <img src="<?php echo Yii::$app->params['img_host'].$v['logo']?>" width="64px" height="16px">
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php echo Yii::$app->params['bool_status'][$v['status']];?>
                                </td>
                                <td>
                                    <?php echo $v['p_order'];?>
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