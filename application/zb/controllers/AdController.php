<?php
/**
 * 广告管理
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2016
 * @version    2.0
 */

namespace app\app\backend\modules\zb\controllers;

use app\models\common\UploadFile;
use Yii;
use app\app\backend\components\BaseController;
use app\app\backend\modules\zb\components\Search;
use app\models\zb\ZbAd;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\Json;

class AdController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        $this->data['css']  = [
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            'global/plugins/fancybox/source/jquery.fancybox.css',
            'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        ];
        $this->data['js']   = [
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/plugins/fancybox/source/jquery.fancybox.pack.js',
            'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
            'backend/zb/ad.js'
        ];

        #广告类型
        $this->data['ad_type'] = [
            '1' => '所有页面',
            '2' => '首页-轮播',
        ];
    }

    /**
     * 列表
     */
    public function actionIndex()
    {
        $pageIndex = Yii::$app->request->get('page', 1);
        $type = Yii::$app->request->get('type',0);
        $this->data['search_attributes'] = Yii::$app->request->get();

        $query = new Query();
        $model = $query->from(ZbAd::tableName().' t')->where(['t.disabled'=>'false']);

        if ($this->data['search_attributes']) {
            $model = Search::ad($this->data['search_attributes'], $model);
        }
        if ($type) $model = $model->andWhere(['t.position_id'=>$type]);
        $this->data['count'] = $model->count();
        $this->data['dataProvider'] = $model->select(['t.*'])
            ->orderBy(['t.status'=>SORT_DESC, 't.p_order'=>SORT_ASC, 't.ad_id'=>SORT_DESC])
            ->offset(($pageIndex - 1) * $this->pageSize)->limit($this->pageSize)->all();

        $this->data['pages'] = new Pagination(
            [
                'totalCount' => $this->data['count'],
                'defaultPageSize'=>$pageIndex,
                'pageSizeLimit'=>[$this->pageSize,$this->pageSize],
            ]
        );
        $this->data['type'] = $type;

        return $this->render('index', $this->data);
    }

    /**
     * 创建
     */
    public function actionCreate()
    {
        $attributes = Yii::$app->request->post('Ad');
        if ($attributes)
        {
            $attributes['create_time'] = time();
            $attributes['creator'] = Yii::$app->session['user_id'];

            $file_attributes = Yii::$app->request->post('File');
            if ($file_attributes['logo']) $attributes['logo'] = UploadFile::common($file_attributes['logo'], 'zb_ad', false);

            $ad = new ZbAd();
            $ad->attributes = $attributes;
            $submit = $ad->save()?200:500;
            if ($submit == 200) $this->redirect('?r=zb/ad/index');
            else $this->refresh('&ref_sub='.$submit);
        }
        $this->data['action'] = 'create';
        return $this->render('create', $this->data);
    }

    /**
     * 编辑
     */
    public function actionUpdate()
    {
        $ad_id = Yii::$app->request->get('ad_id');

        $attributes = Yii::$app->request->post('Ad');
        if ($attributes) {
            $attributes['update_time'] = time();
            $attributes['updater'] = Yii::$app->session['user_id'];

            $file_attributes = Yii::$app->request->post('File');
            if ($file_attributes['logo']) $attributes['logo'] = UploadFile::common($file_attributes['logo'], 'zb_ad', false);

            $ad = new ZbAd();
            $ad->attributes = $attributes;
            $submit = $ad->updateAll($attributes, 'ad_id = :ad_id', [':ad_id'=>$ad_id])?200:500;
            $this->refresh('&ref_sub='.$submit);;
        }
        $this->data['ad_row'] = ZbAd::findOne(['ad_id'=>$ad_id]);
        $this->data['action'] = 'update&ad_id='.$ad_id;
        return $this->render('update', $this->data);
    }

    /**
     * 删除
     */
    public function actionDelete()
    {
        $ad_id = Yii::$app->request->get('ad_id');
        if (!$ad_id) return Json::encode(['code'=>500, 'msg'=>'没有获取请求的ID']);
        $attributes['disabled'] = 'true';
        $attributes['update_time'] = time();
        $attributes['updater'] = Yii::$app->session['user_id'];
        $submit = ZbAd::updateAll($attributes, 'ad_id = :ad_id', [':ad_id'=>$ad_id])?200:500;
        if ($submit == 500) return Json::encode(['code'=>500, 'msg'=>'删除失败']);
        return Json::encode(['code'=>200]);
    }
}