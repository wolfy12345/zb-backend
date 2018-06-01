<?php
/**
 * 角色管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\app\backend\modules\admin\controllers;

use Yii;
use app\app\backend\components\BaseController;
use app\models\admin\AdminGroup;
use yii\data\Pagination;
use yii\helpers\Json;

class RoleController extends BaseController
{
    public $pageSize = 10;

    public function init()
    {
        parent::init();
        $this->data['js'] = array(
            'backend/admin/role.js'
        );
    }
    /**
     * 角色列表
     */
    public function actionIndex()
    {
        $pageIndex = Yii::$app->request->get('page', 1);

        $this->data['count'] = AdminGroup::find()->where(['status'=>'active'])->count();
        $this->data['dataProvider'] = AdminGroup::find()->where(['status'=>'active'])->
        orderBy(['role_id'=>SORT_ASC])->offset(($pageIndex - 1) * $this->pageSize)->limit($this->pageSize)->all();

        $this->data['pages'] = new Pagination(
            [
                'totalCount' => $this->data['count'],
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$this->pageSize,$this->pageSize]
            ]
        );

        return $this->render('index', $this->data);
    }

    /**
     * 创建
     */
    public function actionCreate()
    {
        if (Yii::$app->request->post())
        {
            $group_attributes = Yii::$app->request->post('Group');
            $group_attributes['last_modify'] = time();
            $acl_attributes = Yii::$app->request->post('Acl');

            if ($acl_attributes) $group_attributes['acl'] = implode(',', $acl_attributes);
            $adminGroup = new AdminGroup();
            $adminGroup->attributes = $group_attributes;
            $submit = $adminGroup->save()?200:500;
            $this->refresh('&ref_sub='.$submit);
        }
        $this->data['action'] = 'create';
        return $this->render('create', $this->data);
    }

    /**
     * 编辑
     */
    public function actionUpdate()
    {
        $role_id = Yii::$app->request->get('role_id');
        if (Yii::$app->request->post())
        {
            $group_attributes = Yii::$app->request->post('Group');
            $group_attributes['last_modify'] = time();
            $acl_attributes = Yii::$app->request->post('Acl');

            if ($acl_attributes) $group_attributes['acl'] = implode(',', $acl_attributes);
            $adminGroup = AdminGroup::findOne($role_id);
            $adminGroup->attributes = $group_attributes;
            $submit = $adminGroup->update()?200:500;
            $this->refresh('&ref_sub='.$submit);
        }
        $this->data['action'] = 'update&role_id='.$role_id;
        $this->data['role_row'] = AdminGroup::find()->where(['role_id'=>$role_id])->one();
        return $this->render('update', $this->data);
    }

    /**
     * 冻结
     */
    public function actionCancel()
    {
        $this->enableCsrfValidation = false;
        $role_id = Yii::$app->request->get('role_id');
        if (!$role_id) return Json::encode(['code'=>500, 'msg'=>'没有获取请求的ID']);
        $submit = AdminGroup::updateAll(['status'=>'dead'], 'role_id = :role_id', [':role_id'=>$role_id])?200:500;
        if ($submit == 500) return Json::encode(['code'=>500, 'msg'=>'冻结失败']);
        return Json::encode(['code'=>200]);
    }
}