<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 08.02.2017
 * Time: 17:45
 */

namespace common\models\forms;

use common\models\Constants;
use Yii;
use common\components\validators\PhoneValidator;
use common\models\extend\UserExtend;
use yii\behaviors\TimestampBehavior;

class UserForm extends UserExtend
{
    public $input_phone;

    public $old_password;
    public $password;
    public $confirm_password;

    public $message;

    public function rules()
    {
        $items = UserExtend::rules();
        $items[] = ['input_phone', PhoneValidator::className()];
        $items[] = ['input_phone', 'unique', 'targetAttribute' => 'phone', 'targetClass' => UserExtend::className()];
        $items[] = [['input_phone', 'email'], 'required'];
        $items[] = [['old_password', 'confirm_password'], 'string', 'min' => 5];
        $items[] = [['password'], 'string', 'min' => 5];
        $items[] = ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => \Yii::t('app', 'Пароли не совпадают.')];
        $items[] = [['password'], 'passwordValidate', 'skipOnEmpty' => true];
        $items[] = [['message'], 'string'];
        $items[] = [['email'], 'email'];
        return $items;
    }

    public function attributeLabels()
    {
        $items = UserExtend::attributeLabels();
        $items['input_phone'] = Yii::t('app', 'Телефон');
        $items['old_password'] = Yii::t('app', 'Текущий пароль');
        $items['password'] = Yii::t('app', 'Новый пароль');
        $items['confirm_password'] = Yii::t('app', 'Подтвердить пароль');
        $items['message'] = Yii::t('app', 'Сообщение');
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

    public function passwordValidate()
    {
        if ($this->old_password != null) {
            if (!$this->validatePassword($this->old_password)) {
                $this->addError('old_password', \Yii::t('app', 'Неверный текущий пароль.'));
            }
        }
        if ($this->old_password != null && !$this->password) {
            $this->addError('password', \Yii::t('app', 'Введите новый пароль.'));
        }
        /*if ($this->password != null && !$this->old_password) {
            $this->addError('old_password', \Yii::t('app', 'Укажите текущий пароль.'));
        }*/
        if ($this->password != $this->confirm_password) {
            $this->addError('password', \Yii::t('app', 'Пароли не совпадают.'));
            $this->addError('confirm_password', \Yii::t('app', 'Пароли не совпадают.'));
        }
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->status == null) {
            $this->status = Constants::STATUS_ACTIVE;
        }
        if ($this->input_phone) {
            $this->phone = '+7 '.$this->input_phone;
        }
        if ($this->password) {
            $this->setPassword($this->password);
        }
        return true;
    }
}