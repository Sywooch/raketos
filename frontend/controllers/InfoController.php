<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 21:53
 */

namespace frontend\controllers;

use common\models\Constants;
use common\models\extend\InfoExtend;
use common\models\search\AdsSearch;
use common\models\search\InfoSearch;
use Yii;
use common\models\extend\DocumentExtend;
use yii\web\Controller;

class InfoController extends BehaviorsController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = DocumentExtend::findOne(['type' => 'info-page']);

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $model = InfoExtend::findOne($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }
}