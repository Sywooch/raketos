<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 16.04.2017
 * Time: 12:14
 */

namespace backend\modules\setting\controllers;

use yii\web\Controller;

class InfoController extends Controller
{
    public function actionLogger()
    {
        return $this->render('logger');
    }

    public function actionPhpinfo()
    {
        $this->layout = '/clear';
        return $this->render('phpinfo');
    }
}