<!DOCTYPE html>
<html lang="zh_CN">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="Firefox" />
        <title>微信后台管理系统-{$title}</title>
        {block name="css"}
            <link href="/static/themes/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
            <link href="/static/themes/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="/static/themes/global/plugins/datatables/datatables.min.css" rel="stylesheet">
            <link href="/static/themes/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet">
            <link href="/static/themes/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
            <link href="/static/themes/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet">
            <link href="/static/themes/pages/css/error.min.css" rel="stylesheet">
            <link href="/static/themes/global/css/components.min.css" rel="stylesheet">
            <link href="/static/themes/global/css/plugins.min.css" rel="stylesheet">
            <link href="/static/themes/layouts/layout/css/layout.css" rel="stylesheet">
            <link href="/static/themes/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet">
            <link href="/static/themes/layouts/layout/css/custom.min.css" rel="stylesheet">
            <link href="/static/themes/backend/css/public.css" rel="stylesheet">
        {/block}
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        {include file="../../common/view/_common/page_header"}
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                {include file="../../common/view/_common/page_sidebar"}
            </div>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li><a href="/admin/index/index">初始页</a><i class="fa fa-circle"></i></li>
                            {foreach $breadcrumbs as $k=>$b}
                                {if isset($b['url'])}
                                    <li><a href="{$b['url']}">{$b['label']}</a><i class="fa fa-circle"></i></li>
                                {else /}
                                    <li class="active">{$b['label']}</li>
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                    {block name="content"}

                    {/block}
                    <input type="hidden" class="request-csrf" name="_csrf" value="{$Request.token}" />
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy;  by .
                <a href="" title="TP5" target="_blank">TP5</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        {block name="js"}
            <script src="/static/themes/global/plugins/jquery.min.js"></script>
            <script src="/static/themes/global/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="/static/themes/global/plugins/jquery.blockui.min.js"></script>
            <script src="/static/themes/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
            <script src="/static/themes/global/plugins/bootbox/bootbox.min.js"></script>
            <script src="/static/themes/global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
            <script src="/static/themes/global/scripts/app.min.js"></script>
            <script src="/static/themes/layouts/layout/scripts/layout.min.js"></script>
            <script src="/static/themes/layouts/layout/scripts/demo.min.js"></script>
            <script src="/static/themes/layouts/global/scripts/quick-sidebar.min.js"></script>
            <script src="/static/themes/backend/global/table-databases-managed.js"></script>
            <script src="/static/themes/backend/global/form-validate.js"></script>
            <script src="/static/themes/backend/global/form-select.js"></script>
            <script src="/static/themes/backend/global/public.js"></script>
        {/block}
    </body>
</html>