<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 06.05.2017
 * Time: 10:42
 */

namespace frontend\controllers;

use common\models\forms\AdsForm;
use common\models\forms\AdsTariffForm;
use common\widgets\YaKassa\actions\CheckOrderAction;
use common\widgets\YaKassa\actions\PaymentAvisoAction;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

// shopPassword vD2lz45e
// shopId 132979

class YaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'check-test' => ['post'],
                    'aviso-test' => ['post'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            // проверка счета перед оплатой
            'check-test' => [
                'class' => CheckOrderAction::className(),
            ],
            // обращение после успешной оплаты
            'aviso-test' => [
                'class' => PaymentAvisoAction::className(),
            ],
        ];
    }

    public function actionIndex($id = null, $tariff = null)
    {
        if ($id && $tariff) {
            $model = AdsForm::findOne($id);
            $tariff = AdsTariffForm::findOne($tariff);
            return $this->render('index', [
                'model' => $model,
                'tariff' => $tariff
            ]);
        }
        return $this->render('index', [
            'model' => null,
            'tariff' => null
        ]);
    }

    public function actionCheck()
    {
        return true;
    }

    public function actionAviso()
    {
        return true;
    }

    public function actionSuccess()
    {
        return true;
    }

    public function actionFail()
    {
        return true;
    }

    public function actionSuccessTest()
    {
        \Yii::$app->session->set(
            'message',
            [
                'type'      => 'success',
                'icon'      => 'glyphicon glyphicon-bell',
                'message'   => ' '.\Yii::t('app', 'Оплата прошла успешно.'),
            ]
        );

        return $this->redirect(['/profile/index']);
    }

    public function actionFailTest()
    {
        \Yii::$app->session->set(
            'message',
            [
                'type'      => 'danger',
                'icon'      => 'glyphicon glyphicon-bell',
                'message'   => ' '.\Yii::t('app', 'Ошибка! Оплата не прошла.'),
            ]
        );

        return $this->redirect(['/profile/index']);
    }

    /**
     * @return \kroshilin\yakassa\YaKassa;
     */
    public function getComponent()
    {
        return Yii::$app->get('yakassa');;
    }
}