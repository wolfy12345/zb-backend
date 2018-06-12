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
                <form action="/zb/ad/{$action}" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        {include file="../../common/view/_common/form_tip"}

                        <div class="form-group">
                            <label class="control-label col-md-3">跳转类型
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <select class="form-control" name="Ad[type]" id="type">
                                    <option value="1" {if isset($ad_row['type']) AND $ad_row['type']==1}selected{/if}>内部素材</option>
                                    <option value="2" {if isset($ad_row['type']) AND $ad_row['type']==2}selected{/if}>外部小程序</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group {if isset($ad_row['type']) AND $ad_row['type']==2}hide{/if}" id="innerDiv">
                            <label class="control-label col-md-3">关联素材ID
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Ad[content_id]" class="form-control"
                                       value="{$ad_row['content_id'] ?? ''}"/>
                            </div>
                        </div>

                        <div id="outerDiv" class="{if empty($ad_row['type']) OR $ad_row['type']==1}hide{/if}">
                            <div class="form-group">
                                <label class="control-label col-md-3">小程序appId
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" name="Ad[app_id]" class="form-control"
                                           value="{$ad_row['app_id'] ?? ''}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">打开页面路径
                                </label>
                                <div class="col-md-3">
                                    <input placeholder="page/index/index" type="text" name="Ad[path]" class="form-control"
                                           value="{$ad_row['path'] ?? ''}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">额外参数
                                </label>
                                <div class="col-md-3">
                                    <textarea name="Ad[extra_data]" rows="5" class="form-control  margin-top-10" placeholder="输入格式：{name: 'test', type: 5}">{$ad_row['extra_data'] ?? ''}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <!--<div class="form-group">
                            <label class="control-label col-md-3">链接
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Ad[link]" class="form-control"
                                       value="{$ad_row['link'] ?? ''}"/>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="control-label col-md-3">选择位置
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <select class="form-control" name="Ad[position_id]">
                                    <option value="0">--请选择分类--</option>
                                    {foreach $ad_type as $k=>$v}
                                        <option value="{$k}"
                                                {if isset($ad_row['position_id']) AND $ad_row['position_id']==$k}selected{/if}>{$v}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">名称
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-3">
                                <input type="text" name="Ad[title]" class="form-control"
                                       value="{$ad_row['title'] ?? ''}"/>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">广告图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 320px; height: 79px;">
                                        {if isset($ad_row['logo']) AND $ad_row['logo']}
                                            <img src="{$Think.config.img_host}/{$ad_row['logo']}">
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
                                    <span class="label label-success">警告!</span> 上传图片宽*高(640*158).图片预览仅仅支持 IE10+, FF3.6+, Safari6.0+, Chrome6.0+, Opera11.1+. 在较老的浏览器中只显示文件名.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">显示：</label>
                            <div class="col-md-9">
                                <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                       {if isset($ad_row['status']) AND $ad_row['status']==1}checked{else /}''{/if}
                                       class="make-switch switch-radio1" data-size="small">
                                <input type="hidden" value="{if isset($ad_row['status']) AND $ad_row['status']==1}1{else /}0{/if}" name="Ad[status]" class="condition-all1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">排序
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-1">
                                <input type="text" name="Ad[p_order]" class="form-control"
                                       value="{$ad_row['p_order'] ?? '99'}"/>
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

