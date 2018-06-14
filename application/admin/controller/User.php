<?php
/**
 * 用户管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\admin\controller;

use app\admin\model\AdminUser;
use app\admin\model\AppRole;
use think\Controller;
use think\Request;
use think\facade\Session;

class User extends Controller
{
    public $data = [];

    public function index()
    {
        return $this->fetch('index');
    }

    /**
     * 用户登录
     */
    public function login(Request $req)
    {
        if(!empty(Session::get("user_id"))) {
            return redirect("/admin/index/index");
        }

        $this->data['title'] = "index";

        $this->data['error'] = '';
        if ($req->post()) {
            $userParam = $req->post();
            $result = AdminUser::where([
                'login_account'=>$userParam['username'],
                'password'=>md5(md5($userParam['password'])),
                'status'=>'0',
            ])->find();

            if (!$result) $this->data['error'] = '用户名或密码错误';
            else {
                //保存用户信息
                $this->addSession($result);

                //更改管理员登录信息
                $aUser = new AdminUser();
                $aUser->save([
                    'last_login_time'=>time(),
                    'last_login_ip'=> $req->ip(),
                ],[
                    'user_id' => $result['user_id']
                ]);
                return redirect("/admin/index/index");
            }
        }
        return $this->fetch('login', $this->data);
    }

    /**
     * 退出
     */
    public function logout()
    {
        Session::delete('user_id');
        Session::delete('login_account');
        Session::delete('super');

        $this->redirect('/admin/user/login');
    }

    /**
     * 注入session
     *
     * @param $memberParams
     */
    protected function addSession($memberParams)
    {
        //用户权限
        Session::set('user_id',  $memberParams['user_id']);
        Session::set('login_account',  $memberParams['login_account']);
        #判断是否超级管理员
        if ($memberParams['login_account'] == 'admin')
            Session::set('super',  1);
        else {
            Session::set('super',  0);
            $appRole = new AppRole();
            $role_row = $appRole->getRoleById($memberParams['user_id']);

            Session::set('group_name',  $role_row['group_name']);
            Session::set('acl',  $role_row['acl']);
        }
    }
}