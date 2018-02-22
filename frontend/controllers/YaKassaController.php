<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 31.03.2017
 * Time: 18:19
 */

namespace frontend\controllers;

use kroshilin\yakassa\actions\CheckOrderAction;
use kroshilin\yakassa\actions\PaymentAvisoAction;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class YaKassaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'order-check' => ['post'],
                    'payment-notification' => ['post'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'check-test' => [
                //'class' => 'app\components\yakassa\actions\CheckOrderAction',
                'class' => CheckOrderAction::className(),
                'beforeResponse' => function ($request) {
                    /**
                     * @var \yii\web\Request $request
                     */
                    $invoice_id = (int) $request->post('orderNumber');
                    //dd(1);
                    Yii::warning("Кто-то хотел купить несуществующую подписку! InvoiceId: {$invoice_id}", Yii::$app->yakassa->logCategory);
                    return false;
                }
            ],
            'aviso-test' => [
                'class' => PaymentAvisoAction::className(),
                'beforeResponse' => function ($request) {
                    //dd(2);
                    /**
                     * @var \yii\web\Request $request
                     */
                }
            ],
        ];
    }
}