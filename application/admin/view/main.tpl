<!DOCTYPE html>
<html lang="zh_CN">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="Firefox" />
        <title>微信后台管理系统-{$title}</title>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        {include file="_common/page_header"}
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                {include file="_common/page_sidebar"}
            </div>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        面包屑
                    </div>
                    {block name="content"}

                    {/block}
                    <input type="hidden" class="request-csrf" name="_csrf" value="{$Request.token}" />
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2016 &copy;  by .
                <a href="" title="yiishop2" target="_blank">YiiShop2</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>