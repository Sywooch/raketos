<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 03.04.2017
 * Time: 17:46
 */

namespace common\components;

use Yii;
use yii\filters\AccessControl;

class MyAccessControl extends AccessControl
{
    private $cityKey;
    private $_defaultCity;

    public $citySessionKey = '_cityUrl';
    public $cityCookieKey = '_cityUrl';

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $this->_defaultCity = 524901;
        $uri = $_SERVER['REQUEST_URI'];
        $cityKey = Yii::$app->request->getCookies()->getValue('_city');
        $cityKey2 = \Yii::$app->session->get('_city');
        if ($cityKey == null && $cityKey2 == null) {
            $data = Yii::$app->geoData->data;
            if ($data['country']['id'] == 185) {
                return $action->controller->redirect('/'.$data['city']['id']);
            }
        }
        if (intval(Yii::$app->urlManager->city) != $this->_defaultCity && (!$uri || $uri == '/')) {
            return $action->controller->redirect('/'.Yii::$app->urlManager->city);
        }
        return true;
    }
}