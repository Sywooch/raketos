<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 12.05.2017
 * Time: 9:47
 */

namespace common\models\extend;


use common\models\Constants;
use common\models\Invoice;

/**
 * @property array $statusInvoice
 * @property array $statusList
 */

class InvoiceExtend extends Invoice
{
    public static function getStatusList()
    {
        return [
            Constants::STATUS_BLOCKED => \Yii::t('app', 'Заблокирован'),
            Constants::STATUS_ACTIVE => \Yii::t('app', 'Активен'),
            Constants::STATUS_WAIT =>  \Yii::t('app', 'Не активен'),
        ];
    }

    public function getStatusInvoice()
    {
        switch ($this->status) {
            case Constants::STATUS_BLOCKED:
                return '<span class="label label-danger">
                            <i class="fa fa-ban" aria-hidden="true"></i> '.$this->getStatusList()[Constants::STATUS_BLOCKED].'</span>';
                break;
            case Constants::STATUS_WAIT:
                return '<span class="label label-warning">
                            <i class="glyphicon glyphicon-hourglass"></i> '.$this->getStatusList()[Constants::STATUS_WAIT].'</span>';
                break;
            case Constants::STATUS_ACTIVE:
                return '<span class="label label-success">
                            <i class="glyphicon glyphicon-ok"></i> '.$this->getStatusList()[Constants::STATUS_ACTIVE].'</span>';
                break;
        }
        return false;
    }
}