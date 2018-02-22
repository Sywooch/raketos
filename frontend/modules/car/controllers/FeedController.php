<?php

namespace frontend\modules\car\controllers;

use common\models\extend\CarGenerationExtend;
use common\models\extend\CarMarkExtend;
use common\models\extend\CarModelExtend;
use common\models\extend\CarModificationExtend;
use common\models\extend\CarSerieExtend;
use common\models\extend\UserExtend;
use common\models\forms\AdsCarCharacteristicForm;
use Yii;
use common\models\forms\AdsForm;
use yii\helpers\Url;
use common\models\Profiles;
use yii\helpers\ArrayHelper;

class FeedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'danger',
                    'icon'      => 'glyphicon glyphicon-alert',
                    'message'   => ' '.\Yii::t('app', 'Перед тем, как подать объявление, Вам необходимо зарегистрироваться.'),
                ]
            );
            return $this->redirect(['/site/signup']);
        } else {
            /* @var $user UserExtend */
            $user = Yii::$app->user->identity;
            if ($user->first_name == null || $user->phone == null) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type'      => 'danger',
                        'icon'      => 'glyphicon glyphicon-alert',
                        'message'   => ' '.\Yii::t('app', 'Необходимо заполнить ваше имя и телефон.'),
                    ]
                );
                return $this->redirect(['/profile/index']);
            }
        }

        AdsForm::deleteAll(['temp' => 1]);
        $model = new AdsForm();
        $model->save(false);

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/car/feed/step-two', 'id' => $model->id]));
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionFeeded()
    {
        return $this->render('feeded');
    }

    public function actionStepOne($id)
    {
        $model = AdsForm::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Страница не существует!');
        }
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/car/feed/step-two', 'id' => $model->id]));
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionStepTwo($id)
    {
        $model = AdsForm::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Страница не существует!');
        }
        $model->scenario = 'step2';
        
        // получаем все профили текущего пользователя
        $profiles = Profiles::find()->where(['user_id' => Yii::$app->user->id])->all();
        // формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
        $profiles_items = ArrayHelper::map($profiles,'id','name');

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $modelAdsCarCharacteristic = new AdsCarCharacteristicForm();
            if ($model->id_car_modification) {
                $modelAdsCarCharacteristic->id_car_modification = $model->id_car_modification;
            }
            $modelAdsCarCharacteristic->ads_id = $model->id;
            if (!$modelAdsCarCharacteristic->save()) {
                dd($model->errors);
            }

            return $this->redirect(Url::to(['/car/feed/step-three', 'id' => $model->id]));
        }

        return $this->render('step2', [
            'model' => $model,
            'profiles_items' => $profiles_items
        ]);
    }

    public function actionStepThree($id)
    {
        $model = AdsForm::findOne($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-ok',
                    'message'   => ' '.\Yii::t('app', 'Ваше объявление успешно добавлено.'),
                ]
            );
            return $this->redirect(['feeded']);
        }
        
      //  if (isset($model->profile_id)){
            $profile_model = Profiles::findOne(['id'=>$model->profile_id]);
      //  }
        
        return $this->render('step3', [
            'model' => $model,
            'profile_model' => $profile_model
        ]);
    }

    public function actionFeed($id)
    {
        $model = AdsForm::findOne($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-ok',
                    'message'   => ' '.\Yii::t('app', 'Ваше объявление успешно добавлено.'),
                ]
            );
            return $this->goHome();
        }

        return $this->render('step3', [
            'model' => $model,
        ]);
    }

    public function actionSelectMark($id)
    {
        $modelMark = CarMarkExtend::findOne($id);

        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);
        $model->load(Yii::$app->request->post());
        $model->id_car_mark = $modelMark->id_car_mark;
        $model->id_car_model = null;
        $model->id_car_generation = null;
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionSelectModel($id)
    {
        $modelMark = CarModelExtend::findOne($id);

        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);
        $model->load(Yii::$app->request->post());
        $model->id_car_model = $modelMark->id_car_model;
        $model->id_car_generation = null;
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionSelectGeneration($id)
    {
        $modelMark = CarGenerationExtend::findOne($id);

        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);
        $model->load(Yii::$app->request->post());
        $model->id_car_generation = $modelMark->id_car_generation;
        $model->id_car_serie = null;
        $model->id_car_modification = null;

        return $this->render('step2', [
            'model' => $model,
        ]);
    }

    public function actionSelectSerie($id)
    {
        $modelMark = CarSerieExtend::findOne($id);

        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);
        $model->load(Yii::$app->request->post());
        $model->id_car_serie = $modelMark->id_car_serie;
        $model->id_car_modification = null;

        return $this->render('step2', [
            'model' => $model,
        ]);
    }

    public function actionSelectModification($id)
    {
        $modelMark = CarModificationExtend::findOne($id);

        $model = AdsForm::findOne(Yii::$app->request->post('AdsForm')['id']);
        $model->load(Yii::$app->request->post());
        $model->id_car_modification = $modelMark->id_car_modification;

        return $this->render('step2', [
            'model' => $model,
        ]);
    }
}
