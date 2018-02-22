<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\AdsCarCharacteristicForm;

/**
 * AdsCarCharacteristicSearch represents the model behind the search form about `common\models\forms\AdsCarCharacteristicForm`.
 */
class AdsCarCharacteristicSearch extends AdsCarCharacteristicForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number_of_seats', 'width', 'length', 'height', 'wheelbase', 'track_front', 'trunk_volume_min', 'trunk_volume_max', 'rear_track', 'ground_clearance', 'engine_capacity', 'engine_power', 'max_torque', 'number_of_cylinders', 'cylinder_diameter', 'piston_stroke', 'number_of_valves_per_cylinder', 'number_of_gears', 'rear_brakes', 'max_speed', 'curb_weight', 'full_mass', 'fuel_tank_capacity', 'power_reserve', 'eco_standard', 'max_torque_revolutions', 'ads_id'], 'integer'],
            [['engine_type', 'turnover_of_max_power', 'inlet_type', 'cylinder_arrangement', 'fuel_grade', 'front_suspension', 'rear_suspension', 'gearbox_type', 'drive_unit', 'front_brakes'], 'safe'],
            [['acceleration_to_100', 'fuel_consumption_city_for_100', 'fuel_consumption_highway_for_100', 'fuel_consumption_mixed_cycle_for_100'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AdsCarCharacteristicForm::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'number_of_seats' => $this->number_of_seats,
            'width' => $this->width,
            'length' => $this->length,
            'height' => $this->height,
            'wheelbase' => $this->wheelbase,
            'track_front' => $this->track_front,
            'trunk_volume_min' => $this->trunk_volume_min,
            'trunk_volume_max' => $this->trunk_volume_max,
            'rear_track' => $this->rear_track,
            'ground_clearance' => $this->ground_clearance,
            'engine_capacity' => $this->engine_capacity,
            'engine_power' => $this->engine_power,
            'max_torque' => $this->max_torque,
            'number_of_cylinders' => $this->number_of_cylinders,
            'cylinder_diameter' => $this->cylinder_diameter,
            'piston_stroke' => $this->piston_stroke,
            'number_of_valves_per_cylinder' => $this->number_of_valves_per_cylinder,
            'number_of_gears' => $this->number_of_gears,
            'rear_brakes' => $this->rear_brakes,
            'max_speed' => $this->max_speed,
            'acceleration_to_100' => $this->acceleration_to_100,
            'fuel_consumption_city_for_100' => $this->fuel_consumption_city_for_100,
            'fuel_consumption_highway_for_100' => $this->fuel_consumption_highway_for_100,
            'fuel_consumption_mixed_cycle_for_100' => $this->fuel_consumption_mixed_cycle_for_100,
            'curb_weight' => $this->curb_weight,
            'full_mass' => $this->full_mass,
            'fuel_tank_capacity' => $this->fuel_tank_capacity,
            'power_reserve' => $this->power_reserve,
            'eco_standard' => $this->eco_standard,
            'max_torque_revolutions' => $this->max_torque_revolutions,
            'ads_id' => $this->ads_id,
        ]);

        $query->andFilterWhere(['like', 'engine_type', $this->engine_type])
            ->andFilterWhere(['like', 'turnover_of_max_power', $this->turnover_of_max_power])
            ->andFilterWhere(['like', 'inlet_type', $this->inlet_type])
            ->andFilterWhere(['like', 'cylinder_arrangement', $this->cylinder_arrangement])
            ->andFilterWhere(['like', 'fuel_grade', $this->fuel_grade])
            ->andFilterWhere(['like', 'front_suspension', $this->front_suspension])
            ->andFilterWhere(['like', 'rear_suspension', $this->rear_suspension])
            ->andFilterWhere(['like', 'gearbox_type', $this->gearbox_type])
            ->andFilterWhere(['like', 'drive_unit', $this->drive_unit])
            ->andFilterWhere(['like', 'front_brakes', $this->front_brakes]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id',
            'number_of_seats',
            'width',
            'length',
            'height',
            'wheelbase',
            'track_front',
            'trunk_volume_min',
            'trunk_volume_max',
            'rear_track',
            'ground_clearance',
            'engine_type',
            'engine_capacity',
            'engine_power',
            'turnover_of_max_power',
            'max_torque',
            'inlet_type',
            'cylinder_arrangement',
            'number_of_cylinders',
            'cylinder_diameter',
            'piston_stroke',
            'number_of_valves_per_cylinder',
            'fuel_grade',
            'front_suspension',
            'rear_suspension',
            'gearbox_type',
            'number_of_gears',
            'drive_unit',
            'front_brakes',
            'rear_brakes',
            'max_speed',
            'acceleration_to_100',
            'fuel_consumption_city_for_100',
            'fuel_consumption_highway_for_100',
            'fuel_consumption_mixed_cycle_for_100',
            'curb_weight',
            'full_mass',
            'fuel_tank_capacity',
            'power_reserve',
            'eco_standard',
            'max_torque_revolutions',
            'ads_id',
        ];
    }
}
