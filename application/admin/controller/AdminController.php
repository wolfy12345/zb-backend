<?php
/**
 * 后台管理员管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\app\backend\modules\admin\controllers;

use app\models\admin\AdminGroup;
use app\models\admin\AdminRole;
use Yii;
use app\app\backend\components\BaseController;
use app\backend\modules\admin\components\Search;
use app\models\admin\AdminUser;
use yii\data\Pagination;
use yii\helpers\Json;

class AdminController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->data['js'] = array(
            'backend/admin/admin.js'
        );

    }

    /**
     * 列表页
     */
    public function actionIndex()
    {
        $pageIndex = Yii::$app->request->get('page', 1);
        $this->data['search_attributes'] = Yii::$app->request->post();
        $data = AdminUser::find()->where(['status'=>'0']);
        if ($this->data['search_attributes']) {
            $data = Search::admin($this->data['search_attributes'], $data);
        }

        $this->data['count'] = $data->count();
        $this->data['dataProvider'] = $data->orderBy(['user_id'=>'DESC'])->offset(($pageIndex - 1) * $this->pageSize)->
        limit($this->pageSize)->all();
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
            $user_attributes = Yii::$app->request->post('User');
            $user_attributes['password'] = md5(md5($user_attributes['password']));
            $user_attributes['last_modify'] = time();

            $role_attributes = Yii::$app->request->post('Role');

            $adminUser = new AdminUser();
            $adminRole = new AdminRole();
            $adminUser->attributes = $user_attributes;
            $submit = $adminUser->save()?200:500;
            $role_attributes['user_id'] = Yii::$app->db->getLastInsertID();

            if ($submit == 200) {
                $adminRole->attributes = $role_attributes;
                $adminRole->save();
            }
            $this->refresh('&ref_sub='.$submit);
        }
        $this->data['action'] = 'create';
        $this->data['role_list'] = AdminGroup::findAll(['status'=>'active']);
        return $this->render('create', $this->data);
    }

    /**
     * 编辑
     */
    public function actionUpdate()
    {
        $user_id = Yii::$app->request->get('user_id');
        if (Yii::$app->request->post())
        {
            $user_attributes = Yii::$app->request->post('User');

            $user_attributes['last_modify'] = time();

            $role_attributes = Yii::$app->request->post('Role');

            $adminUser = AdminUser::findOne($user_id);
            if ($user_attributes['password']) $user_attributes['password'] = md5(md5($user_attributes['password']));
            else $user_attributes['password'] = $adminUser->password;
            $adminRole = AdminRole::findOne($user_id);
            $adminUser->attributes = $user_attributes;

            $submit = $adminUser->update()?200:500;
            if ($submit == 200) {
                if ($adminRole) {
                    $adminRole->attributes = $role_attributes;
                    $adminRole->update();
                } else {
                    $adminRole = new AdminRole();
                    $role_attributes['user_id'] = $user_id;
                    $adminRole->attributes = $role_attributes;
                    $adminRole->save();
                }
            }
            $this->refresh('&ref_sub='.$submit);
        }
        $this->data['action'] = 'update&user_id='.$user_id;
        $this->data['user_row'] = AdminUser::findOne(['user_id'=>$user_id]);
        $this->data['role_row'] = AdminRole::findOne(['user_id'=>$user_id]);
        $this->data['role_list'] = AdminGroup::findAll(['status'=>'active']);

        return $this->render('update', $this->data);
    }

    /**
     * 取消
     */
    public function actionCancel()
    {
        $user_id = Yii::$app->request->get('user_id');
        if (!$user_id) return Json::encode(['code'=>500, 'msg'=>'没有获取请求的ID']);
        $submit = AdminUser::updateAll(['status'=>'1'], 'user_id = :user_id', [':user_id'=>$user_id])?200:500;
        if ($submit == 500) return Json::encode(['code'=>500, 'msg'=>'冻结失败']);
        return Json::encode(['code'=>200]);
    }
}