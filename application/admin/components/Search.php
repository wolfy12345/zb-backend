<?php
/**
 * 搜索管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\admin\components;

class Search
{
    /**
     * 操作员搜索
     *
     * @param $params
     * @param $data
     * @return array
     */
    public static function admin($params, $data)
    {
        if (isset($params['type']) && $params['type'] == 1) return $data->where($params['Single']['name'], 'like', "%" . $params['Single']['search_val'] . "%");
        if (isset($params['type']) && $params['type'] == 2) {
            foreach ($params['Multi'] as $k => $v) {
                if ($k == 'login_account') $data = $data->where($k, 'like', "%" . $v . "%");
                elseif ($k == 'truename') $data = $data->where($k, 'like', "%" . $v . "%");
            }

            return $data;
        }
        return [];
    }
}