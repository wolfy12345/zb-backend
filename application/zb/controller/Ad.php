<?php
/**
 * 广告管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\zb\controller;


use app\common\components\AppAdminAcl;
use app\common\components\UploadFile;
use app\zb\components\Search;
use app\zb\model\ZbAd;
use app\zb\model\ZbTabbar;
use think\Controller;
use think\Request;
use think\facade\Session;

class Ad extends Controller
{
    private $data = [];
    public $pageSize = 10;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $aclList = AppAdminAcl::filterMenu(Session::get("acl"), Session::get("super"));
        $this->data['aclList'] = $aclList;

        $this->data['ad_type'] = [
            '1' => '所有页面',
            '2' => '首页-轮播',
            '3' => '输入页-底部轮播'
        ];
    }

    /**
     * 列表
     */
    public function index(Request $req)
    {
        $this->data['title'] = '广告管理';
        $this->data['breadcrumbs'] = [['label' => '装B广告', 'url' => '?r=zb/ad/index'], ['label' => '装B广告']];

        $this->data['search_attributes'] = $search = $req->param();
        $this->data['type'] = $type = $req->param('type', 0);

        $zbContent = new ZbAd();
        $data = $zbContent->alias('t')->where('t.disabled', 'false');
        if ($search) {
            $data = Search::ad($search, $data);
        }

        if ($type) $data = $data->where('t.position_id', $type);
        $list = $data->order('t.status ' . SORT_DESC . ', t.p_order ' . SORT_ASC . ", t.ad_id " . SORT_DESC)->paginate($this->pageSize);
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
        $this->data['title'] = '广告管理';
        $this->data['breadcrumbs'] = [['label'=>'广告管理','url'=>'?r=zb/ad/index'],['label'=>'新增']];

        if ($req->post()) {
            $attributes = $req->param();
            $content = $attributes['Ad'];
            $content['create_time'] = time();
            $content['creator'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['logo']) $content['logo'] = UploadFile::common($file['logo'], 'zb_ad', false);

            $zbAd = new ZbAd();
            $submit = $zbAd->save($content) ? 200 : 500;
            if ($submit == 200) $this->redirect('/zb/ad/index');
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
        $this->data['title'] = '广告管理';
        $this->data['breadcrumbs'] = [['label'=>'广告管理','url'=>'/zb/ad/index'],['label'=>'编辑']];

        $ad_id = $req->param('ad_id');
        if ($req->post()) {
            $attributes = $req->param();
            $content = $attributes['Ad'];
            $content['update_time'] = time();
            $content['updater'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['logo']) $content['logo'] = UploadFile::common($file['logo'], 'zb_ad', false);

            $zbAd = new ZbAd();
            $submit = $zbAd->save($content, ['ad_id' => $ad_id]) ? 200 : 500;
            $this->redirect('update', ['ad_id' => $ad_id, 'ref_sub' => $submit]);
        }
        $this->data['ad_row'] = ZbAd::get($ad_id);
        $this->data['action'] = 'update/ad_id/' . $ad_id;
        return $this->fetch('update', $this->data);
    }

    /**
     * 删除
     */
    public function delete(Request $req)
    {
        $ad_id = $req->param('id');
        if (!$ad_id) return json(['code' => 500, 'msg' => '没有获取请求的ID']);

        $zbAd = new ZbAd();
        if(strpos($ad_id, ",") !== false) {    //批量删除
            $ad_id = explode(',', $ad_id);
            $list = [];
            foreach ($ad_id as $cid) {
                $list[] = ['ad_id' => $cid, 'disabled' => 'true', 'update_time' => time(), 'updater' => Session::get("user_id")];
            }
            $zbAd->saveAll($list);
            $submit = 200;
        } else {
            $attributes['disabled'] = 'true';
            $attributes['update_time'] = time();
            $attributes['updater'] = Session::get("user_id");

            $submit = $zbAd->save($attributes, ['ad_id' => $ad_id]) ? 200 : 500;
        }

        if ($submit == 500) return json(['code' => 500, 'msg' => '删除失败']);
        return json(['code' => 200]);
    }

    //底部导航条
    public function tabsetting(Request $req)
    {
        $this->data['title'] = '底部导航条管理';
        $this->data['breadcrumbs'] = [['label'=>'底部导航条管理','url'=>'?r=zb/ad/index'],['label'=>'新增']];

        if ($req->post()) {
            $attributes = $req->param();
            $content = $attributes['Ad'];
            $content['create_time'] = time();
            $content['creator'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['iconPath']) $content['iconPath'] = UploadFile::common($file['iconPath'], 'tab_bar', false);
            if ($file['selectedIconPath']) $content['selectedIconPath'] = UploadFile::common($file['selectedIconPath'], 'tab_bar', false);

            $zbAd = new ZbTabbar();
            if(empty($attributes['Ad']['id'])) {
                $submit = $zbAd->save($content) ? 200 : 500;
            } else {
                $submit = $zbAd->save($content, ['id' => $attributes['Ad']['id']]) ? 200 : 500;
            }

            $this->redirect('tabsetting', ['ref_sub' => $submit]);
        }

        $this->data['ad_row'] = ZbTabbar::find();
        $this->data['action'] = 'tabsetting';
        return $this->fetch('tabsetting', $this->data);
    }
}