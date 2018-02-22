<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 11.10.2016
 * Time: 22:37
 */

namespace common\models\extend;


use common\models\UserOnline;

class UserOnlineExtend extends UserOnline
{
    /* Онлайн статус */
    const ONLINE_IS     = 1;
    const ONLINE_NOT    = 2;

    public static function getOnlineList()
    {
        return [
            self::ONLINE_IS     => \Yii::t('app', 'Онлайн'),
            self::ONLINE_NOT    => \Yii::t('app', 'Оффлайн'),
        ];
    }

    public function getOnlineStatus()
    {
        $model = self::findOne($this->user_id);
        if ($model) {
            $time = time() - $model->online;
            if ($time <= \Yii::$app->params['online']) {
                return true;
            }
        }
        return false;
    }

    public function getOnlineMark()
    {
        $online = $this->onlineStatus;
        if ($online) {
            return '<span class="label label-primary">online</span>';
        }
        return '<span class="label label-warning">offline</span>';
    }

    public static function getStatisticOnlineUsers()
    {
        $userOnline = UserOnlineExtend::find()
            ->where(['>', 'online', time() - 300])->count();
        $usersAll = UserExtend::find()
            ->count();
        $userOffline = $usersAll - $userOnline;

        return [
            'labels' => [
                "Пользователи онлайн",
                "Пользователи оффлайн",
            ],
            'datasets' => [
                [
                    'data' => [$userOnline, $userOffline],
                    'backgroundColor' => [
                        "#a3e1d4",
                        "#dedede",
                    ],
                    'hoverBackgroundColor' => [
                        "#1ab394",
                        "#1ab394",
                    ]
                ]
            ]
        ];
    }
}