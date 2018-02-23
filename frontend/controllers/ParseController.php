<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use common\models\parse\AdsParse;

class ParseController extends ActiveController
{
    public $modelClass = 'frontend\models\Ads';

    protected function verbs()
    {
        return [
            'create-ads' => ['POST'],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    //Create new advertisement
    public function actionCreateAds()
    {
        $model = new AdsParse();

        if(Yii::$app->request->post()):

            if($model->create(Yii::$app->request->post())):
                return $this->response(201, ['message' => 'Record successfully created!']);
            else:
                return $this->response(500, ['message' => 'Can\'t save record!']);
            endif;

        else:
            return $this->response(400, ['message' => 'Bad request!']);
        endif;

    }

    //Response array
    protected function response($status, $data = [])
    {
        if($data):
            foreach($data as $key => $item):
                $record [$key] = $item;
            endforeach;

            return [
                'status' => $status,
                'data' => $record
            ];
        else:
            return [
                'status' => $status
            ];

        endif;
    }
    
    
}
