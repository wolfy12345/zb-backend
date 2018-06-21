<?php
namespace app\api\controller;

use app\api\model\ZbAd;
use app\api\model\ZbContent;
use app\zb\model\ZbTabbar;
use think\Controller;
use think\facade\Config;
use think\Request;

class Ad extends Controller
{
    private $pageSize = 3;

    public function getAdList(Request $req)
    {
        $posId = $req->get("posId", 1);

        $img_url = Config::get("img_host");
        $zbContent = new ZbContent();
        $zbAd = new ZbAd();
//        $list = $zbCat->field("ad_id, title, logo, link")->where('disabled', 'false')->where('position_id', $posId)->order('p_order ' . SORT_ASC)->limit($this->pageSize)->select();

        $adList = $zbAd->alias('a')->field("logo, type, a.content_id, app_id, path, extra_data, c.page_type")->where('a.disabled', 'false')->where('a.status', '1')->where('a.position_id', $posId)->leftJoin($zbContent->getTable() . " c", "a.content_id = c.content_id")->order('a.p_order ' . SORT_ASC)->limit($this->pageSize)->select();
        $adList->each(function($item) use ($img_url) {
            $item->logo = $img_url . $item->logo;
        });

        return json(['data'=> ['list' => $adList], 'code'=>200]);
    }

    public function getTabbar() {
        $zbTabbar = new ZbTabbar();
        $tabInfo = $zbTabbar->find();
        $tabInfo['current'] = 0;

        return json(['tabInfo' => $tabInfo, 'code' => 200]);
    }
}
