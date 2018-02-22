<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 20:40
 */

namespace frontend\controllers;

use common\models\Constants;
use common\models\extend\ArticleExtend;
use common\models\search\AdsSearch;
use Yii;
use common\models\extend\DocumentExtend;
use common\models\search\ArticleSearch;

class ArticlesController extends BehaviorsController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = DocumentExtend::findOne(['type' => 'articles-page']);

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
        $model = ArticleExtend::findOne($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
