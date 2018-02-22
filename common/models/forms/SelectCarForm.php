<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 27.02.2017
 * Time: 16:22
 */

namespace common\models\forms;

use common\models\CarGeneration;
use common\models\CarMark;
use common\models\CarModel;
use common\models\CarModification;
use common\models\CarSerie;
use common\models\extend\CarModelExtend;
use yii\helpers\ArrayHelper;

class SelectCarForm extends CarModelExtend
{
    public $marka;
    public $generation;
    public $serie;
    public $modification;

    public function rules()
    {
        $items = CarModelExtend::rules();
        $items[] = [['marka', 'generation', 'serie', 'modification'], 'integer'];
        return $items;
    }

    public function attributeLabels()
    {
        $items = CarModelExtend::attributeLabels();
        $items['marka'] = 'Марка';
        $items['generation'] = 'Поколение';
        $items['serie'] = 'Серия';
        $items['modification'] = 'Модификация';
        return $items;
    }

    /*public function getGenerationList()
    {
        $model = CarGeneration::find()->where(['id_car_model' => $this->id_car_model])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_generation', 'name');
    }

    public static function getMarkList()
    {
        $model = CarMark::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_mark', 'name');
    }

    public function getModelList()
    {
        $model = CarModel::find()->where(['id_car_mark' => $this->id_car_mark])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_model', 'name');
    }

    public function getModificationList()
    {
        $model = CarModification::find()->where(['id_car_serie' => $this->serie])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_model', 'name');
    }

    public function getSerieList()
    {
        $model = CarSerie::find()->where(['id_car_generation' => $this->generation])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_serie', 'name');
    }*/
}