<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 07.02.2017
 * Time: 22:22
 */

namespace common\models\extend;


use common\models\CarCharacteristicValue;
use common\models\CarEquipment;
use common\models\CarGeneration;
use common\models\CarMark;
use common\models\CarModel;
use common\models\CarModification;
use common\models\CarSerie;
use yii\helpers\ArrayHelper;
/**
 * @property array $haracteristicValueList
 * @property array $equipmentList
 * @property array $generationList
 * @property array $markList
 * @property array $modelList
 * @property array $modificationList
 * @property array $serieList
*/
class CarModelExtend extends CarModel
{
    public function getGenerationList()
    {
        $model = CarGeneration::find()->where(['id_car_model' => $this->id_car_model])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_generation', 'name');
    }

    public function getEquipmentList()
    {
        $models = CarEquipment::find()->where(['id_car_modification' => $this->modification])->all();
        return $models;
    }

    public function getCharacteristicValueList()
    {
        $models = CarCharacteristicValue::find()->where(['id_car_modification' => $this->modification])->all();
        return $models;
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
        return ArrayHelper::map($model, 'id_car_modification', 'name');
    }

    public function getSerieList()
    {
        $model = CarSerie::find()->where(['id_car_generation' => $this->generation])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($model, 'id_car_serie', 'name');
    }
}