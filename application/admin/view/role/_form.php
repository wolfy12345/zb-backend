<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">角色表单</span>
                </div>
            </div>
            <div class="portlet-body" id="table">
                <!-- BEGIN FORM-->
                <form action="?r=admin/role/<?php echo $action;?>" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        <?php echo $this->render('@app/app/backend/views/common/form_tip');?>
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />全选
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                角色名
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Group[group_name]" class="form-control"
                                    value="<?php echo isset($role_row['group_name'])?$role_row['group_name']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <?php foreach (\app\app\backend\components\AppAdminAcl::$aclList as $v):?>
                                    <div class="form-group">
                                        <div class="caption">
                                            <h3 class="caption-subject font-green"><?php echo $v['name'];?></h3>
                                        </div>
                                        <?php foreach ($v['ctl'] as $vv):?>
                                            <div class="caption">
                                                <h5 class="caption-subject font-green sbold"><?php echo $vv['name'];?></h5>
                                            </div>
                                            <?php foreach ($vv['act'] as $kkk=>$vvv):?>
                                                <div class="caption">
                                                    <?php foreach ($vvv['list_act'] as $kkkk=>$vvvv):?>
                                                        <label>
                                                            <input type="checkbox" class="checkboxes" value="<?php echo $v['module'].'/'.$kkk.'/'.$kkkk?>" name="Acl[]"
                                                                <?php if (isset($role_row['acl'])&&strpos($role_row['acl'], $v['module'].'/'.$kkk.'/'.$kkkk)!==false):?>checked<?php endif;?>/><?php echo $vvvv;?>
                                                        </label>
                                                    <?php endforeach;?>
                                                </div>
                                            <?php endforeach;?>
                                        <?php endforeach;?>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">提交</button>
                                <button type="reset" class="btn default">取消</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>