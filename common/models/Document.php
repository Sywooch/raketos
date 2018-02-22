<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $name
 * @property string $meta_keys
 * @property string $meta_desc
 * @property string $text
 * @property string $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text', 'type'], 'required'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'meta_keys', 'meta_desc', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'meta_keys' => 'Мета ключи',
            'meta_desc' => 'Мета описание',
            'text' => 'Контент',
            'type' => 'Тип документа',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }
}
