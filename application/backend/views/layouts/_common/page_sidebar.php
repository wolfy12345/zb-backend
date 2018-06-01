<?php
use app\app\backend\components\AppAdminAcl;
?>
<div class="page-sidebar navbar-collapse collapse">
    <ul style="padding-top: 20px" data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false" class="page-sidebar-menu  page-header-fixed">
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler"> </div>
        </li>
        <li class="nav-item start <?php if($this->context->module->id == 'admin' && $this->context->id == 'default'):?>active open<?php endif;?>">
            <a class="nav-link nav-toggle" href="javascript:;">
                <i class="icon-home"></i>
                <span class="title">站点</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start <?php if($this->context->module->id == 'admin' && $this->context->id == 'default'):?>active open<?php endif;?>">
                    <a class="nav-link " href="?r=admin/default/index">
                        <i class="icon-bar-chart"></i>
                        <span class="title">业务概览</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
        <?php foreach (AppAdminAcl::filterMenu(Yii::$app->session['acl'], Yii::$app->session['super']) as $k=>$v):?>
            <?php foreach ($v['ctl'] as $kk=>$vv):?>
                <li class="nav-item <?php if(((isset($vv['module'])&&$this->context->module->id == $vv['module']) || $this->context->module->id == $v['module']) && in_array($this->context->id,$vv['list_ctl'])):?>active open<?php endif;?>">
                    <a class="nav-link nav-toggle" href="javascript:;">
                        <i class="<?php echo $vv['icon'];?>"></i>
                        <span class="title"><?php echo $vv['name'];?></span>
                        <span class="selected"></span>
                        <span class="arrow <?php if($this->context->module->id == $v['module'] && in_array($this->context->id,$vv['list_ctl'])):?>open<?php endif;?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php foreach ($vv['act'] as $kkk=>$vvv):?>
                            <?php if (isset($vvv['sidebar']) && $vvv['sidebar']):?>
                                <?php foreach ($vvv['list_side'] as $side_item):?>
                                <li class="nav-item start
                                    <?php if((($this->context->module->id == $vv['module']) || $this->context->module->id == $v['module'])
                                    && $this->context->id == $kkk):
                                    ?>active open
                                    <?php endif;?>
                                ">
                                    <a class="nav-link " href="?r=<?php echo (isset($vv['module'])?$vv['module']:$v['module']).'/'.$kkk.'/'.$side_item;?>">
                                        <span class="title"><?php echo $vvv['list_act'][$side_item];?></span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </li>
            <?php endforeach;?>
        <?php endforeach;?>
    </ul>
</div>