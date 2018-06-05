<?php
/**
 * 默认页
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */
namespace app\admin\controller;

use think\Controller;
use app\common\components\AppAdminAcl;
use think\facade\Session;

class Index extends Controller
{
    private $data = [];

//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }
//
//    public $enableCsrfValidation = false;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
        $this->data['aclList'] = $aclList;
    }

    /**
     * 初始页
     *
     * @return string
     */
    public function index()
    {
//        $this->data['js'] = [
//            'global/plugins/counterup/jquery.waypoints.min.js',
//            'global/plugins/counterup/jquery.counterup.min.js',
//            'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
//            'global/plugins/flot/jquery.flot.min.js',
//            'global/plugins/flot/jquery.flot.resize.min.js',
//            'global/plugins/flot/jquery.flot.categories.min.js',
//            'backend/admin/default.js',
//        ];
//        $this->data['css'] = [
//
//        ];

        $this->data['title'] = '初始页';
        $this->data['breadcrumbs'] = [['label'=>'站点','url'=>'/admin/index/index'],['label'=>'业务概览']];

        return $this->fetch('index', $this->data);
    }

    /**
     * 权限不足提示
     */
    public function permission()
    {
        $this->data['title'] = '权限错误';
        $this->data['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'/admin/admin/index'],['label'=>'权限错误']];

        return $this->fetch('permission', $this->data);
    }
}