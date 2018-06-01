<?php
/**
 * 权限角色管理
 *
 * @author chenfenghua <843958575@qq.com>
 * version 2.0
 */

namespace app\admin\model;

use think\Db;
use think\Model;

class AppRole extends Model
{
    /**
     * 根据用户Id获取权限
     *
     * @param $user_id
     * @return array
     */
    public function getRoleById($user_id)
    {
        return Db::table('wx_admin_role')
            ->alias('t')
            ->leftjoin('wx_admin_group s','t.role_id = s.role_id')
            ->where('t.user_id', $user_id)
            ->find();
    }
}