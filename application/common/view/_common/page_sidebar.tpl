<div class="page-sidebar navbar-collapse collapse">
    <ul style="padding-top: 20px" data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false" class="page-sidebar-menu  page-header-fixed">
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler"> </div>
        </li>
        <li class="nav-item start {if $Request.module == 'admin' AND $Request.controller == 'Index'}active open{/if}">
            <a class="nav-link nav-toggle" href="javascript:;">
                <i class="icon-home"></i>
                <span class="title">站点</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start {if $Request.module == 'admin' AND $Request.controller == 'Index'}active open{/if}">
                    <a class="nav-link " href="/admin/index/index">
                        <i class="icon-bar-chart"></i>
                        <span class="title">业务概览</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
        {foreach $aclList as $k=>$v}
            {foreach $v['ctl'] as $kk=>$vv}
                <li class="nav-item {if ((isset($vv['module']) AND $Request.module == $vv['module']) OR $Request.module == $v['module']) AND in_array(strtolower($Request.controller), $vv['list_ctl'])}active open{/if}">
                    <a class="nav-link nav-toggle" href="javascript:;">
                        <i class="{$vv['icon']}"></i>
                        <span class="title">{$vv['name']}</span>
                        <span class="selected"></span>
                        <span class="arrow {if $Request.module == $v['module'] AND in_array(strtolower($Request.controller), $vv['list_ctl'])}open{/if}"></span>
                    </a>
                    <ul class="sub-menu">
                        {foreach $vv['act'] as $kkk=>$vvv}
                            {if isset($vvv['sidebar']) AND $vvv['sidebar']}
                                {foreach $vvv['list_side'] as $side_item}
                                    <li class="nav-item start
                                        {if ($Request.module == $vv['module'] OR $Request.module == $v['module']) AND strtolower($Request.controller) == $kkk}
                                            active open
                                        {/if}">
                                        <a class="nav-link " href="/{$vv['module'] ?? $v['module']}/{$kkk}/{$side_item}">
                                            <span class="title">{$vvv['list_act'][$side_item]}</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                {/foreach}
                            {/if}
                        {/foreach}
                    </ul>
                </li>
            {/foreach}
        {/foreach}
    </ul>
</div>