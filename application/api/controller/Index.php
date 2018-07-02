<?php
namespace app\api\controller;

use app\api\model\ZbAd;
use app\api\model\ZbCat;
use app\api\model\ZbContent;
use app\zb\model\ZbSystem;
use think\Controller;
use think\facade\Cache;
use think\facade\Config;

class Index extends Controller
{

    public function ifGetAvatar() {
        return json(['open' => Config::get("get_avatar")]);
    }

    public function getIndexInfo()
    {
        $img_url = Config::get("img_host");

        $result = Cache::get("index_result");
        if (empty($result)) {
            $zbContent = new ZbContent();
            $zbAd = new ZbAd();

            $adList = $zbAd->alias('a')->field("logo, type, a.content_id, app_id, path, extra_data, c.page_type")->where('a.disabled', 'false')->where('a.status', '1')->where('a.position_id', 2)->leftJoin($zbContent->getTable() . " c", "a.content_id = c.content_id")->order('a.p_order ' . SORT_ASC)->limit(5)->select();
            $adList->each(function ($item) use ($img_url) {
                $item->logo = $img_url . $item->logo;
            });

            $zbContent = new ZbContent();
            $contentList = $zbContent->field("content_id, title, img_icon, content, page_type, take_num")->where('disabled', 'false')->where('show_status', 1)->order('p_order ' . SORT_ASC)->paginate(10);
            $contentList->each(function ($item) use ($img_url) {
                $item->img_icon = $img_url . $item->img_icon;
                $item->take_num = number_format($item->take_num / 10000, 2);
            });

            $zbSystem = new ZbSystem();
            $row = $zbSystem->get(['id' => 1]);
            $popup = ['isPopup' => false, 'hotList' => []];
            if ($row["value"]) {
                $hotList = $zbContent->field("content_id, title, img_icon, content, page_type, take_num")->where('disabled', 'false')->where('is_hot', 1)->order('p_order ' . SORT_ASC)->limit(3)->select();
                $hotList->each(function ($item) use ($img_url) {
                    $item->img_icon = $img_url . $item->img_icon;
                });
                $popup['isPopup'] = true;
                $popup['hotList'] = $hotList;
            }

            $zbCat = new ZbCat();
            $catList = $zbCat->field("cat_id, cat_img, cat_name")->where('disabled', 'false')->where('show_status', 1)->order('p_order ' . SORT_ASC)->limit(8)->select();

            $result = ['popup' => $popup, 'adList' => $adList, 'catList' => $catList, 'contentList' => $contentList->getCollection(), 'page' => $contentList->currentPage(), 'total' => $contentList->total()];
            Cache::set("index_result", $result);
        }

        return json(['data' => $result, 'code' => 200]);
    }
}
