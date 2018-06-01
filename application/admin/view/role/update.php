<?php
$this->title = '角色管理';
$this->params['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'?r=admin/role/index'],['label'=>'角色管理','url'=>'?r=admin/role/index'],['label'=>'编辑']];
?>

<h3 class="page-title">  </h3>

<?php echo $this->render('_form', $this->context->data);?>