<?php

namespace common\models;

use Yii;
use common\models\extend\UserExtend;

/**
 * This is the model class for table "user_oauth_key".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $provider_id
 * @property string $provider_user_id
 * @property string $page
 *
 * @property User $user
 */
class UserOauthKey extends \yii\db\ActiveRecord
{
    
    public static $social_services_id = [
        'twitter' => 1,
        'google_oauth'  => 2,
        'yandex_oauth'  => 3,
        'facebook' => 4,
        'vkontakte'  => 5,
    ];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_oauth_key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'provider_id', 'provider_user_id'], 'required'],
            [['user_id', 'provider_id'], 'integer'],
            [['provider_user_id', 'page'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'provider_id' => 'Provider ID',
            'provider_user_id' => 'Provider User ID',
            'page' => 'Page',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserExtend::className(), ['id' => 'user_id']);
    }
    
    /**
     * Процесс авторизации через соцсети 
     * @return \yii\db\ActiveQuery
     */
    public static function oaufProcess ($serviceName) {
                /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));
 
            try {
                if ($eauth->authenticate()) {
//                  var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;
                  
                    $service_id = UserOauthKey::$social_services_id[$eauth->getServiceName()] ;
                    $service_user_id = $eauth->getId();
                    
                    $user_oauth = UserOauthKey::findOne(['provider_id' => $service_id, 'provider_user_id' => $service_user_id]);
                    
                    if ($user_oauth){
                        $identity = $user_oauth->user; 
                       // var_dump($identity);
                    }
                    else {
                        $identity = UserExtend::createIdentityByEAuth($eauth);                      
                    }
                                                      
                    if ($identity) {
                        Yii::$app->getUser()->login($identity);
                    }
 
                    // special redirect with closing popup window
                    $eauth->redirect();
                }
                else {
                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());
 
                // close popup window and redirect to cancelUrl
//              $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
}
    
}
