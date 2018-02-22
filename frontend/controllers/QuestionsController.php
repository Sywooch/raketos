<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 12:53
 */

namespace frontend\controllers;

use common\models\Constants;
use common\models\extend\QuestionExtend;
use common\models\forms\QuestionForm;
use common\models\search\AdsSearch;
use Yii;
use common\models\extend\DocumentExtend;
use common\models\search\QuestionSearch;

class QuestionsController extends BehaviorsController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = DocumentExtend::findOne(['type' => 'questions-page']);
        $modelQuestion = new QuestionForm();

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
            'model' => $model,
            'modelQuestion' => $modelQuestion
        ]);
    }

    public function actionCreate()
    {
        $model = new QuestionForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'warning',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Ваш вопрос отправлен специалисту сайта.'),
                ]
            );
        }
        return $this->redirect(['index']);
    }
}