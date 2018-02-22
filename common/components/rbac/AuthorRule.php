<?php

/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 12.07.2016
 * Time: 20:29
 */

namespace common\components\rbac;

use yii\rbac\Rule;

/**
 * Class AuthorRule
 * Проверка на авторство
 * @package lowbase\user\rules
 */
/*class AuthorRule extends Rule
{
    //public $name = 'AuthorRule';

    public function execute($user_id, $item, $params)
    {
        dd(123);
        return isset($params['post']) ? $params['post']->createdBy == $user_id : false;
    }
}*/
class AuthorRule extends Rule
{
    public $name = 'authorRule';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        //return true;
        dd($params->user_id);
        return isset($params->user_id) ? $params->user_id == $user : false;
    }
}