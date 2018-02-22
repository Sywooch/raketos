<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 12.10.2016
 * Time: 7:37
    [
        'id',
        'username',
        'email',
        'phone',
        'user_folder',
        'status',
        'password_hash',
        'password_encrypted',
        'auth_key',
        'created_at',
    ]
 */
use common\models\Constants;

/**
 * пароль admin
*/

return [
    [
        1,
        'Создатель',
        '79111111111',
        'creator@creator.com',
        Constants::STATUS_ACTIVE,
        '$2y$13$rnyWZ2FRO7ypSECg1YRkV.2TZsjx1cpYKn2NBT5/N590tBnM9fR.2',
        'NQnl0Y7+I0UQrZPbLUHTIEzB/80DDqKgMgubJ2UN/+o=',
        'rHVgLiyXqgqi7xShLYvuxWSJnX81bHmb',
        time(),
        time()
    ],
    [
        2,
        'Администратор',
        '79222222222',
        'admin@admin.com',
        Constants::STATUS_ACTIVE,
        '$2y$13$rnyWZ2FRO7ypSECg1YRkV.2TZsjx1cpYKn2NBT5/N590tBnM9fR.2',
        'NQnl0Y7+I0UQrZPbLUHTIEzB/80DDqKgMgubJ2UN/+o=',
        'rHVgLiyXqgqi7xShLYvuxWSJnX81bHmb',
        time(),
        time()
    ],
    [
        3,
        'Редактор',
        '79333333333',
        'redactor@redactor.com',
        Constants::STATUS_ACTIVE,
        '$2y$13$rnyWZ2FRO7ypSECg1YRkV.2TZsjx1cpYKn2NBT5/N590tBnM9fR.2',
        'NQnl0Y7+I0UQrZPbLUHTIEzB/80DDqKgMgubJ2UN/+o=',
        'rHVgLiyXqgqi7xShLYvuxWSJnX81bHmb',
        time(),
        time()
    ],
    [
        4,
        'Пользователь',
        '79444444444',
        'user@user.com',
        Constants::STATUS_ACTIVE,
        '$2y$13$rnyWZ2FRO7ypSECg1YRkV.2TZsjx1cpYKn2NBT5/N590tBnM9fR.2',
        'NQnl0Y7+I0UQrZPbLUHTIEzB/80DDqKgMgubJ2UN/+o=',
        'rHVgLiyXqgqi7xShLYvuxWSJnX81bHmb',
        time(),
        time()
    ],
];
