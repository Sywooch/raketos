<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 31.03.2017
 * Time: 18:21
 */

namespace frontend\controllers;


use yii\web\Controller;

class PaymentController extends Controller
{
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index',
            [
                /*'model' => $model*/
            ]
        );
    }
}