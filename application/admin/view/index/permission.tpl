{extend name="main"}

{block name="content"}
<h3 class="page-title"> 权限错误
    <small>权限错误一般是管理员未向网站负责人申请权限</small>
</h3>
<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-red"> 403 </div>
        <div class=" details">
            <h3>遇到这样的页面非常抱歉！</h3>
            <p>本应该有这样的权限但是却没有，赶快向管理员申请，这其实不是问题！
                <br/> </p>
            <p>
                <a href="/admin/default/index" class="btn red btn-outline"> 初始页 </a>
                <br>
            </p>
        </div>
    </div>
</div>
{/block}