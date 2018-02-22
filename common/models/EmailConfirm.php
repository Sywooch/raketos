<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.07.2016
 * Time: 11:32
 */

namespace common\models;

use yii\base\InvalidParamException;
use yii\base\Model;
use common\models\extend\UserExtend;

/**
 * Подтверждение электронной почты
 * Class EmailConfirm
 * @package common\models
 */
class EmailConfirm extends Model
{
    /**
     * @var User
     */
    private $_user;

    /**
     * @param  string $token - токен
     * @param  array $config - параметры
     * @throws \yii\base\InvalidParamException - при пустом или неправильном токене
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException(\Yii::t('app', 'Отсутствует код подтверждения.'));
        }
        $this->_user = UserExtend::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidParamException(\Yii::t('app', 'Неверный токен.'));
        }
        parent::__construct($config);
    }

    /**
     * Подтверждение электронной почты
     * @return bool|int
     */
    public function confirmEmail()
    {
        /* @var $user UserExtend */
        $user = $this->_user;
        $user->status = Constants::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();   // Удаление токена подтверждения электронной почты

        return (($user->save())) ? $user->id : false;
    }
}
