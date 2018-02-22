<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 12:36
 */

namespace common\models\forms;

use common\models\Constants;
use Yii;
use common\models\extend\QuestionExtend;
use yii\behaviors\TimestampBehavior;

class QuestionForm extends QuestionExtend
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

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->isNewRecord) {
            $this->user_id = Yii::$app->user->id;
        } else {
            if ($this->status != Constants::STATUS_BLOCKED) {
                $this->status = Constants::STATUS_ACTIVE;
            }
        }
        return true;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $view = 'sendAnswer';
        \Yii::$app->mailer->compose($view, ['model' => $this])
            ->setFrom([\Yii::$app->params['adminEmail']])
            ->setTo($this->user->email)
            ->setSubject(\Yii::t('app', 'Получен ответ на ваш вопрос.'))
            ->send();
    }
}