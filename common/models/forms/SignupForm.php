<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 02.12.2016
 * Time: 16:31
 */

namespace common\models\forms;

use common\components\validators\AddressValidator;
use common\components\validators\CityValidator;
use common\components\validators\PhoneValidator;
use common\models\AuthAssignment;
use common\models\Constants;
use common\models\extend\UserExtend;
use yii\behaviors\TimestampBehavior;
use Yii;
use common\models\Identity;

class SignupForm extends UserExtend
{
    public $input_phone;

    public function rules()
    {
        $items = UserExtend::rules();
        $items[] = ['input_phone', PhoneValidator::className()];
        $items[] = ['email', 'email'];
        $items[] = ['input_phone', 'unique', 'targetAttribute' => 'phone', 'targetClass' => Identity::className()];
        $items[] = ['email', 'unique', 'targetAttribute' => 'email', 'targetClass' => Identity::className()];
        $items[] = [['email', 'input_phone'], 'required'];
        return $items;
    }


    public function attributeLabels()
    {
        $items = UserExtend::attributeLabels();
        $items['input_phone'] = Yii::t('app', 'Телефон');
        return $items;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
        ]];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->input_phone) {
            $this->phone        = '+7'.$this->input_phone;
        }
        $this->status = Constants::STATUS_WAIT;
        $this->generateEmailConfirmToken();
        $this->phone        = '+7'.$this->input_phone;
        $this->directory    = Yii::$app->security->generateRandomString(2).'/'.Yii::$app->security->generateRandomString(2);
        /* Если пароль отсутсвует, генерируем пароль */
            $this->setPassword(\Yii::$app->security->generateRandomString(8));
        $this->generateAuthKey();
        //dd($this);
        return true;
        //return false;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
                /* Назначение роли */
                $auth = Yii::$app->authManager;
                $role = $auth->getRole('user');
                $auth->assign($role, $this->id);

        Yii::$app->mailer
            ->compose(
                ['html' => 'confirmEmail-html', 'text' => 'confirmEmail-text'],
                ['user' => $this]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::t('app', 'Сообщение от {name}', ['name' => Yii::$app->name])])
            ->setTo($this->email)
            ->setSubject(Yii::t('app', 'Подтверждение регистрации на сайте {name}', ['name' => Yii::$app->params['frontendUrl']]))
            ->send();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function afterFind()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        return true;
    }
}