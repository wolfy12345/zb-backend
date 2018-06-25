<?php
namespace app\api\controller;

use app\api\model\ZbAd;
use app\api\model\ZbContent;
use app\zb\model\ZbTabbar;
use think\Controller;
use think\facade\Cache;
use think\facade\Config;
use think\Request;

class Ad extends Controller
{
    private $pageSize = 3;

    public function getAdList(Request $req)
    {
        $posId = $req->get("posId", 1);

        $adList = Cache::get("adList_" . $posId);
        if (empty($adList)) {
            $img_url = Config::get("img_host");
            $zbContent = new ZbContent();
            $zbAd = new ZbAd();
            $adList = $zbAd->alias('a')->field("logo, type, a.content_id, app_id, path, extra_data, c.page_type")->where('a.disabled', 'false')->where('a.status', '1')->where('a.position_id', $posId)->leftJoin($zbContent->getTable() . " c", "a.content_id = c.content_id")->order('a.p_order ' . SORT_ASC)->limit($this->pageSize)->select();
            $adList->each(function ($item) use ($img_url) {
                $item->logo = $img_url . $item->logo;
            });
            Cache::set("adList_" . $posId, $adList);
        }

        return json(['data' => ['list' => $adList], 'code' => 200]);
    }

    public function getTabbar()
    {
        $tabInfo = Cache::get("tabInfo");
        if (empty($tabInfo)) {
            $img_url = Config::get("img_host");
            $zbTabbar = new ZbTabbar();
            $tabInfo = $zbTabbar->find();
            if ($tabInfo) {
                $tabInfo['current'] = 0;
                $tabInfo['iconPath'] = $img_url . $tabInfo['iconPath'];
                $tabInfo['selectedIconPath'] = $img_url . $tabInfo['selectedIconPath'];
            }
        }

        return json(['tabInfo' => $tabInfo, 'code' => 200]);
    }
}
