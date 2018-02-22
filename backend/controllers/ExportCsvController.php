<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 17.04.2017
 * Time: 9:39
 */

namespace backend\controllers;


class ExportCsvController extends BehaviorsController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}