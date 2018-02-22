<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 21.10.2016
 * Time: 21:50
 */

namespace common\components\validators;

use common\models\extend\GeoCountryExtend;
use common\models\extend\UserExtend;
use common\models\Identity;
use Yii;
use yii\validators\Validator;

class PhoneValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $input_phone    = $model->input_phone;

        $phone = $this->clearString('+7'.$input_phone);

        if (11 != strlen($phone)) {
            $this->addError($model, $attribute, Yii::t('app', 'Не верный номер телефона'));
        }
        $modelIdentity = UserExtend::findOne(['phone' => '+7'.$input_phone]);
        if ($model->isNewRecord && $modelIdentity) {
            $this->addError($model, $attribute, Yii::t('app', 'Этот номер уже занят.'));
        }
    }

    private function clearString($string)
    {
        return str_replace(['\\', '_', '-', ' ', '(', ')', '+'], '', $string);
    }
}