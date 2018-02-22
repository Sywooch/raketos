<?php

namespace common\models\forms;

use common\models\Constants;
use common\models\extend\UserExtend;
use Yii;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends UserExtend
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            [['password'], 'string', 'min' => 5],
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            //dd(UserExtend::decript($user->password_encrypted));
            /* @var $user UserExtend */
            if (!$user || !$user->validatePassword($this->password)):
                $this->addError($attribute, \Yii::t('app', 'Неверный логин или пароль.'));
            endif;
        endif;
    }

    /**
     * Finds user by [[username]]
     *
     * @return UserExtend|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserExtend::findByEmail($this->email);
        }
        return $this->_user;
    }

    public function attributeLabels()
    {
        $labels = UserExtend::attributeLabels();
        $labels += [
            'password'      => Yii::t('app', 'Пароль'),
            'rememberMe'    => Yii::t('app', 'Запомнить меня'),
        ];
        return $labels;
    }

    public function login()
    {
        /* @var $user UserExtend */
        if ($this->validate()) {
            $this->status = ($user = $this->getUser()) ? $user->status : null;
            if ($this->status === Constants::STATUS_ACTIVE) {
                /* @var $user UserExtend */
                return \Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            } elseif ($this->status === Constants::STATUS_BLOCKED) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type' => 'danger',
                        'icon' => 'fa fa-ban',
                        'message' => \Yii::t('app', 'Пользователь {email} заблокирован!', ['email' => '<strong>' . $this->email . '</strong>']),
                    ]
                );
            } elseif ($this->status === Constants::STATUS_WAIT) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type' => 'warning',
                        'icon' => 'fa fa-info',
                        'message' => \Yii::t('app', 'Пользователь {email} не активирован!', ['email' => '<strong>' . $this->email . '</strong>']),
                    ]
                );
            }
            return false;
        }
        \Yii::$app->session->set(
            'message',
            [
                'type' => 'warning',
                'message' => \Yii::t('app', 'Не верный email или пароль.'),
            ]
        );
        return false;
    }
}
