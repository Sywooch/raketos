<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 21:43
 */

namespace common\models\forms;

use yii\behaviors\TimestampBehavior;
use common\models\extend\InfoExtend;

class InfoForm extends InfoExtend
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