<?php

namespace backend\modules\questions\controllers;

use common\models\Constants;
use Yii;
use common\models\forms\QuestionForm;
use common\models\search\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for QuestionForm model.
 */
class ManageController extends Controller
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
     * Lists all QuestionForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QuestionForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestionForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QuestionForm model.
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
                    'message'   => ' '.\Yii::t('app', 'Ответ успешно добавлена.'),
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
     * Deletes an existing QuestionForm model.
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
                'message'   => ' '.\Yii::t('app', 'Вопрос успешно удален.'),
            ]
        );

        return $this->redirect(['index']);
    }

    /**
     * Множественная активация пользователей
     * Перевод в статус STATUS_ACTIVE
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionMultiactive()
    {
        $models = \Yii::$app->request->post('keys');
        if ($models) {
            foreach ($models as $id) {
                if ($id != \Yii::$app->user->id) {
                    /** @var QuestionForm $model */
                    $model = $this->findModel($id);
                    $model->status = Constants::STATUS_ACTIVE;
                    $model->save();
                }
            }
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'info',
                    'icon'      => 'glyphicon glyphicon-info-sign',
                    'message'   => ' '.\Yii::t('app', 'Выбранные вопросы успешно активированы.'),
                ]
            );
        }
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $model = new QuestionForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Множественная блокировка пользователей
     * Перевод в статус STATUS_BLOCKED
     * @return bool
     * @throws NotFoundHttpException
     */
    public function actionMultiblock()
    {
        $keys = \Yii::$app->request->post('keys');
        if ($keys) {
            foreach ($keys as $id) {
                if ($id != \Yii::$app->user->id) {
                    /** @var $model QuestionForm */
                    $model = $this->findModel($id);
                    $model->status = Constants::STATUS_BLOCKED;
                    if(!$model->save()) {
                        dd($model->errors);
                    }
                }
            }
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'info',
                    'icon'      => 'glyphicon glyphicon-info-sign',
                    'message'   => ' '.\Yii::t('app', 'Выбранные вопросы успешно блокированы.'),
                ]
            );
        }

        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $model = new QuestionForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Finds the QuestionForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
