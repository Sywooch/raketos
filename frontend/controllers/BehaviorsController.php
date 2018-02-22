<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 30.06.2015
 * Time: 5:48
 */

namespace frontend\controllers;

use common\components\MyAccessControl;
use common\components\UserOnlineBehavior;
use yii\web\Controller;

class BehaviorsController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => MyAccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                    //return $action->controller->redirect('action');
                    throw new \Exception('Нет доступа.');
                },*/
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['logout'],
                        //'verbs' => ['POST'],
                        'roles' => ['@']
                    ],
                    [
                        'controllers' => ['site'],
                        'actions' => ['vklogin','login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'controllers' => ['site'],
                        'actions' => ['index', 'contact', 'search', 'top', 'ads', 'info', 'articles', 'questions', 'about', 'activate-account', 'request-password-reset',
                        'reset-password', 'like-slick', 'dislike-slick'],
                        'allow' => true,
                    ],
                    [
                        'controllers' => ['profile'],
                        'actions' => ['index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'controllers' => ['geo', 'questions', 'info', 'articles'],
                        'allow' => true,
                    ],
                ]
            ],
            'UserOnlineBehavior' => [
                'class' => UserOnlineBehavior::className()
            ],
            'eauth' => array(
                    // required to disable csrf validation on OpenID requests
                    'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                    'only' => array('login'),
                ),
       ];
    }
}