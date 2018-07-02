{extend name="../../common/view/main"}

{block name="css"}
    {__block__}
    <link href="/static/themes/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
    <link href="/static/themes/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
{/block}

{block name="content"}
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
                    <form action="/zb/system/{$action}" class="form-horizontal" id="validation-form" method="post">
                        <div class="form-body">
                            {include file="../../common/view/_common/form_tip"}
                            <div class="form-group">
                                <label class="control-label col-md-3">首页弹窗是否开启：</label>
                                <div class="col-md-9">
                                    <input type="checkbox" data-on-text="&nbsp;是&nbsp;" data-off-text="&nbsp;否&nbsp;"
                                           {if $index_popup}checked{else /}''{/if}
                                    class="make-switch switch-radio1" data-size="small">
                                    <input type="hidden" value="{if $index_popup}1{else /}0{/if}" name="System[index_popup]" class="condition-all1">
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">提交</button>
                                    <a href="/zb/system/index" type="reset" class="btn default">取消</a>
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
    <script src="/static/themes/backend/zb/ad.js"></script>
{/block}