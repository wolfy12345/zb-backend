<form action="?r=admin/admin/index" method="post" class="search-single">
    <select class="bs-select form-control input-small" name="Single[name]" data-style="btn-success">
        <option value="login_account"
        <?php if (isset($search_attributes['Single']['name'])&&$search_attributes['Single']['name']=='login_account'):?>selected<?php endif;?>>登录名</option>
        <option value="truename"
        <?php if (isset($search_attributes['Single']['name'])&&$search_attributes['Single']['name']=='truename'):?>selected<?php endif;?>>真实名</option>
    </select>
    <input type="text" class="form-control input-inline" placeholder=""
           value="<?php echo isset($search_attributes['Single']['search_val'])&&$search_attributes['Single']['search_val']?$search_attributes['Single']['search_val']:'';?>" name="Single[search_val]">
    <button type="button" class="btn green search-submit">搜索</button>
    <a type="button" class="btn blue-madison search-multi-open" data-toggle="0">高级筛选</a>
    <input type="hidden" name="type" value="1" />
    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
</form>

<div class="page-quick-sidebar-wrapper multi" data-close-on-body-click="false">
    <div class="portlet light portlet-fit portlet-form bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class=" icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">高级筛选</span>
            </div>
            <div class="actions">
                <button type="button" class="btn default search-multi-close">关闭</button>
            </div>
        </div>
        <div class="portlet-body">
            <!-- BEGIN FORM-->
            <form action="?r=admin/admin/index" method="post" class="form-horizontal">
                <div class="multi-search">
                    <div class="form-group">
                        <label class="control-label col-md-3">登录名
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="Multi[login_account]" class="form-control"
                                   value="<?php echo isset($search_attributes['Multi']['login_account'])&&$search_attributes['Multi']['login_account']?$search_attributes['Multi']['login_account']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="multi-search">
                    <div class="form-group">
                        <label class="control-label col-md-3">真实名
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="Multi[truename]" class="form-control"
                                   value="<?php echo isset($search_attributes['Multi']['truename'])&&$search_attributes['Multi']['truename']?$search_attributes['Multi']['truename']:'';?>"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="type" value="2" />
                            <input type="hidden" class="multi-status" value="<?php echo isset($search_attributes['Multi']) && $search_attributes['Multi']?1:0;?>"/>
                            <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
                            <button type="submit" class="btn green">立即筛选</button>
                            <button type="reset" class="btn default">清除条件</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>