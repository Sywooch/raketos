<?php

namespace backend\modules\setting\controllers;

use Yii;
use common\models\forms\RatingCalculateForm;

class CalculateController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = RatingCalculateForm::findOne(1);
        $model->setParams();

        return $this->render('index', ['model' => $model]);
    }

    public function actionUpdate()
    {
        $model = RatingCalculateForm::findOne(1);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Формула успешно изменена.'),
                ]
            );
            //dd($model);
            return $this->redirect(['index']);
        } else {
            //dd($model->errors);
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
