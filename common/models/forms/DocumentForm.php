<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 15:28
 */

namespace common\models\forms;


use common\models\extend\DocumentExtend;
use yii\behaviors\TimestampBehavior;

class DocumentForm extends DocumentExtend
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