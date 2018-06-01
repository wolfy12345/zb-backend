<?php
/**
 * 基础数据处理类
 *
 * @author chenfenghua <843958575@qq.com>
 * version v2.0
 */

namespace app\backend\components;

use Yii;
use yii\db\Command;

class BaseModel extends Command
{
    public $connection;
    public function init()
    {
        parent::init();
        $this->connection = Yii::$app->db;
    }
}