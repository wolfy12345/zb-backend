<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold">管理员表单</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="/admin/admin/{$action}" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-body">
                        {include file="../../common/view/_common/form_tip"}
                        <div class="form-group">
                            <label class="control-label col-md-3">登录名
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <input type="text" name="User[login_account]" class="form-control"
                                    value="{$user_row['login_account'] ?? ''}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">登录密码
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <input type="password" name="User[password]" class="form-control"
                                       value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">真实名
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <input type="text" name="User[truename]" class="form-control"
                                       value="{$user_row['truename'] ?? ''}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">角色组
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-2">
                                <select class="bs-select form-control" name="Role[role_id]">
                                    <option value="0">--请选择--</option>
                                    {foreach $role_list as $v}
                                        <option {if isset($role_row['role_id']) AND $role_row['role_id']==$v['role_id']}selected{/if} value="{$v['role_id']}">{$v['group_name']}</option>
                                    {/foreach}
                                </select>
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