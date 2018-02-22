<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 12:50
 */

namespace backend\modules\page\controllers;

use Yii;
use common\models\forms\DocumentForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class QuestionsController extends Controller
{
    /**
     * Lists all DocumentForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = DocumentForm::findOne(['type' => 'questions-page']);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Updates an existing DocumentForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Страница успешно изменина.'),
                ]
            );

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the DocumentForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
