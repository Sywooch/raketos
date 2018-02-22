<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 22.07.2015
 * Time: 7:09
 */

namespace common\components;

use common\models\extend\UserOnlineExtend;
use Yii;
use yii\base\Behavior;
use yii\web\Controller;

class UserOnlineBehavior extends Behavior {

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    public function beforeAction()
    {
        if (!Yii::$app->user->isGuest) {
            /*if (Yii::$app->id == 'app-frontend') {
                Yii::$app->layout = 'inspinia-main';
            }*/
            $model = UserOnlineExtend::findOne(Yii::$app->user->id);
            if (!$model) {
                $model = new UserOnlineExtend();
                $model->user_id = Yii::$app->user->id;
                $model->online  = time();
                $model->save();
            } else {
                $model->updateAttributes(['online' => time()]);
            }
        }
    }
}