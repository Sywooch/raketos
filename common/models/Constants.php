<?php

/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 08.10.2016
 * Time: 23:17
 */

namespace common\models;

use Yii;

class Constants
{
    const STATUS_STATE_1 = 1;
    const STATUS_STATE_2 = 2;
    const STATUS_STATE_3 = 3;
    const STATUS_STATE_4 = 4;
    const STATUS_STATE_5 = 5;

    /* Статусы объявлений */
    const STATUS_IS_PAID   = 1;
    const STATUS_IS_NOT_PAID = 0;

    /* Статусы */
    const STATUS_WAIT   = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    /* Пол пользователя */
    const SEX_FEMALE    = 1;
    const SEX_MALE      = 2;

    const TYPE_ROLE = 1;        // Роль
    const TYPE_PERMISSION = 2;  // Допуск

    /**
     * @return array
     */
    public static function getSexList()
    {
        return [
            self::SEX_FEMALE    => \Yii::t('app', 'Женский'),
            self::SEX_MALE      =>  \Yii::t('app', 'Мужской'),
        ];
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE     => Yii::t('app', 'Активный'),
            self::STATUS_WAIT       => Yii::t('app', 'Не активный'),
            self::STATUS_BLOCKED    => Yii::t('app', 'Заблокирован'),
        ];
    }
}