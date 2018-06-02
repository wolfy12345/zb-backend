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
                <form action="/admin/role/{$action}" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        {include file="_common/form_tip"}
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                <input type="checkbox" class="group-checkable" data-set="#table .checkboxes" />全选
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                角色名
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="Group[group_name]" class="form-control"
                                    value="{$role_row['group_name'] ?? ''}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                {foreach $aclList as $v}
                                    <div class="form-group">
                                        <div class="caption">
                                            <h3 class="caption-subject font-green">{$v['name']}</h3>
                                        </div>
                                        {foreach $v['ctl'] as $vv}
                                            <div class="caption">
                                                <h5 class="caption-subject font-green sbold">{$vv['name']}</h5>
                                            </div>
                                            {foreach $vv['act'] as $kkk=>$vvv}
                                                <div class="caption">
                                                    {foreach $vvv['list_act'] as $kkkk=>$vvvv}
                                                        <label>
                                                            <input type="checkbox" class="checkboxes" value="{$v['module']}/{$kkk}/{$kkkk}" name="Acl[]"
                                                                {php}$p = $v['module'].'/'.$kkk.'/'.$kkkk; if(isset($role_row['acl']) && strpos($role_row['acl'], $p) !== false) echo 'checked';{/php} />{$vvvv}
                                                        </label>
                                                    {/foreach}
                                                </div>
                                            {/foreach}
                                        {/foreach}
                                    </div>
                                {/foreach}
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
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>