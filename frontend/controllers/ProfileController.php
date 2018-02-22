<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 9:59
 */

namespace frontend\controllers;

use common\models\Constants;
use common\models\extend\UserExtend;
use common\models\forms\AdsForm;
use common\models\forms\UserForm;
use common\models\search\AdsSearch;
use common\models\ProfilesSearch;
use Yii;
use common\models\extend\DocumentExtend;
use common\models\search\ArticleSearch;
use yii\web\Controller;

class ProfileController extends BehaviorsController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = UserForm::findOne(Yii::$app->user->id);
        
        if (!$model) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'warning',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Профиль пользователя не найден!'),
                ]
            );
            return $this->redirect(['/']);
        }
        
        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $searchModel->user_id = $model->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $profileSearchModel = new ProfilesSearch();
        $profileDataProvider = $profileSearchModel->search(Yii::$app->request->queryParams,$model->id);
        
        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profileDataProvider' => $profileDataProvider
        ]);
    }

    public function actionUpdate()
    {
        $model = UserForm::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'warning',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Профиль успешно изменен.'),
                ]
            );

            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $model = AdsForm::findOne($id);

        if (isset($model->adsCarCharacteristic)) {
            $model->adsCarCharacteristic->delete();
        }

        if (isset($model->deleteRatingAds)) {
            //dd($model->ratingAds);
            $model->deleteRatingAds->delete();
        }

        if (isset($model->invoices)) {
            foreach ($model->invoices as $one) {
                $one->delete();
            }
        }

        $model->delete();
        \Yii::$app->session->set(
            'message',
            [
                'type'      => 'warning',
                'icon'      => 'glyphicon glyphicon-bell',
                'message'   => ' '.\Yii::t('app', 'Объявление успешно удалено.'),
            ]
        );

        return $this->redirect(['index']);
    }
}
