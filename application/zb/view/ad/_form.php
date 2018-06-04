<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">装B广告</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="?r=zb/ad/<?php echo $action;?>" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        <?php echo $this->render('@app/app/backend/views/common/form_tip');?>
                        <div class="form-group">
                            <label class="control-label col-md-3">选择类型
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <select class="form-control" name="Ad[position_id]">
                                    <option value="0">--请选择分类--</option>
                                    <?php foreach ($ad_type as $k=>$v):?>
                                        <option value="<?php echo $k;?>"
                                                <?php if (isset($ad_row['position_id'])&&$ad_row['position_id']==$k):?>selected<?php endif;?>><?php echo $v;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Ad[title]" class="form-control"
                                       value="<?php echo isset($ad_row['title'])?$ad_row['title']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">链接
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Ad[link]" class="form-control"
                                       value="<?php echo isset($ad_row['link'])?$ad_row['link']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">广告图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 320px; height: 79px;">
                                        <?php if (isset($ad_row['logo']) && $ad_row['logo']):?>
                                            <img src="<?php echo Yii::$app->params['img_host'].$ad_row['logo'];?>">
                                        <?php endif;?>
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[logo]"> </span>
                                            <input type="hidden" name="File[logo]" value="">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 上传图片宽*高(640*158).图片预览仅仅支持 IE10+, FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">显示：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                    <?php echo (isset($ad_row['status'])&&$ad_row['status'])||!isset($ad_row['status'])?'checked':'';?>
                                       class="make-switch switch-radio1" data-size="small">
                                <input type="hidden" value="<?php echo (isset($ad_row['status'])&&$ad_row['status'])||!isset($ad_row['status'])==1?1:0;?>" name="Ad[status]" class="condition-all1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">排序
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-1">
                                <input type="text" name="Ad[p_order]" class="form-control"
                                       value="<?php echo isset($ad_row['p_order'])?$ad_row['p_order']:'99';?>"/>
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
            </div>
        </div>
    </div>
</div>

