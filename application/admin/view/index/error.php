<?php
use yii\helpers\Html;
$this->title = Html::encode($this->title);
$this->params['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'?r=admin/admin/index'],['label'=>'程序错误']];
?>

<h3 class="page-title"> 程序错误
    <small>遇到这样的问题非常抱歉，立即通知技术人员！</small>
</h3>
<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-red"> 500 </div>
        <div class=" details">
            <h3>程序正在处理中！</h3>
            <div class="alert alert-danger">
                <strong>错误原因!</strong> <?php echo nl2br(Html::encode($message)); ?>
            </div>
            <p>
                <a href="?r=admin/default/index" class="btn red btn-outline"> 初始页 </a>
                <br>
            </p>
        </div>

    </div>
</div>