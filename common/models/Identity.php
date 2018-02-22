<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.08.2016
 * Time: 11:12
 */

namespace common\models;

use common\models\extend\UserOnlineExtend;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * @property UserOnlineExtend $userOnline
 */
class Identity extends User implements IdentityInterface
{
    /* Классы идентификации */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}