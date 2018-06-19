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
                        <span class="caption-subject font-green sbold">装B素材</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="/zb/content/{$action}" class="form-horizontal" id="validation-form" method="post">
                        <div class="form-body">
                            {foreach $imgs as $k => $v}
                                <div class="row" style="margin-bottom: 15px;">
                                    {foreach $v as $kk => $vv}
                                        <div class="col-md-3">
                                            <img width="200" height="200" src="{$vv['path']}" />
                                            <div style="text-align: center;">
                                                <span>{$vv['filename']}</span><a data-href="/zb/content/deleteimg/filename/{$vv['filename']}/name/{$name}" type="button" class="btn btn-sm btn-danger delete">删除</a>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                            {/foreach}

                            <div class="form-group ">
                                <label class="control-label col-md-3">新图片<span class="required"> * </span></label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                             style="width: 108px; height: 108px;">
                                                <img src="">
                                        </div>
                                        <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> 选择图片 </span>
                                            <span class="fileinput-exists"> 重选图片 </span>
                                            <input type="file" name="File[img_result]"> </span>
                                            <input type="hidden" name="File[img_result]" value="">
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                        <span class="label label-success">警告!</span> 上传图片务必指定图片名，不要让程序随机生成图片名
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">图片名
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-3">
                                    <input type="text" placeholder="main.jpg" name="Content[filename]" class="form-control" />
                                    <input type="hidden" name="Content[name]" class="form-control" value="{$name}" />
                                    <span class="label label-success">警告!</span> 图片名要包含图片类型
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


{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
    <script src="/static/themes/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/static/themes/backend/zb/content.js"></script>
{/block}