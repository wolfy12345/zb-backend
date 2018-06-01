<?php
/**
 * 搜索管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\backend\modules\admin\components;


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
        if (isset($params['type']) && $params['type'] == 1) return $data->andWhere(['like',$params['Single']['name'],$params['Single']['search_val']]);
        if (isset($params['type']) && $params['type'] == 2) {
            foreach ($params['Multi'] as $k=>$v) {
                if ($k == 'login_account') $data = $data->andWhere(['like',$k,$v]);
                elseif ($k == 'truename') $data = $data->andWhere(['like',$k,$v]);
            }

            return $data;
        }
        return [];
    }
}