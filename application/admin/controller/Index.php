<?php
/**
 * 默认页
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */
namespace app\admin\controller;

use app\common\controller\BaseController;

class Index extends BaseController
{
//    private $data = [];


    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
//        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
//        $this->data['aclList'] = $aclList;
    }

    /**
     * 初始页
     *
     * @return string
     */
    public function index()
    {
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
