<?php
namespace frontend\models;

use common\models\Constants;
use Yii;
use yii\base\Model;
use common\models\extend\UserExtend;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\extend\UserExtend',
                'filter' => ['status' => Constants::STATUS_ACTIVE],
                'message' => Yii::t('app)', 'Пользователя с этим адресом электронной почты не найден.')
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user UserExtend */
        $user = UserExtend::findOne([
            'status' => Constants::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!UserExtend::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' сообщение'])
            ->setTo($this->email)
            ->setSubject(Yii::t('app', 'Сброс пароля для {name}', ['name' => Yii::$app->name]))
            ->send();
    }
}
