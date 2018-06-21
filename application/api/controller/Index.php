<?php
namespace app\api\controller;

use app\api\model\ZbAd;
use app\api\model\ZbCat;
use app\api\model\ZbContent;
use think\Controller;
use think\facade\Config;

class Index extends Controller
{
    private $pageSize = 3;

    public function getIndexInfo()
    {
        $img_url = Config::get("img_host");

        $zbContent = new ZbContent();
        $zbAd = new ZbAd();
//        $adList = $zbAd->field("logo, type, content_id, app_id, path, extra_data")->where('disabled', 'false')->order('p_order ' . SORT_ASC)->limit(3)->select();

        $adList = $zbAd->alias('a')->field("logo, type, a.content_id, app_id, path, extra_data, c.page_type")->where('a.disabled', 'false')->where('a.status', '1')->where('a.position_id', 2)->leftJoin($zbContent->getTable() . " c", "a.content_id = c.content_id")->order('a.p_order ' . SORT_ASC)->limit(5)->select();
        $adList->each(function($item) use ($img_url) {
            $item->logo = $img_url . $item->logo;
        });

        $zbContent = new ZbContent();
        $contentList = $zbContent->field("content_id, title, img_icon, content, page_type, take_num")->where('disabled', 'false')->order('p_order ' . SORT_ASC)->paginate(10);
        $contentList->each(function($item) use ($img_url) {
            $item->img_icon = $img_url . $item->img_icon;
        });

        $popup = ['isPopup' => false, 'hotList' => []];
        if(Config::get("index_popup")) {

            $hotList = $zbContent->field("content_id, title, img_icon, content, page_type, take_num")->where('disabled', 'false')->where('is_hot', 1)->order('p_order ' . SORT_ASC)->limit(3)->select();
            $hotList->each(function($item) use ($img_url) {
                $item->img_icon = $img_url . $item->img_icon;
            });
            $popup['isPopup'] = true;
            $popup['hotList'] = $hotList;
        }

        $zbCat = new ZbCat();
        $catList = $zbCat->field("cat_id, cat_img, cat_name")->where('disabled', 'false')->order('p_order ' . SORT_ASC)->limit(8)->select();

        return json(['data'=> ['popup' => $popup, 'adList' => $adList, 'catList' => $catList, 'contentList' => $contentList->getCollection(), 'page'=> $contentList->currentPage(), 'total' => $contentList->total()], 'code'=>200]);
    }
}
