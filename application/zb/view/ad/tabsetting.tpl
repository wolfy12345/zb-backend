{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
<h3 class="page-title">  </h3>
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

                        <div id="outerDiv">
                            <div class="form-group">
                                <label class="control-label col-md-3">小程序appId
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" name="Ad[appId]" class="form-control"
                                           value="{$ad_row['appId'] ?? ''}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">名称<span class="required"> * </span>
                                </label>
                                <div class="col-md-3">
                                    <input placeholder="免费小说" type="text" name="Ad[title]" class="form-control"
                                           value="{$ad_row['title'] ?? ''}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">打开页面路径<span class="required"> * </span>
                                </label>
                                <div class="col-md-3">
                                    <input placeholder="page/index/index" type="text" name="Ad[pagePath]" class="form-control"
                                           value="{$ad_row['pagePath'] ?? ''}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">默认图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 320px; height: 79px;">
                                        {if isset($ad_row['iconPath']) AND $ad_row['iconPath']}
                                            <img src="{$Think.config.img_host}/{$ad_row['iconPath']}">
                                        {/if}
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[iconPath]"> </span>
                                        <input type="hidden" name="File[iconPath]" value="">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 上传图片宽*高(40*40).
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">选中态图片<span class="required"> * </span></label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 320px; height: 79px;">
                                        {if isset($ad_row['selectedIconPath']) AND $ad_row['selectedIconPath']}
                                            <img src="{$Think.config.img_host}/{$ad_row['selectedIconPath']}">
                                        {/if}
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[selectedIconPath]"> </span>
                                        <input type="hidden" name="File[selectedIconPath]" value="">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-success">警告!</span> 上传图片宽*高(50*50).
                                </div>
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
                    <input type="hidden" name="Ad[type]" value="outer" />
                    <input type="hidden" name="Ad[id]" value="{$ad_row['id']}" />
                </form>
            </div>
        </div>
    </div>
</div>
{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
    <script src="/static/themes/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/static/themes/backend/zb/ad.js"></script>
{/block}