<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.05.2017
 * Time: 17:03
 */
/* @var $model \common\models\forms\AdsForm */
?>
    <h3 style="padding-top: 5px; padding-bottom: 0; margin-bottom: 5px;">Характеристики</h3>
    <?php
    $modelAdsCarCharacteristic = $model->adsCarCharacteristic;
    ?>
<div class="col-md-6">
    <?= $modelAdsCarCharacteristic->getAttributeLabel('number_of_seats').': '.$modelAdsCarCharacteristic->number_of_seats ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('width').': '.$modelAdsCarCharacteristic->width ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('length').': '.$modelAdsCarCharacteristic->length ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('height').': '.$modelAdsCarCharacteristic->height ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('wheelbase').': '.$modelAdsCarCharacteristic->wheelbase ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('track_front').': '.$modelAdsCarCharacteristic->track_front ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('trunk_volume_min').': '.$modelAdsCarCharacteristic->trunk_volume_min ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('trunk_volume_max').': '.$modelAdsCarCharacteristic->trunk_volume_max ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('rear_track').': '.$modelAdsCarCharacteristic->rear_track ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('ground_clearance').': '.$modelAdsCarCharacteristic->ground_clearance ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('engine_type').': '.$modelAdsCarCharacteristic->engine_type ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('engine_capacity').': '.$modelAdsCarCharacteristic->engine_capacity ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('engine_power').': '.$modelAdsCarCharacteristic->engine_power ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('turnover_of_max_power').': '.$modelAdsCarCharacteristic->turnover_of_max_power ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('max_torque').': '.$modelAdsCarCharacteristic->max_torque ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('inlet_type').': '.$modelAdsCarCharacteristic->inlet_type ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('cylinder_arrangement').': '.$modelAdsCarCharacteristic->cylinder_arrangement ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('number_of_cylinders').': '.$modelAdsCarCharacteristic->number_of_cylinders ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('cylinder_diameter').': '.$modelAdsCarCharacteristic->cylinder_diameter ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('piston_stroke').': '.$modelAdsCarCharacteristic->piston_stroke ?><br>
</div>
<div class="col-md-6">
    <?= $modelAdsCarCharacteristic->getAttributeLabel('number_of_valves_per_cylinder').': '.$modelAdsCarCharacteristic->number_of_valves_per_cylinder ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('fuel_grade').': '.$modelAdsCarCharacteristic->fuel_grade ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('front_suspension').': '.$modelAdsCarCharacteristic->front_suspension ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('rear_suspension').': '.$modelAdsCarCharacteristic->rear_suspension ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('gearbox_type').': '.$modelAdsCarCharacteristic->gearbox_type ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('drive_unit').': '.$modelAdsCarCharacteristic->drive_unit ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('front_brakes').': '.$modelAdsCarCharacteristic->front_brakes ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('rear_brakes').': '.$modelAdsCarCharacteristic->rear_brakes ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('max_speed').': '.$modelAdsCarCharacteristic->max_speed ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('acceleration_to_100').': '.$modelAdsCarCharacteristic->acceleration_to_100 ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('fuel_consumption_city_for_100').': '.$modelAdsCarCharacteristic->fuel_consumption_city_for_100 ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('fuel_consumption_highway_for_100').': '.$modelAdsCarCharacteristic->fuel_consumption_highway_for_100 ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('fuel_consumption_mixed_cycle_for_100').': '.$modelAdsCarCharacteristic->fuel_consumption_mixed_cycle_for_100 ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('curb_weight').': '.$modelAdsCarCharacteristic->curb_weight ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('full_mass').': '.$modelAdsCarCharacteristic->full_mass ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('fuel_tank_capacity').': '.$modelAdsCarCharacteristic->fuel_tank_capacity ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('power_reserve').': '.$modelAdsCarCharacteristic->power_reserve ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('eco_standard').': '.$modelAdsCarCharacteristic->eco_standard ?><br>
    <?= $modelAdsCarCharacteristic->getAttributeLabel('max_torque_revolutions').': '.$modelAdsCarCharacteristic->max_torque_revolutions ?><br>

    <?php
    /*$string = '<h3 style="padding-top: 5px; padding-bottom: 0; margin-bottom: 5px;">Характеристики</h3>';
    $characteristicValues = $model->characteristicValueList;
    foreach ($characteristicValues as $characteristicValue) {
        // @var $characteristicValue \common\models\CarCharacteristicValue
        if ($characteristicValue->unit) {
            $string .= $characteristicValue->characteristic->name.': '.$characteristicValue->value.' ('.$characteristicValue->unit.')<br>';
        } else {
            $string .= $characteristicValue->characteristic->name.': '.$characteristicValue->value.'<br>';
        }
    }
    echo $string;*/
    ?>
</div>
