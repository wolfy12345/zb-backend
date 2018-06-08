{extend name="main_login" /}

{block name="css"}
    {__block__}
    <link href="/static/themes/pages/css/login.min.css" rel="stylesheet">
{/block}

{block name="content"}
<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="/admin/user/login" method="post" novalidate="novalidate">
    <h3 class="form-title font-green">后台登录</h3>
    <div class="alert alert-danger display-hide" style="display: <?php echo !empty($error)?'block':'none';?>" >
        <button class="close" data-close="alert"></button>
        <span> {$error ?? ""} </span>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">用户名</label>
        <input class="form-control form-control-solid placeholder-no-fix" value=""
               type="text" autocomplete="off" placeholder="用户名" name="username" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">密码</label>
        <input class="form-control form-control-solid placeholder-no-fix" value=""
               type="password" autocomplete="off" placeholder="密码" name="password" /> </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-4 col-md-9">
                <button type="submit" class="btn green uppercase">登录</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="_csrf" value="{$Request.token}" />
</form>
<!-- END LOGIN FORM -->
{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script src="/static/themes/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
    <script src="/static/themes/global/plugins/select2/js/select2.full.min.js"></script>
    <script src="/static/themes/pages/scripts/login.js"></script>
{/block}
