<?php

namespace app\admin\model;
use think\Model;


/**
 * This is the model class for table "{{%admin_group}}".
 *
 * @property string $role_id
 * @property string $group_name
 * @property string $acl
 * @property string $status
 * @property string $last_modify
 */
class AdminGroup extends Model
{
    protected $pk = 'role_id';
}
