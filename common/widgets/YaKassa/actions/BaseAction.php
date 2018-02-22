<?php
/**
 * Created by PhpStorm.
 * User: krosh
 * Date: 26.04.2016
 * Time: 11:09
 */

namespace common\widgets\YaKassa\actions;

use common\models\Constants;
use common\models\extend\AdsTariffExtend;
use common\models\extend\UserExtend;
use common\models\forms\AdsForm;
use common\models\forms\InvoiceForm;
use common\widgets\YaKassa\models\MD5;
use yii\base\Action;
use Yii;

/**
 * Class BaseAction
 * @package kroshilin\yakassa\actions
 *
 * @property \kroshilin\yakassa\YaKassa $component
 */

class BaseAction extends Action
{
    /**
     * @var string
     */
    public $component = 'yakassa';

    /**
     * Used to check YaKassa request orderCheck||paymentAviso||orderCancel
     * @var string
     */
    public $actionName;

    /**
     * User-defined function that would be run before response.
     * Response code depends on return result 0 when true, 100 when false
     * Format: function (\yii\web\Request $request) { ... }
     * Should return true||false
     * @var callable
     */
    public $beforeResponse;

    public function init()
    {
        parent::init();
        $this->controller->enableCsrfValidation = false;
        //Yii::$app->controller->enableCsrfValidation = false;
        Yii::$app->response->setStatusCode(200);
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'application/xml; charset=utf-8');

    }

    public function run()
    {
        $model = new MD5();
        $model->load(Yii::$app->request->post(), "");
        $model->validate();
        if ($model->hasErrors()) {
            return $this->getComponent()->buildResponse($this->actionName, $model->invoiceId, 1, Yii::t($this->getComponent()->messagesCategory, 'Wrong MD5 hash'));
        }

        $user_email = Yii::$app->request->post('customerNumber');
        $orderNumber = explode('-', Yii::$app->request->post('orderNumber'));
        $id_ads = (int) $orderNumber[1];
        $id_tariff = (int) $orderNumber[2];

        $modelUser = UserExtend::findOne(['email' => $user_email]);
        $modelAds = AdsForm::findOne($id_ads);
        $modelTariff = AdsTariffExtend::findOne($id_tariff);

        if ($this->actionName == 'checkOrder') {
            $modelInvoice = new InvoiceForm();
            $modelInvoice->sum          = (int) Yii::$app->request->post('sum');
            $modelInvoice->id_user      = $modelUser->id;
            $modelInvoice->id_ads       = $modelAds->id;
            $modelInvoice->id_tariff    = $orderNumber[2];
            if (!$modelInvoice->save()) {
                return $this->getComponent()->buildResponse($this->actionName, $model->invoiceId, 100);
            }
        } elseif ($this->actionName == 'paymentAviso') {
            $modelInvoice = InvoiceForm::findOne([
                'id_user' => $modelUser->id,
                'id_ads' => $modelAds->id,
                'id_tariff' => $orderNumber[2],
                'status' => Constants::STATUS_WAIT,
            ]);
            $modelInvoice->status = Constants::STATUS_ACTIVE;
            if ($modelInvoice->save()) {
                $modelAds->tariff_id = $orderNumber[2];
                if (!$modelAds->save()) {
                    return $this->getComponent()->buildResponse($this->actionName, $model->invoiceId, 100);
                }
            }


        }
        return $this->getComponent()->buildResponse($this->actionName, $model->invoiceId, 0);
    }

    /**
     * @return \kroshilin\yakassa\YaKassa;
     */
    public function getComponent()
    {
        return Yii::$app->get($this->component);
    }
}