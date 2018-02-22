<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 06.02.2017
 * Time: 10:55
 */

namespace common\models\extend;

use Yii;
use common\models\AuthAssignment;
use common\models\Constants;
use common\models\Identity;
use phpnt\cropper\models\Photo;
use common\models\UserOauthKey;
use yii\base\ErrorException;

/**
 * @property array $statusUser
 * @property array $statusList
 * @property string $onlineMark
 * @property boolean $onlineStatus
*/

class UserExtend extends Identity
{
    
    public function getOnlineStatus()
    {
        $model = UserOnlineExtend::findOne($this->id);
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
        return '<span class="label label-default">offline</span>';
    }

    public function getPhoneWithoutCode() {
        $phone = $this->clearString($this->phone);
        $phone = ltrim($this->phone, '+7 ');
        return $phone;
    }

    public function getRoleDescription()
    {
        /* @var $model AuthAssignment */
        $model = AuthAssignment::find()
            ->joinWith('itemName')
            ->where(['user_id' => $this->id])
            ->andWhere(['type' => Constants::TYPE_ROLE])
            ->one();
        if ($model) {
            return $model->itemName->description;
        }
        return false;
    }

    public static function getStatusList()
    {
        return [
            Constants::STATUS_BLOCKED => \Yii::t('app', 'Заблокирован'),
            Constants::STATUS_ACTIVE => \Yii::t('app', 'Активен'),
            Constants::STATUS_WAIT =>  \Yii::t('app', 'Не активен'),
        ];
    }

    public function getStatusUser()
    {
        switch ($this->status) {
            case Constants::STATUS_BLOCKED:
                return '<span class="label label-danger">
                            <i class="fa fa-ban" aria-hidden="true"></i> '.$this->getStatusList()[Constants::STATUS_BLOCKED].'</span>';
                break;
            case Constants::STATUS_WAIT:
                return '<span class="label label-warning">
                            <i class="glyphicon glyphicon-hourglass"></i> '.$this->getStatusList()[Constants::STATUS_WAIT].'</span>';
                break;
            case Constants::STATUS_ACTIVE:
                return '<span class="label label-success">
                            <i class="glyphicon glyphicon-ok"></i> '.$this->getStatusList()[Constants::STATUS_ACTIVE].'</span>';
                break;
        }
        return false;
    }

    public function clearString($string)
    {
        return str_replace(['\\', '_', '-', ' ', '(', ')'], '', $string);
    }

    public static function encript($data)
    {
        return utf8_encode(Yii::$app->security->encryptByPassword($data, 'key'));
    }

    public static function decript($data)
    {
        return Yii::$app->security->decryptByPassword(utf8_decode($data), 'key');
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findByPhone($phone)
    {
        $phone = self::clearString($phone);
        return static::findOne(['phone' => $phone]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::find()
            ->where(['email_confirm_token' => $email_confirm_token, 'status' => Constants::STATUS_WAIT])
            ->one();
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = \Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => Constants::STATUS_ACTIVE,
        ]);
    }

    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function setFullPhone($phone)
    {
        $this->full_phone = $this->clearString($phone);
    }

    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
        $this->password_encrypted   = self::encript($password);
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function getImagesMain()
    {
        return  $this->hasMany(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'image_main',
            ])->andWhere(['deleted' => 0]);
    }

    public function getImagesOther()
    {
        return  $this->hasMany(Photo::className(),
            [
                'object_id' => 'id',
                'type' => 'images',
            ])->andWhere(['deleted' => 0]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOnline()
    {
        return $this->hasOne(UserOnlineExtend::className(), ['user_id' => 'id']);
    }
    
     /**
     * @var array EAuth attributes
     */
    public $profile;
 
//    public static function findIdentity($id) {
//        if (Yii::$app->getSession()->has('user-'.$id)) {
//            return new self(Yii::$app->getSession()->get('user-'.$id));
//        }
//        else {
//            return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
//        }
//    }
 
    /**
     * @param \nodge\eauth\ServiceBase $service
     * @return User
     * @throws ErrorException
     */
    public static function createIdentityByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }
         
        $provider_user_id = strval($service->getId());
        $provider_id = UserOauthKey::$social_services_id[$service->getServiceName()] ;
        $user_model = new self;
        
       // $user_model->username = $service->getAttribute('name');
        $user_model->generateAuthKey();
        
        if ($user_model->validate() && $user_model->save()) {
            $user_oauth_model = new UserOauthKey;
            $user_oauth_model->user_id = $user_model->id;
            $user_oauth_model->provider_id = $provider_id;
            $user_oauth_model->provider_user_id = $provider_user_id;
            
            if ($user_oauth_model->validate() && $user_oauth_model->save()) {} 
            else {
                $user_model->delete();
                var_dump($user_oauth_model->errors);
                throw new ErrorException('Create Oauth Identity error');
            }
        }
        else {
          //  var_dump($user_model->errors);
            throw new ErrorException('Create Identity error');
        }
        $id = $user_model->id;
        $attributes = array(
            'id' => $id,
            'username' => $service->getAttribute('name'),
            'auth_key' => $user_model->auth_key,
            'profile' => $service->getAttributes(),
        );

        Yii::$app->getSession()->set('user-'.$id, $attributes);
        return $user_model;
    }
    
//    //поиск зарегистрированного пользователя
//    public function getUserOauth($service)
//    {
//        return $this->hasOne(UserOauthKey::className(), ['id' => 'user_id',$service =>'provide_id']);
//    }
}