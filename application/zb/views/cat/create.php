<?php
$this->title = '分类管理';
$this->params['breadcrumbs'] = [['label'=>'分类管理','url'=>'?r=zb/cat/index'],['label'=>'新增']];
?>

<h3 class="page-title">  </h3>
<?php echo $this->render('_form', $this->context->data);?>