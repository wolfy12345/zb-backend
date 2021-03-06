<?php
/**
 * 后台管理员管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\admin\controller;

use app\admin\model\AdminGroup;
use app\admin\model\AdminRole;
use app\admin\model\AdminUser;
use app\common\controller\BaseController;
use app\admin\components\Search;
use think\Db;
use think\Request;


class Admin extends BaseController
{
//    private $data = [];
    public $pageSize = 10;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
//        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
//        $this->data['aclList'] = $aclList;
    }


    /**
     * 列表页
     */
    public function index(Request $req)
    {
        $this->data['title'] = '管理员管理';
        $this->data['breadcrumbs'] = [['label' => '管理员和权限', 'url' => '/admin/admin/index'], ['label' => '管理员管理']];

        $this->data['search_attributes'] = $search = $req->param();

        $data = AdminUser::where('status', '=', 0);
        if ($search) {
            $data = Search::admin($search, $data);
        }
        $list = $data->order('user_id DESC')->paginate($this->pageSize);
        $page = $list->render();
        $this->data['list'] = $list;
        $this->data['page'] = $page;

        return $this->fetch('index', $this->data);
    }

    /**
     * 创建
     */
    public function create(Request $req)
    {
        $this->data['title'] = '管理员管理';
        $this->data['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'/admin/admin/index'],['label'=>'管理员管理','url'=>'/admin/admin/index'],['label'=>'添加']];


        if ($req->post()) {
            $attributes = $req->param();
            $user = $attributes['User'];
            $role = $attributes['Role'];
            $checkData = $user + $role;
            $user['password'] = md5(md5($user['password']));
            $user['last_modify'] = time();

            $adminUser = new AdminUser();
            $adminRole = new AdminRole();

            $result = $this->validate(
                $checkData, 'app\admin\validate\User');

            if (true !== $result) {
                $this->redirect('create', ['ref_sub' => 500, 'msg' => $result]);
                exit;
            }

            $submit = $adminUser->save($user) ? 200 : 500;
            if ($submit == 200) {
                $role['user_id'] = $adminUser->user_id;
                $adminRole->save($role);
            }
            $this->redirect('create', ['ref_sub' => $submit]);
        }

        $this->data['action'] = 'create';
        $this->data['role_list'] = AdminGroup::all(['status' => 'active']);
        return $this->fetch('create', $this->data);
    }

    /**
     * 编辑
     */
    public function update(Request $req)
    {
        $this->data['title'] = '管理员管理';
        $this->data['breadcrumbs'] = [['label'=>'管理员和权限','url'=>'/admin/admin/index'],['label'=>'管理员管理','url'=>'/admin/admin/index'],['label'=>'编辑']];
        
        $user_id = $req->param('user_id');
        if ($req->post()) {
            $attributes = $req->param();
            $user = $attributes['User'];
            $user['last_modify'] = time();
            $role = $attributes['Role'];

            $adminUser = AdminUser::get($user_id);
            if ($user['password']) $user['password'] = md5(md5($user['password']));
            else $user['password'] = $adminUser->password;
            $adminRole = AdminRole::where('user_id', $user_id)->find();

            $submit = $adminUser->save($user, ['user_id' => $user_id]) ? 200 : 500;
            if ($submit == 200) {
                if ($adminRole) {
                    $adminRole = AdminRole::where('user_id',$user_id)->find();
                    $adminRole->role_id = $role['role_id'];
                    $adminRole->save();
                } else {
                    $adminRole = new AdminRole();
                    $role['user_id'] = $user_id;
                    $adminRole->save($role);
                }
            }
            $this->redirect('update', ['user_id' => $user_id, 'ref_sub' => $submit]);
        }

        $this->data['action'] = 'update/user_id/' . $user_id;
        $this->data['user_row'] = AdminUser::find(['user_id' => $user_id]);
        $this->data['role_row'] = AdminRole::where('user_id', $user_id)->find();
        $this->data['role_list'] = AdminGroup::all(['status' => 'active']);

        return $this->fetch('update', $this->data);
    }

    /**
     * 取消
     */
    public function cancel(Request $req)
    {
        $user_id = $req->param('user_id');
        if (!$user_id) return json(['code' => 500, 'msg' => '没有获取请求的ID']);
        $adminUser = new AdminUser();
        $submit = $adminUser->save(['status' => '1'], ['user_id' => $user_id]) ? 200 : 500;
        if ($submit == 500) return json(['code' => 500, 'msg' => '冻结失败']);
        return json(['code' => 200]);
    }
}