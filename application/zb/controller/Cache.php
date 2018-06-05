<?php
/**
 * 缓存管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\zb\controller;

use app\common\components\AppAdminAcl;
use think\Controller;
use think\facade\Session;
use think\facade\Cache as MemCache;

class Cache extends Controller
{
    private $data = [];

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
        $this->data['aclList'] = $aclList;
    }

//    public function init()
//    {
//        parent::init(); // TODO: Change the autogenerated stub
//    }

    public function index()
    {
        $this->data['title'] = '装B管理';
        $this->data['breadcrumbs'] = [['label'=>'清空缓存']];

//        MemCache::store('memcache')->set('name','value',3600);
//        echo MemCache::get('name');
//        MemCache::clear();
        return $this->fetch('index', $this->data);
    }
}