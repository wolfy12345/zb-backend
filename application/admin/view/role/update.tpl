{extend name="../../common/view/main"}

{block name="content"}
    <h3 class="page-title">  </h3>

    {include file="role/_form" }
{/block}
{block name="js"}
    {__block__}
    <script src="/static/themes/backend/admin/role.js"></script>
{/block}