<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 12.05.2017
 * Time: 9:49
 */

namespace common\models\forms;


use common\models\extend\InvoiceExtend;
use yii\behaviors\TimestampBehavior;

class InvoiceForm extends InvoiceExtend
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
        ]];
    }
}