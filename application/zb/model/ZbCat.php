<?php

namespace app\zb\model;
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
class ZbCat extends Model
{
    protected $pk = 'cat_id';
}
