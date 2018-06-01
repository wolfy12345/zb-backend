<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="?r=admin/default/index"  class="logo-default">
                <h4 style="color: #b4bcc8" class="logo_img">微信系统管理</h4>
            </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="<?php echo \yii\helpers\Url::to('@web/themes/backend/images/user-pic.png');?>" />
                        <span class="username username-hide-on-mobile"> <?php echo Yii::$app->session['login_account'];?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">

                        <li>
                            <a href="?r=admin/user/logout">
                                <i class="icon-key"></i> 退出 </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>