<?php
/**
 * 素材管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\zb\controller;

use app\common\components\AppAdminAcl;
use app\common\components\UploadFile;
use app\zb\components\Search;
use app\zb\model\ZbCat;
use app\zb\model\ZbContent;
use think\Controller;
use think\Request;
use think\facade\Session;

class Content extends Controller
{
    private $data = [];
    public $pageSize = 10;

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
//            'backend/zb/content.js'
//        ];
//    }

    /**
     * 列表
     */
    public function index(Request $req)
    {
        $this->data['title'] = '素材管理';
        $this->data['breadcrumbs'] = [['label' => '装B素材', 'url' => '/zb/content/index'], ['label' => '装B素材']];

        $this->data['search_attributes'] = $search = $req->param();

        $zbContent = new ZbContent();
        $data = $zbContent->alias('t1')->where('t1.disabled', 'false');
        if ($search) {
            $data = Search::content($search, $data);
        }

        $zbCat = new ZbCat();
        $data = $data->leftJoin($zbCat->getTable() . ' t2', 't1.cat_id = t2.cat_id');
        $list = $data->order('t1.p_order ' . SORT_ASC)->paginate($this->pageSize, false, ['query' => $search]);
        $page = $list->render();
        $this->data['list'] = $list;
        $this->data['page'] = $page;

        $this->data['catList'] = ZbCat::all(['disabled' => 'false']);

        return $this->fetch('index', $this->data);
    }

    /**
     * 创建
     */
    public function create(Request $req)
    {
        $this->data['title'] = '素材管理';
        $this->data['breadcrumbs'] = [['label' => '素材管理', 'url' => '/zb/content/index'], ['label' => '新增']];


        if ($req->post()) {
            $attributes = $req->param();
            $content = $attributes['Content'];
            $content['create_time'] = time();
            $content['creator'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['img_icon']) $content['img_icon'] = UploadFile::common($file['img_icon'], 'zb_content', false);
            if ($file['img_example']) $content['img_example'] = UploadFile::common($file['img_example'], 'zb_content', false);
            if ($file['img_bg']) $content['img_bg'] = UploadFile::common($file['img_bg'], 'zb_content', false);

            if(isset($attributes['text']) && !empty($attributes['text'])) {
                $text = $attributes['text'];
                $optType = $attributes['optType'];
                $values = $attributes['values'];
                $inputList = [];
                foreach ($text as $k => $v) {
                    $inputItem = [];
                    $inputItem['text'] = $v;
                    $inputItem['optType'] = $optType[$k];
                    $inputItem['values'] = explode(',', $values[$k]);
                    $inputList[] = $inputItem;
                }
                $content['input_list'] = json_encode($inputList, JSON_UNESCAPED_UNICODE);
            }

            $zbContent = new ZbContent();
            $submit = $zbContent->save($content) ? 200 : 500;
            if ($submit == 200) $this->redirect('/zb/content/index');
            else $this->redirect('create', ['ref_sub' => $submit]);
        }
        $this->data['action'] = 'create';
        $this->data['cat_list'] = ZbCat::all(['disabled' => 'false']);
        return $this->fetch('create', $this->data);
    }

    /**
     * 编辑
     */
    public function update(Request $req)
    {
        $this->data['title'] = '素材管理';
        $this->data['breadcrumbs'] = [['label'=>'素材管理','url'=>'/zb/content/index'],['label'=>'编辑']];

        $content_id = $req->param("content_id");
        if ($req->post()) {
            $attributes = $req->param();
            $content = $attributes['Content'];
            $content['update_time'] = time();
            $content['updater'] = Session::get('user_id');

            $file = $attributes['File'];
            if ($file['img_icon']) $content['img_icon'] = UploadFile::common($file['img_icon'], 'zb_content', false);
            if ($file['img_example']) $content['img_example'] = UploadFile::common($file['img_example'], 'zb_content', false);
            if ($file['img_bg']) $content['img_bg'] = UploadFile::common($file['img_bg'], 'zb_content', false);

            if(isset($attributes['text']) && !empty($attributes['text'])) {
                $text = $attributes['text'];
                $optType = $attributes['optType'];
                $values = $attributes['values'];
                $inputList = [];
                foreach($text as $k => $v) {
                    $inputItem = [];
                    $inputItem['text'] = $v;
                    $inputItem['optType'] = $optType[$k];
                    $inputItem['values'] = explode(',', $values[$k]);
                    $inputList[] = $inputItem;
                }
                $content['input_list'] = json_encode($inputList, JSON_UNESCAPED_UNICODE);
            }

            $zbContent = new ZbContent();
            $submit = $zbContent->save($content, ['content_id' => $content_id]) ? 200 : 500;
            $this->redirect('update', ['content_id' => $content_id, 'ref_sub' => $submit]);
        }
        $this->data['content_row'] = ZbContent::get($content_id);
        if(!empty($this->data['content_row']['input_list'])) {
            $this->data['content_row']['input_list'] = json_decode($this->data['content_row']['input_list'], true);
        }
        $this->data['cat_list'] = ZbCat::all(['disabled' => 'false']);
        $this->data['action'] = 'update/content_id/' . $content_id;
        return $this->fetch('update', $this->data);
    }

    /**
     * 删除
     */
    public function delete(Request $req)
    {
        $content_id = $req->param('content_id');
        if (!$content_id) return json(['code' => 500, 'msg' => '没有获取请求的ID']);
        $attributes['disabled'] = 'true';
        $attributes['update_time'] = time();
        $attributes['updater'] = Session::get("user_id");

        $zbContent = new ZbContent();
        $submit = $zbContent->save($attributes, ['content_id' => $content_id]) ? 200 : 500;
        if ($submit == 500) return json(['code' => 500, 'msg' => '删除失败']);
        return json(['code' => 200]);
    }

//    public function actionCache()
//    {
//        Yii::$app->cache->flush();
//    }
}