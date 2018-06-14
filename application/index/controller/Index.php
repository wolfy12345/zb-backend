<?php
/**
 * 默认页
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    /**
     * 初始页
     *
     * @return string
     */
    public function index()
    {
        return redirect("/admin/user/login");
    }
}
