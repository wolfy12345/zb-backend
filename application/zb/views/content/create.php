<?php
$this->title = '素材管理';
$this->params['breadcrumbs'] = [['label'=>'素材管理','url'=>'?r=zb/content/index'],['label'=>'新增']];
?>

<h3 class="page-title">  </h3>
<?php echo $this->render('_form', $this->context->data);?>