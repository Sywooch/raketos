<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 19:19
 */

namespace common\models\forms;


use common\models\extend\ArticleExtend;
use yii\behaviors\TimestampBehavior;

class ArticleForm extends ArticleExtend
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