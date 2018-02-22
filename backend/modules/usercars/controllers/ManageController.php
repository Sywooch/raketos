<?php

namespace backend\modules\usercars\controllers;

use common\models\Constants;
//use common\models\extend\CarGenerationExtend;
//use common\models\extend\CarMarkExtend;
//use common\models\extend\CarModelExtend;
//use common\models\extend\CarModificationExtend;
//use common\models\extend\CarSerieExtend;

use common\models\search\CarMarkSearch;
use common\models\search\CarSerieSearch;
use common\models\search\CarModificationSearch;
use common\models\search\CarGenerationSearch;
use common\models\search\CarModelSearch;

use Yii;
use common\models\forms\AdsForm;
use common\models\search\AdsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageController implements the CRUD actions for AdsForm model.
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
     * Lists all AdsForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdsSearch(['scenario' => 'admin']);
        $searchModel->load(Yii::$app->request->queryParams);

        $modelCarMarkSearch = new CarMarkSearch();
        $modelCarMarkSearch->load(Yii::$app->request->queryParams);
        if ($modelCarMarkSearch->name)
        {
           $model = CarMarkSearch::find()->filterWhere(['ilike', 'name', $modelCarMarkSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_mark = array_column($model, 'id_car_mark');
        }

        $modelCarModelSearch = new CarModelSearch();
        $modelCarModelSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModelSearch->name)
        {
           $model = CarModelSearch::find()->filterWhere(['ilike', 'name', $modelCarModelSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_model = array_column($model, 'id_car_model');
        }

        $modelCarGenerationSearch = new CarGenerationSearch();
        $modelCarGenerationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarGenerationSearch->name)
        {
           $model = CarGenerationSearch::find()->filterWhere(['ilike', 'name', $modelCarGenerationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_generation = array_column($model, 'id_car_generation');
        }

        $modelCarSerieSearch = new CarSerieSearch();
        $modelCarSerieSearch->load(Yii::$app->request->queryParams);
        if ($modelCarSerieSearch->name)
        {
           $model = CarSerieSearch::find()->filterWhere(['ilike', 'name', $modelCarSerieSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_serie = array_column($model, 'id_car_serie');
        }

        $modelCarModificationSearch = new CarModificationSearch();
        $modelCarModificationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModificationSearch->name)
        {
           $model = CarModificationSearch::find()->filterWhere(['ilike', 'name', $modelCarModificationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_modification = array_column($model, 'id_car_modification');
        }
        /*if ($searchModel->id_car_mark) {
            $model = CarMarkExtend::findOne(['name' => $searchModel->id_car_mark]);
            $searchModel->id_car_mark = $model->id_car_mark;
        }
        if ($searchModel->id_car_model) {
            $model = CarModelExtend::findOne(['name' => $searchModel->id_car_model]);
            $searchModel->id_car_model = $model->id_car_model;
        }
        if ($searchModel->id_car_generation) {
            $model = CarGenerationExtend::findOne(['name' => $searchModel->id_car_generation]);
            $searchModel->id_car_generation = $model->id_car_generation;
        }
        if ($searchModel->id_car_serie) {
            $model = CarSerieExtend::findOne(['name' => $searchModel->id_car_serie]);
            $searchModel->id_car_serie = $model->id_car_serie;
        }
        if ($searchModel->id_car_modification) {
            $model = CarModificationExtend::findOne(['name' => $searchModel->id_car_modification]);
            $searchModel->id_car_modification = $model->id_car_modification;
        } */

        $dataProvider = $searchModel->search(null);

        //dd($dataProvider->models);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'modelCarMarkSearch' => $modelCarMarkSearch,
            'modelCarModelSearch' => $modelCarModelSearch,
            'modelCarGenerationSearch' => $modelCarGenerationSearch,
            'modelCarSerieSearch' => $modelCarSerieSearch,
            'modelCarModificationSearch' => $modelCarModificationSearch,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdsForm model.
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
     * Creates a new AdsForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSetTariff($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Тариф успешно применен.'),
                ]
            );
        } return $this->redirect(['index']);
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
                    /** @var AdsForm $model */
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
                    'message'   => ' '.\Yii::t('app', 'Выбранные объявления успешно активированы.'),
                ]
            );
        }

        $searchModel = new AdsSearch(['scenario' => 'admin']);
        $searchModel->load(Yii::$app->request->queryParams);
        
        $modelCarMarkSearch = new CarMarkSearch();
        $modelCarMarkSearch->load(Yii::$app->request->queryParams);
        if ($modelCarMarkSearch->name)
        {
           $model = CarMarkSearch::find()->filterWhere(['ilike', 'name', $modelCarMarkSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_mark = array_column($model, 'id_car_mark');
        }

        $modelCarModelSearch = new CarModelSearch();
        $modelCarModelSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModelSearch->name)
        {
           $model = CarModelSearch::find()->filterWhere(['ilike', 'name', $modelCarModelSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_model = array_column($model, 'id_car_model');
        }

        $modelCarGenerationSearch = new CarGenerationSearch();
        $modelCarGenerationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarGenerationSearch->name)
        {
           $model = CarGenerationSearch::find()->filterWhere(['ilike', 'name', $modelCarGenerationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_generation = array_column($model, 'id_car_generation');
        }

        $modelCarSerieSearch = new CarSerieSearch();
        $modelCarSerieSearch->load(Yii::$app->request->queryParams);
        if ($modelCarSerieSearch->name)
        {
           $model = CarSerieSearch::find()->filterWhere(['ilike', 'name', $modelCarSerieSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_serie = array_column($model, 'id_car_serie');
        }

        $modelCarModificationSearch = new CarModificationSearch();
        $modelCarModificationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModificationSearch->name)
        {
           $model = CarModificationSearch::find()->filterWhere(['ilike', 'name', $modelCarModificationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_modification = array_column($model, 'id_car_modification');
        }
        /*if ($searchModel->id_car_mark) {
            $model = CarMarkExtend::findOne(['name' => $searchModel->id_car_mark]);
            $searchModel->id_car_mark = $model->id_car_mark;
        }
        if ($searchModel->id_car_model) {
            $model = CarModelExtend::findOne(['name' => $searchModel->id_car_model]);
            $searchModel->id_car_model = $model->id_car_model;
        }
        if ($searchModel->id_car_generation) {
            $model = CarGenerationExtend::findOne(['name' => $searchModel->id_car_generation]);
            $searchModel->id_car_generation = $model->id_car_generation;
        }
        if ($searchModel->id_car_serie) {
            $model = CarSerieExtend::findOne(['name' => $searchModel->id_car_serie]);
            $searchModel->id_car_serie = $model->id_car_serie;
        }
        if ($searchModel->id_car_modification) {
            $model = CarModificationExtend::findOne(['name' => $searchModel->id_car_modification]);
            $searchModel->id_car_modification = $model->id_car_modification;
        } */

        $dataProvider = $searchModel->search(null);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'modelCarMarkSearch' => $modelCarMarkSearch,
            'modelCarModelSearch' => $modelCarModelSearch,
            'modelCarGenerationSearch' => $modelCarGenerationSearch,
            'modelCarSerieSearch' => $modelCarSerieSearch,
            'modelCarModificationSearch' => $modelCarModificationSearch,
            'dataProvider' => $dataProvider,
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
                    /** @var $model AdsForm */
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
                    'message'   => ' '.\Yii::t('app', 'Выбранные объявления успешно блокированы.'),
                ]
            );
        }

        $searchModel = new AdsSearch(['scenario' => 'admin']);
        $searchModel->load(Yii::$app->request->queryParams);
        
        $modelCarMarkSearch = new CarMarkSearch();
        $modelCarMarkSearch->load(Yii::$app->request->queryParams);
        if ($modelCarMarkSearch->name)
        {
           $model = CarMarkSearch::find()->filterWhere(['ilike', 'name', $modelCarMarkSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_mark = array_column($model, 'id_car_mark');
        }

        $modelCarModelSearch = new CarModelSearch();
        $modelCarModelSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModelSearch->name)
        {
           $model = CarModelSearch::find()->filterWhere(['ilike', 'name', $modelCarModelSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_model = array_column($model, 'id_car_model');
        }

        $modelCarGenerationSearch = new CarGenerationSearch();
        $modelCarGenerationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarGenerationSearch->name)
        {
           $model = CarGenerationSearch::find()->filterWhere(['ilike', 'name', $modelCarGenerationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_generation = array_column($model, 'id_car_generation');
        }

        $modelCarSerieSearch = new CarSerieSearch();
        $modelCarSerieSearch->load(Yii::$app->request->queryParams);
        if ($modelCarSerieSearch->name)
        {
           $model = CarSerieSearch::find()->filterWhere(['ilike', 'name', $modelCarSerieSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_serie = array_column($model, 'id_car_serie');
        }

        $modelCarModificationSearch = new CarModificationSearch();
        $modelCarModificationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModificationSearch->name)
        {
           $model = CarModificationSearch::find()->filterWhere(['ilike', 'name', $modelCarModificationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_modification = array_column($model, 'id_car_modification');
        }
        /*if ($searchModel->id_car_mark) {
            $model = CarMarkExtend::findOne(['name' => $searchModel->id_car_mark]);
            $searchModel->id_car_mark = $model->id_car_mark;
        }
        if ($searchModel->id_car_model) {
            $model = CarModelExtend::findOne(['name' => $searchModel->id_car_model]);
            $searchModel->id_car_model = $model->id_car_model;
        }
        if ($searchModel->id_car_generation) {
            $model = CarGenerationExtend::findOne(['name' => $searchModel->id_car_generation]);
            $searchModel->id_car_generation = $model->id_car_generation;
        }
        if ($searchModel->id_car_serie) {
            $model = CarSerieExtend::findOne(['name' => $searchModel->id_car_serie]);
            $searchModel->id_car_serie = $model->id_car_serie;
        }
        if ($searchModel->id_car_modification) {
            $model = CarModificationExtend::findOne(['name' => $searchModel->id_car_modification]);
            $searchModel->id_car_modification = $model->id_car_modification;
        } */

        $dataProvider = $searchModel->search(null);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'modelCarMarkSearch' => $modelCarMarkSearch,
            'modelCarModelSearch' => $modelCarModelSearch,
            'modelCarGenerationSearch' => $modelCarGenerationSearch,
            'modelCarSerieSearch' => $modelCarSerieSearch,
            'modelCarModificationSearch' => $modelCarModificationSearch,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Множественное удаление объявлений
     * @return bool
     * @throws NotFoundHttpException
     */
     public function actionMultidelete()
     {
         $keys = \Yii::$app->request->post('keys');
         if ($keys) {
             foreach ($keys as $id) {
                 if ($id != \Yii::$app->user->id) {
                     $model = $this->findModel($id);
                    if(!$model->delete())
                    {
                        dd($model->errors);
                    }
                    else {
                        \Yii::$app->session->set(
                            'message',
                            [
                                'type'      => 'info',
                                'icon'      => 'glyphicon glyphicon-info-sign',
                                'message'   => ' '.\Yii::t('app', 'Выбранные объявления успешно удалены.'),
                            ]
                        );
                    }
                 }
             }
             
         }
 
         $searchModel = new AdsSearch(['scenario' => 'admin']);
         $searchModel->load(Yii::$app->request->queryParams);
         
         $modelCarMarkSearch = new CarMarkSearch();
        $modelCarMarkSearch->load(Yii::$app->request->queryParams);
        if ($modelCarMarkSearch->name)
        {
           $model = CarMarkSearch::find()->filterWhere(['ilike', 'name', $modelCarMarkSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_mark = array_column($model, 'id_car_mark');
        }

        $modelCarModelSearch = new CarModelSearch();
        $modelCarModelSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModelSearch->name)
        {
           $model = CarModelSearch::find()->filterWhere(['ilike', 'name', $modelCarModelSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_model = array_column($model, 'id_car_model');
        }

        $modelCarGenerationSearch = new CarGenerationSearch();
        $modelCarGenerationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarGenerationSearch->name)
        {
           $model = CarGenerationSearch::find()->filterWhere(['ilike', 'name', $modelCarGenerationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_generation = array_column($model, 'id_car_generation');
        }

        $modelCarSerieSearch = new CarSerieSearch();
        $modelCarSerieSearch->load(Yii::$app->request->queryParams);
        if ($modelCarSerieSearch->name)
        {
           $model = CarSerieSearch::find()->filterWhere(['ilike', 'name', $modelCarSerieSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_serie = array_column($model, 'id_car_serie');
        }

        $modelCarModificationSearch = new CarModificationSearch();
        $modelCarModificationSearch->load(Yii::$app->request->queryParams);
        if ($modelCarModificationSearch->name)
        {
           $model = CarModificationSearch::find()->filterWhere(['ilike', 'name', $modelCarModificationSearch->name])->asArray()->all();
           if ($model) $searchModel->id_car_modification = array_column($model, 'id_car_modification');
        }
         /*if ($searchModel->id_car_mark) {
             $model = CarMarkExtend::findOne(['name' => $searchModel->id_car_mark]);
             $searchModel->id_car_mark = $model->id_car_mark;
         }
         if ($searchModel->id_car_model) {
             $model = CarModelExtend::findOne(['name' => $searchModel->id_car_model]);
             $searchModel->id_car_model = $model->id_car_model;
         }
         if ($searchModel->id_car_generation) {
             $model = CarGenerationExtend::findOne(['name' => $searchModel->id_car_generation]);
             $searchModel->id_car_generation = $model->id_car_generation;
         }
         if ($searchModel->id_car_serie) {
             $model = CarSerieExtend::findOne(['name' => $searchModel->id_car_serie]);
             $searchModel->id_car_serie = $model->id_car_serie;
         }
         if ($searchModel->id_car_modification) {
             $model = CarModificationExtend::findOne(['name' => $searchModel->id_car_modification]);
             $searchModel->id_car_modification = $model->id_car_modification;
         } */
 
         $dataProvider = $searchModel->search(null);
 
         return $this->render('index', [
             'searchModel' => $searchModel,
             'modelCarMarkSearch' => $modelCarMarkSearch,
             'modelCarModelSearch' => $modelCarModelSearch,
             'modelCarGenerationSearch' => $modelCarGenerationSearch,
             'modelCarSerieSearch' => $modelCarSerieSearch,
             'modelCarModificationSearch' => $modelCarModificationSearch,
             'dataProvider' => $dataProvider,
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
