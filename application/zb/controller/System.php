<?php
/**
 * 广告管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */
namespace app\zb\controller;

use app\common\components\UploadFile;
use app\common\controller\BaseController;
use app\zb\components\Search;
use app\zb\model\ZbAd;
use app\zb\model\ZbSystem;
use app\zb\model\ZbTabbar;
use think\facade\Config;
use think\Request;
use think\facade\Session;

class System extends BaseController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }


    public function index(Request $req)
    {
        $this->data['title'] = '系统设置';
        $this->data['breadcrumbs'] = [['label'=>'系统设置']];

        $zbSystem = new ZbSystem();
        if ($req->post()) {
            $attributes = $req->param();
            $system = $attributes['System'];

            $data['key'] = 'index_popup';
            $data['value'] = $system['index_popup'];
            $submit = $zbSystem->save($data, ['id' => 1]) ? 200 : 500;

            $this->redirect('index', ['ref_sub' => $submit]);
        }
        $this->data['action'] = 'index';

        $row = $zbSystem->get(['id' => 1]);
        $this->data['index_popup'] = $row["value"];
        return $this->fetch('index', $this->data);
    }
}