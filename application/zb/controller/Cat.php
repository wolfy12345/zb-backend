<?php
/**
 * 分类管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\zb\controller;

use app\common\components\AppAdminAcl;
use app\common\components\UploadFile;
use app\zb\model\ZbCat;
use app\zb\model\ZbContent;
use think\Controller;
use think\facade\Session;
use think\Request;

class Cat extends Controller
{
    private $data = [];
    private $pageSize = 10;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
        $this->data['aclList'] = $aclList;
    }

//    public function init()
//    {
//        parent::init(); // TODO: Change the autogenerated stub
//
//        $this->data['css']  = [
//            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
//            'global/plugins/fancybox/source/jquery.fancybox.css',
//            'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
//        ];
//        $this->data['js']   = [
//            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
//            'global/plugins/fancybox/source/jquery.fancybox.pack.js',
//            'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
//            'backend/zb/cat.js'
//        ];
//    }

    /**
     * 列表
     */
    public function index()
    {
        $this->data['title'] = '分类管理';
        $this->data['breadcrumbs'] = [['label' => '装B分类', 'url' => '/zb/cat/index'], ['label' => '装B分类']];

        $list = ZbCat::where('disabled', 'false')->order('p_order ' . SORT_ASC)->paginate($this->pageSize);
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
        $this->data['title'] = '分类管理';
        $this->data['breadcrumbs'] = [['label' => '分类管理', 'url' => '/zb/cat/index'], ['label' => '新增']];

        if ($req->post()) {
            $attributes = $req->param();
            $cat = $attributes['Cat'];
            $cat['create_time'] = time();
            $cat['creator'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['logo']) $cat['cat_img'] = UploadFile::common($file['logo'], 'zb_cat', false);

            $zbCat = new ZbCat();
            $submit = $zbCat->save($cat) ? 200 : 500;
            if ($submit == 200) $this->redirect('/zb/cat/index');
            else $this->redirect('create', ['ref_sub' => $submit]);
        }
        $this->data['action'] = 'create';
        return $this->fetch('create', $this->data);
    }

    /**
     * 编辑
     */
    public function update(Request $req)
    {
        $this->data['title'] = '分类管理';
        $this->data['breadcrumbs'] = [['label'=>'分类管理','url'=>'/zb/cat/index'],['label'=>'编辑']];

        $cat_id = $req->param('cat_id');
        if ($req->post()) {
            $attributes = $req->param();
            $cat = $attributes['Cat'];
            $cat['update_time'] = time();
            $cat['updater'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['logo']) $cat['cat_img'] = UploadFile::common($file['logo'], 'zb_cat', false);

            $zbCat = new ZbCat();
            $submit = $zbCat->save($cat, ['cat_id' => $cat_id]) ? 200 : 500;
            if ($submit == 200) $this->redirect('/zb/cat/index');
            else $this->redirect('update', ['cat_id' => $cat_id, 'ref_sub' => $submit]);
        }
        $this->data['cat_row'] = ZbCat::find(['cat_id' => $cat_id]);
        $this->data['action'] = 'update/cat_id/' . $cat_id;
        return $this->fetch('create', $this->data);
    }

    /**
     * 删除
     */
    public function delete(Request $req)
    {
        $cat_id = $req->param('cat_id');
        if (!$cat_id) return json(['code' => 500, 'msg' => '没有获取请求的ID']);

        if (ZbContent::where('cat_id', $cat_id)->count())
            return json(['code' => 500, 'msg' => '当然分类存在素材不可删除']);

        $attributes['disabled'] = 'true';
        $attributes['update_time'] = time();
        $attributes['updater'] = Session::get("user_id");

        $zbCat = new ZbCat();
        $submit = $zbCat->save($attributes, ['cat_id' => $cat_id]) ? 200 : 500;
        if ($submit == 500) return json(['code' => 500, 'msg' => '删除失败']);
        return json(['code' => 200]);
    }
}