<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 28.05.2016
 * Time: 23:37
 */

namespace common\widgets\AuthWidget;

use yii\base\Widget;
use common\models\forms\LoginForm;
use common\models\forms\SignupForm;

class AuthWidget extends Widget
{
    public $modelLoginForm;
    public $modelSignupForm;

    public function init()
    {
        $this->modelLoginForm = new LoginForm();
        $this->modelSignupForm = new SignupForm();
        parent::init();
    }

    public function run() {
        return $this->render(
            'view',
            [
                'widget' => $this,
            ]);
    }
}