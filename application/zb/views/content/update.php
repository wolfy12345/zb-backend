<?php
$this->title = '素材管理';
$this->params['breadcrumbs'] = [['label'=>'素材管理','url'=>'?r=zb/content/index'],['label'=>$content_row['name'],'url'=>'?r=zb/content/update&content_id='.$content_row['content_id']],['label'=>'编辑']];
?>

<h3 class="page-title">  </h3>
<?php echo $this->render('_form', $this->context->data);?>