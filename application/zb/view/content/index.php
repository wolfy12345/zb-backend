<?php
use app\app\backend\widgets\LinkPager;
use app\app\backend\components\AppAdminAcl;
$this->title = '素材管理';
$this->params['breadcrumbs'] = [['label'=>'装B素材','url'=>'?r=zb/content/index'],['label'=>'装B素材']];
?>
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
                                <?php echo AppAdminAcl::filterButton('zb/content/create',
                                    '<a href="?r=zb/content/create" class="btn sbold green"> 添加<i class="fa fa-plus"></i></a>');
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
                                <th width="10%"> 操作 </th>
                                <th width="8%"> 名称 </th>
                                <th width="8%"> 分类 </th>
                                <th width="8%"> 标题图片 </th>
                                <th> 标题 </th>
                                <th width="12%"> 短链接 </th>
                                <th width="5%"> 前台显示 </th>
                                <th width="5%"> 参与数量 </th>
                                <th width="5%"> 热门 </th>
                                <th width="5%"> 推荐 </th>
                                <th width="5%"> 排序 </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataProvider as $v):?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo AppAdminAcl::filterButton('zb/content/update', '<a href="?r=zb/content/update&content_id='.$v['content_id'].'" type="button" class="btn btn-sm btn-info">编辑</a>');?>
                                    <?php echo AppAdminAcl::filterButton('zb/content/delete', '<a data-href="?r=zb/content/delete&content_id='.$v['content_id'].'" type="button" class="btn btn-sm btn-danger delete">删除</a>');?>
                                </td>
                                <td>
                                    <?php echo $v['name'];?>
                                </td>
                                <td>
                                    <?php echo $v['cat_name'];?>
                                </td>
                                <td>
                                    <?php if ($v['img_icon']):?>
                                        <img src="<?php echo Yii::$app->params['img_host'].$v['img_icon']?>" width="50px" height="50">
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php echo $v['title'];?>
                                </td>
                                <td><a href="<?php echo $v['short_url'];?>" target="_blank"> <?php echo $v['short_url'];?></a></td>
                                <td>
                                    <?php echo Yii::$app->params['bool_status'][$v['show_status']];?>
                                </td>
                                <td>
                                    <?php echo $v['take_num'];?>
                                </td>
                                <td>
                                    <?php echo Yii::$app->params['bool_status'][$v['is_hot']];?>
                                </td>
                                <td>
                                    <?php echo Yii::$app->params['bool_status'][$v['is_recommend']];?>
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