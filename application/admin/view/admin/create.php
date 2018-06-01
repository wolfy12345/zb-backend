<?php
$this->title = '管理员管理';
$this->params['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'?r=admin/admin/index'],['label'=>'管理员管理','url'=>'?r=admin/admin/index'],['label'=>'添加']];
?>

<h3 class="page-title">  </h3>

<?php echo $this->render('_form', $this->context->data);?>