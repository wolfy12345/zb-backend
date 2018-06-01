<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">装B素材</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="?r=zb/content/<?php echo $action;?>" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        <?php echo $this->render('@app/app/backend/views/common/form_tip');?>
                        <div class="form-group">
                            <label class="control-label col-md-3">选择分类
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <select class="form-control" name="Content[cat_id]">
                                    <option value="0">--请选择分类--</option>
                                    <?php foreach ($cat_list as $v):?>
                                        <option value="<?php echo $v['cat_id'];?>"
                                                <?php if (isset($content_row['cat_id'])&&$content_row['cat_id']==$v['cat_id']):?>selected<?php endif;?>><?php echo $v['cat_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Content[name]" class="form-control"
                                       value="<?php echo isset($content_row['name'])?$content_row['name']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">标题
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Content[title]" class="form-control"
                                       value="<?php echo isset($content_row['title'])?$content_row['title']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">短链接
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Content[short_url]" class="form-control"
                                       value="<?php echo isset($content_row['short_url'])?$content_row['short_url']:'';?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">描述:<span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea class="form-control" rows="3" name="Content[content]"><?php echo isset($content_row['content'])?$content_row['content']:'装B-';?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">参与数量(万)
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Content[take_num]" class="form-control"
                                       value="<?php echo isset($content_row['take_num'])?$content_row['take_num']:sprintf("%.2f",1 + mt_rand() / mt_getrandmax() * (100 - 1));?>"/>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">标题图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 108px; height: 108px;">
                                        <?php if (isset($content_row['img_icon']) && $content_row['img_icon']):?>
                                            <img src="<?php echo Yii::$app->params['img_host'].$content_row['img_icon'];?>">
                                        <?php endif;?>
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[img_icon]"> </span>
                                            <input type="hidden" name="File[img_icon]" value="">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 上传图片宽*高(108*108).图片预览仅仅支持 IE10+, FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">推广图片
                                图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 160px; height: 85px;">
                                        <?php if (isset($content_row['img_example']) && $content_row['img_example']):?>
                                            <img src="<?php echo Yii::$app->params['img_host'].$content_row['img_example'];?>">
                                        <?php endif;?>
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[img_example]"> </span>
                                        <input type="hidden" name="File[img_example]" value="">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 上传图片宽*高(320*170).图片预览仅仅支持 IE10+, FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">前台显示：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                    <?php echo (isset($content_row['show_status'])&&$content_row['show_status']==1)?'checked':'';?>
                                       class="make-switch switch-radio1" data-size="small">
                                <input type="hidden" value="<?php echo isset($content_row['show_status'])&&$content_row['show_status']==1?1:0;?>" name="Content[show_status]" class="condition-all1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">热门：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                    <?php echo (isset($content_row['is_hot'])&&$content_row['is_hot']==1)?'checked':'';?>
                                       class="make-switch switch-radio2" data-size="small">
                                <input type="hidden" value="<?php echo isset($content_row['is_hot'])&&$content_row['is_hot']==1?1:0;?>" name="Content[is_hot]" class="condition-all2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">推荐：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                    <?php echo (isset($content_row['is_recommend'])&&$content_row['is_recommend']==1)?'checked':'';?>
                                       class="make-switch switch-radio3" data-size="small">
                                <input type="hidden" value="<?php echo isset($content_row['is_recommend'])&&$content_row['is_recommend']==1?1:0;?>" name="Content[is_recommend]" class="condition-all3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">排序
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-1">
                                <input type="text" name="Content[p_order]" class="form-control"
                                       value="<?php echo isset($content_row['p_order'])?$content_row['p_order']:'99';?>"/>
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

