<?php
$this->title = '广告管理';
$this->params['breadcrumbs'] = [['label'=>'广告管理','url'=>'?r=zb/ad/index'],['label'=>$ad_row['title'],'url'=>'?r=zb/ad/update&ad_id='.$ad_row['ad_id']],['label'=>'编辑']];
?>

<h3 class="page-title">  </h3>
<?php echo $this->render('_form', $this->context->data);?>