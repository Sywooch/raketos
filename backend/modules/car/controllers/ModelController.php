<?php

namespace backend\modules\car\controllers;

use common\models\forms\SelectCarForm;
use Yii;
use common\models\forms\CarModelForm;
use common\models\search\CarModelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModelController implements the CRUD actions for CarModelForm model.
 */
class ModelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CarModelForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new CarModelForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single CarModelForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = SelectCarForm::findOne($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single CarModelForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionSelectGeneration($id)
    {
        $model = SelectCarForm::findOne($id);

        $model->load(Yii::$app->request->post());

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single CarModelForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionSelectSerie($id)
    {
        $model = SelectCarForm::findOne($id);

        $model->load(Yii::$app->request->post());

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single CarModelForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionSelectModification($id)
    {
        $model = SelectCarForm::findOne($id);

        $model->load(Yii::$app->request->post());

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new CarModelForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CarModelForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Модель успешно добавлена.'),
                ]
            );

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CarModelForm model.
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
                    'message'   => ' '.\Yii::t('app', 'Модель успешно изменена.'),
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
     * Deletes an existing CarModelForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        \Yii::$app->session->set(
            'message',
            [
                'type'      => 'success',
                'icon'      => 'glyphicon glyphicon-bell',
                'message'   => ' '.\Yii::t('app', 'Модель успешно удалена.'),
            ]
        );

        return $this->redirect(['index']);
    }

    /**
     * Finds the CarModelForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CarModelForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarModelForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
