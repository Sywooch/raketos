<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 30.06.2015
 * Time: 5:48
 */

namespace backend\controllers;

use common\components\UserOnlineBehavior;
use yii\web\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                    return $action->controller->redirect('action');
                    //throw new \Exception('Нет доступа.');
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'controllers' => ['site'],
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['redactor'],
                    ],
                    [
                        'controllers' => ['geos/address-type', 'geos/city', 'geos/country'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['rbac/manage'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['setting/manage'],
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['translate/manage'],
                        'actions' => ['index', 'rescan', 'clear-cache', 'save'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['user/manage', 'user/type', 'user/type-category'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'multiactive', 'multiblock'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['geos/address-type', 'user/manage', 'user/type', 'translate/manage', 'setting/manage', 'user/type', 'user/type-category',
                            'rbac/manage'
                        ],
                        'actions' => ['delete'],
                        'verbs' => ['POST'],
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['content/content-document', 'content/content-field', 'content/content-template'],
                        'actions' => ['index', 'view', 'create', 'update', 'change', 'move', 'multiactive', 'multiblock', 'multidelete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['user/user-document', 'user/user-field', 'user/user-template'],
                        'actions' => ['index', 'view', 'create', 'change-template', 'update', 'change', 'show', 'move', 'multiactive', 'multiblock', 'multidelete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'controllers' => ['export-csv'],
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ]
            ],
            'UserOnlineBehavior' => [
                'class' => UserOnlineBehavior::className()
            ]
       ];
    }
}