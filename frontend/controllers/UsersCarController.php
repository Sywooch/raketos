<?php

namespace frontend\controllers;

use common\models\CarCharacteristic;
use common\models\CarCharacteristicValue;
use common\models\Constants;
use common\models\extend\CarGenerationExtend;
use common\models\extend\CarMarkExtend;
use common\models\extend\CarModelExtend;
use common\models\extend\CarModificationExtend;
use common\models\extend\CarSerieExtend;
use common\models\extend\RatingExtend;
use common\models\extend\UserExtend;
use common\models\forms\AdsTariffForm;
use Yii;
use common\models\forms\AdsForm;
use common\models\search\AdsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Profiles;

/***
 * UsersCarController implements the CRUD actions for AdsForm model.
 */
class UsersCarController extends Controller
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
     * Lists all AdsForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $marks = AdsForm::find()
            ->select(['ads.id_car_mark', 'COUNT(id_car_mark) AS countmark'])
            ->where(['temp' => 0])
            ->groupBy(['id_car_mark'])
            ->orderBy(['countmark' => SORT_DESC])
            ->all();

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
            'marks' => $marks
        ]);
    }

    /**
     * Lists all AdsForm models.
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);
        
        $marks = AdsForm::find()
            ->select(['ads.id_car_mark', 'COUNT(id_car_mark) AS countmark'])
            ->where(['temp' => 0])
            ->groupBy(['id_car_mark'])
            ->orderBy(['countmark' => SORT_DESC])
            ->all();

        /*$model = CarCharacteristicValue::find()
            ->where(['id_car_characteristic' => 41])
            ->groupBy('value')
            ->all();

        dd($model);*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
            'marks' => $marks         
        ]);
    }

    /**
     * Displays a single AdsForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
       
       // if (isset($model->profile_id)){
            $profile_model = Profiles::findOne(['id'=>$model->profile_id]);
       // }

        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $searchModel->city_id = $model->city_id;
        //$searchModel->price_to = $model->price;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $user = $model->user;

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'user' => $user,
            'profile_model' => $profile_model    
        ]);
    }

    /**
     * Creates a new AdsForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSetTariff($id)
    {
        $model = $this->findModel($id);

        $model->load(Yii::$app->request->post());

        $tariff = AdsTariffForm::findOne($model->tariff_id);

        //dd(Yii::$app->request->post());

        return $this->render('_form_tariff', [
            'model' => $model,
            'tariff' => $tariff
        ]);
    }

    public function actionLike($id)
    {
        /*if (!Yii::$app->request->isPjax) {
            return $this->goHome();
        }*/

        $model = RatingExtend::findOne(['ads_id' => $id, 'user_id' => Yii::$app->user->id]);
        if (!$model) {
            $model = new RatingExtend();
            $model->ads_id = $id;
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                $model = $this->findModel($id);
                $model->rating = $model->rating + 1;
                if ($model->save()) {
                    \Yii::$app->session->set(
                        'message',
                        [
                            'type'      => 'success',
                            'icon'      => 'glyphicon glyphicon-bell',
                            'message'   => ' '.\Yii::t('app', 'Вы успешно проголосовали.'),
                        ]
                    );
                }
            }
        }

        return $this->render('_item', [
            'model' => $model,
            'key'   => $id
        ]);
    }

    public function actionDislike($id)
    {
        /*if (!Yii::$app->request->isPjax) {
            return $this->goHome();
        }*/

        $model = RatingExtend::findOne(['ads_id' => $id/*, 'user_id' => Yii::$app->user->id*/]);

        //dd($model);

        if ($model) {
            RatingExtend::deleteAll(['ads_id' => $id, 'user_id' => Yii::$app->user->id]);
            $model = $this->findModel($id);
            $model->rating = $model->rating - 1;
            if ($model->save()) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type' => 'success',
                        'icon' => 'glyphicon glyphicon-bell',
                        'message' => ' ' . \Yii::t('app', 'Вы успешно проголосовали.'),
                    ]
                );
            }
        }

        return $this->renderAjax('_item', [
            'model' => $model,
            'key'   => $id
        ]);
    }

    /**
     * Creates a new AdsForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdsForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdsForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdsForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSelectMark($id)
    {
        $modelMark = CarMarkExtend::findOne($id);

        $model = new AdsSearch();
        $model->load(Yii::$app->request->post());
        $model->id_car_mark = $modelMark->id_car_mark;
        $model->id_car_model = null;
        $model->id_car_generation = null;
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('_search', [
            'model' => $model,
        ]);
    }

    public function actionSelectModel($id)
    {
        $modelMark = CarModelExtend::findOne($id);

        $model = new AdsSearch();
        $model->load(Yii::$app->request->post());
        $model->id_car_model = [$modelMark->id_car_model];
        $model->id_car_generation = null;
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('_search', [
            'model' => $model,
        ]);
    }

    public function actionSelectGeneration($id)
    {
        $modelMark = CarGenerationExtend::findOne($id);

        $model = new AdsSearch();
        $model->load(Yii::$app->request->post());
        $model->id_car_generation = [$modelMark->id_car_generation];
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('_search', [
            'model' => $model,
        ]);
    }

    public function actionSelectSerie($id)
    {
        $modelMark = CarSerieExtend::findOne($id);

        $model = new AdsSearch();
        $model->load(Yii::$app->request->post());
        $model->id_car_serie = [$modelMark->id_car_serie];
        $model->id_car_modification = null;

        return $this->render('_search', [
            'model' => $model,
        ]);
    }

    public function actionSelectModification($id)
    {
        $modelMark = CarModificationExtend::findOne($id);

        $model = new AdsSearch();
        $model->load(Yii::$app->request->post());
        $model->id_car_modification = [$modelMark->id_car_modification];

        return $this->render('_search', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the AdsForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdsForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdsForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
