<?php
/**
 * 权限角色管理
 */

namespace app\common\components;

use think\facade\Session;

class AppAdminAcl
{
//权限配制数据
    public static $aclList = [
        [
            'module'=>'zb',
            'name'=>'装B神器',
            'ctl'=>[
                [
                    'name'=>'装B神器',
                    'icon'=>'icon-emoticon-smile',
                    'module'=>'zb',
                    'list_ctl'=>['cat','content', 'ad', 'cache'],
                    'act'=>[
                        'cat'=>[
                            'name'=>'分类',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'分类列表','create'=>'分类创建','update'=>'分类编辑','cancel'=>'分类删除']
                        ],
                        'content'=>[
                            'name'=>'素材',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'素材列表','create'=>'素材创建','update'=>'素材编辑','cancel'=>'素材删除', 'resultimg' => '上传结果图']
                        ],
                        'ad'=>[
                            'name'=>'广告',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'广告列表','create'=>'广告创建','update'=>'广告编辑','cancel'=>'广告删除','tabsetting' => '底部导航条']
                        ],
                        'cache'=>[
                            'name'=>'缓存',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'清空缓存']
                        ],
                        'recycle'=>[
                            'name'=>'回收站',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'回收站列表']
                        ],
                    ]
                ],
            ]
        ],
        [
            'module'=>'admin',
            'name'=>'管理员和权限',
            'ctl'=>[
                [
                    'name'=>'管理员和权限',
                    'icon'=>'icon-user',
                    'module'=>'admin',
                    'list_ctl'=>['role','admin'],
                    'act'=>[
                        'role'=>[
                            'name'=>'角色管理',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'角色列表','create'=>'角色创建','update'=>'角色编辑','cancel'=>'角色冻结']
                        ],
                        'admin'=>[
                            'name'=>'操作员管理',
                            'sidebar'=>true,
                            'list_side'=>['index'],
                            'list_act'=>['index'=>'操作员列表','create'=>'操作员创建','update'=>'操作员编辑','cancel'=>'操作员冻结']
                        ],
                    ]
                ],
            ]
        ],
    ];

    /**
     * 后台菜单过滤
     *
     * @param $acl_list
     * @param $super
     * @return array
     */
    public static function filterMenu($acl_list,$super)
    {
        $item = self::$aclList;
        if ($super == 1) return $item;
        foreach ($item as $k=>$v) {
            foreach ($v['ctl'] as $kk=>$vv) {
//                if(((isset($vv['module']) && request()->module() == $vv['module']) || request()->module() == $v['module']) && in_array(request()->controller(), $vv['list_ctl'])) {
//                    $vv['liclass'] = "active open";
//                }
//                if(request()->module() == $v['module'] && in_array(request()->controller(), $vv['list_ctl'])) {
//                    $vv['spanclass'] = "open";
//                }

                foreach ($vv['act'] as $kkk=>$vvv) {
                    foreach ($vvv['list_side'] as $side_item) {
                        $acl = $v['module'].'/'.$kkk.'/'.$side_item;
                        if (strpos($acl_list, $acl) === false) {
                            unset($item[$k]['ctl'][$kk]['act'][$kkk]);
                        }
                    }
                }
                if (empty($item[$k]['ctl'][$kk]['act'])) unset($item[$k]['ctl'][$kk]);
            }
            if (empty($item[$k]['ctl'])) unset($item[$k]);
        }
//        print_r($item);
        return $item;
    }

    /**
     * 判断按钮是否有权限
     *
     * @param $act
     * @param $button
     * @return string
     */
    public static function filterButton($act, $button = true)
    {
        if (Session::get('super') == 1) return $button;
        if (strpos(Session::get('acl'), $act) !== false) return $button;
        return '';
    }
}