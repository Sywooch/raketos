<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 13.04.2017
 * Time: 8:57
 */

namespace backend\controllers;


use yii\web\Controller;

class UploadController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sql = "LOAD DATA INFILE '/var/www/setyes/data/www/itwillok.com/console/migrations/csv/car_type.csv'
         INTO TABLE car_type
         FIELDS TERMINATED BY '^'
         LINES TERMINATED BY '\n'
         (id_car_type,name)";

        if (\Yii::$app->db->createCommand($sql)->execute())$rez=true; else $rez=false;

        dd($rez);

        return $this->render('index');
    }
}