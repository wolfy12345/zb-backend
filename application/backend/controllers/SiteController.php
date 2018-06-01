<?php
/**
 * Created by PhpStorm.
 * User: chenfh
 * Date: 2017/10/19
 * Time: 18:23
 */

namespace app\backend\controllers;


use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        echo 11;
    }

    public function actionError()
    {
        echo 22;
    }
}