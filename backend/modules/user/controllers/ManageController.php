<?php

namespace backend\modules\user\controllers;

use common\models\Constants;
use Yii;
use common\models\forms\UserForm;
use common\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for UserForm model.
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
     * Lists all UserForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $getCreator = false);

        $model = new UserForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single UserForm model.
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
     * Lists all UserForm models.
     * @return mixed
     */
    public function actionSendEmail($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->message && $model->email) {
            $view = 'sendMessage';
            /*\Yii::$app->mailer->compose($view, ['model' => $model])
                ->setFrom([\Yii::$app->params['adminEmail']])
                ->setTo($model->email)
                ->setSubject(\Yii::t('app', 'Новое сообщение'))
                ->send();*/

            $view = 'sendMessage';
            \Yii::$app->mailer->compose($view, ['model' => $model])
                    ->setFrom(['sergeenkov73@mail.ru'])
                ->setTo('phpnt@yandex.ru')
                ->setSubject('Проверка')
                ->send();

            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Письмо успешно отправлено.'),
                ]
            );
        }

            $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $getCreator = false);
        $model = new UserForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Creates a new UserForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Пользователь успешно добавлен.'),
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
     * Updates an existing UserForm model.
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
                    'message'   => ' '.\Yii::t('app', 'Пользователь успешно изменен.'),
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
     * Deletes an existing UserForm model.
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
                'message'   => ' '.\Yii::t('app', 'Пользователь успешно удален.'),
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
                    /** @var UserForm $model */
                    $model = $this->findModel($id);
                    $model->status = Constants::STATUS_ACTIVE;
                    $model->save(false);
                }
            }
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'info',
                    'icon'      => 'glyphicon glyphicon-info-sign',
                    'message'   => ' '.\Yii::t('app', 'Выбранные пользователи успешно активированы.'),
                ]
            );
        }
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $getCreator = false);
        $model = new UserForm();

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
                    /** @var $model UserForm */
                    $model = $this->findModel($id);
                    $model->status = Constants::STATUS_BLOCKED;
                    if(!$model->save(false)) {
                        dd($model->errors);
                    }
                }
            }
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'info',
                    'icon'      => 'glyphicon glyphicon-info-sign',
                    'message'   => ' '.\Yii::t('app', 'Выбранные пользователи успешно блокированы.'),
                ]
            );
        }

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $getCreator = false);
        $model = new UserForm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Finds the UserForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
