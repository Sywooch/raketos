<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 11.05.2017
 * Time: 10:48
 */

namespace common\models\forms;


use yii\base\Model;

class YaForm extends Model
{
    public $customerNumber = 1;
    public $shopId = 132979;
    public $scid = 553250;
    public $password = 'vD2lz45e';
    public $sum;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopId', 'scid', 'password', 'sumt'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    /*public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
        ];
    }*/
}