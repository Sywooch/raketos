<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $phone
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property integer $balance
 * @property string $image_main
 * @property string $images
 * @property string $directory
 * @property integer $status
 * @property string $password_hash
 * @property string $password_encrypted
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $email_confirm_token
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Photo[] $photos
 * @property UserOnline $userOnline
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance', 'status', 'created_at', 'updated_at','addprofiles'], 'integer'],
            [['username', 'email', 'first_name', 'last_name', 'middle_name', 'password_hash', 'password_encrypted', 'password_reset_token', 'email_confirm_token'], 'string', 'max' => 255],
            [['phone', 'image_main', 'images'], 'string', 'max' => 20],
            [['directory'], 'string', 'max' => 10],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['phone'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'balance' => 'Баланс',
            'image_main' => 'Метка изображения',
            'images' => 'Метка изображения доп фото',
            'directory' => 'Папка пользователя',
            'status' => 'Статус',
            'password_hash' => 'Пароль',
            'password_encrypted' => 'Зашифрованный пароль',
            'auth_key' => 'Ключ авторизации',
            'password_reset_token' => 'Ключ сброса пароля',
            'email_confirm_token' => 'Ключ подтверждения эл. адреса',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'addprofiles' => 'Дополнительные профили' 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOnline()
    {
        return $this->hasOne(UserOnline::className(), ['user_id' => 'id']);
    }
}
