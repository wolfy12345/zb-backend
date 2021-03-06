<?php
/**
 * 搜索管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\zb\components;


class Search
{
    /**
     * 分类搜索
     *
     * @param $params
     * @param $model
     * @return array
     */
    public static function cat($params, $model)
    {
        return $model;
    }

    /**
     * 内容搜索
     *
     * @param $params
     * @param $model
     * @return array
     */
    public static function content($params, $model)
    {
        if (isset($params['Single']['name']) && $params['Single']['name'] == 'title')
            $model = $model->where("t1.title LIKE '%{$params['Single']['search_val']}%'");
        if (isset($params['Single']['name']) && $params['Single']['name'] == 'cat')
            $model = $model->where("t1.cat_id = '{$params['Single']['search_val']}'");

        return $model;
    }

    /**
     * 广告搜索
     *
     * @param $params
     * @param $model
     * @return array
     */
    public static function ad($params, $model)
    {
        if (isset($params['Single']['name']) && $params['Single']['name'] == 'title')
            $model = $model->where("t.title LIKE '%{$params['Single']['search_val']}%'");
        return $model;
    }
}