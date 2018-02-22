<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 31.03.2017
 * Time: 19:33
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class YandexButtonController extends Controller
{
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        dd(Yii::$app->request->post());
    }
}