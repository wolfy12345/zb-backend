<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">装B分类</span>
                </div>
            </div>
            <div class="portlet-body">
                <form action="/zb/cat/{$action}" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        {include file="../../common/view/_common/form_tip"}
                        <div class="form-group">
                            <label class="control-label col-md-3">名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Cat[cat_name]" class="form-control"
                                       value="{$cat_row['cat_name'] ?? ''}"/>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 360px; height: 180px;">
                                        {if isset($cat_row['cat_img']) AND $cat_row['cat_img']}
                                            <img src="{$Think.config.img_host}/{$cat_row['cat_img']}">
                                        {/if}
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
                                    <span class="label label-success">警告!</span> 上传图片宽*高(160*90).图片预览仅仅支持 IE10+, FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">显示：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                       {if isset($cat_row['show_status']) AND $cat_row['show_status']==1}checked{else /}''{/if}
                                       class="make-switch switch-radio1" data-size="small">
                                <input type="hidden" value="{if (isset($cat_row['show_status'])&&$cat_row['show_status']==1)}1{else /}0{/if}" name="Cat[show_status]" class="condition-all1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">排序
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-1">
                                <input type="text" name="Cat[p_order]" class="form-control"
                                       value="{$cat_row['p_order'] ?? '99'}"/>
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
                    <input type="hidden" name="_csrf" value="{$Request.token}" />
                </form>
            </div>
        </div>
    </div>
</div>