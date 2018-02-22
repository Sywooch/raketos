<?php

namespace common\models\search;

use common\models\Constants;
use common\models\extend\MainFilterExtend;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\AdsForm;

/**
 * AdsSearch represents the model behind the search form about `common\models\forms\AdsForm`.
 */
class AdsSearch extends AdsForm
{
    public $acceleration_to_100_from;
    public $acceleration_to_100_to;
    public $capacity_from;
    public $capacity_to;
    public $curb_weight_from;
    public $curb_weight_to;
    public $fuel_consumption_city_for_100_from;
    public $fuel_consumption_city_for_100_to;
    public $fuel_consumption_highway_for_100_from;
    public $fuel_consumption_highway_for_100_to;
    public $fuel_consumption_mixed_cycle_for_100_from;
    public $fuel_consumption_mixed_cycle_for_100_to;
    public $fuel_tank_capacity_from;
    public $fuel_tank_capacity_to;
    public $ground_clearance_from;
    public $ground_clearance_to;
    public $length_from;
    public $length_to;
    public $max_speed_from;
    public $max_speed_to;
    public $max_torque_from;
    public $max_torque_to;
    public $mileage_from;
    public $mileage_to;
    public $number_of_seats_from;
    public $number_of_seats_to;
    public $price_from;
    public $price_to;
    public $power_from;
    public $power_to;
    public $height_from;
    public $height_to;
    public $rear_track_from;
    public $rear_track_to;
    public $track_front_from;
    public $track_front_to;
    public $trunk_volume_min_from;
    public $trunk_volume_min_to;
    public $trunk_volume_max_from;
    public $trunk_volume_max_to;
    public $turnover_of_max_power_from;
    public $turnover_of_max_power_to;
    public $wheelbase_from;
    public $wheelbase_to;
    public $width_from;
    public $width_to;
    public $year_from;
    public $year_to;

    public $is_picture;

    public $number_of_seats;
    public $engine_type;
    public $inlet_type;

    public $drive_unit;
    public $eco_standard;
    public $fuel_grade;
    public $type;
    public $gearbox_type;
    public $number_of_gears;
    public $cylinder_arrangement;
    public $number_of_cylinders;
    public $number_of_valves_per_cylinder;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mileage', 'power_ptc', 'doc', 'broken', 'work', 'is_picture', 'price', 'exchange', 'temp', 'status', 'created_at', 'updated_at', 
                'year', 'rating', 'is_paid', 'end_paid', 'tariff_id'], 'integer'],
            //[['mileage_rus',], 'boolean'],
            [['id', 'id_car_mark', 'id_car_model', 'id_car_generation', 'id_car_serie', 'id_car_modification','user_id', 'city_id'],'integer','except' => 'admin'],
            [['id', 'id_car_mark', 'id_car_model', 'id_car_generation', 'id_car_serie', 'id_car_modification','user_id', 'city_id'],'each','rule' => ['integer'], 'on' => 'admin'],
            [['drive_unit', 'state', 'engine_type', 'inlet_type', 'gearbox_type', 'fuel_grade', 'number_of_gears', 'cylinder_arrangement', 'number_of_cylinders', 'number_of_valves_per_cylinder', 'color'], 'each', 'rule' => ['safe']],
            [['vin', 'num_reg', 'desc', 'address', 'image_main', 'images', 'type', /*'engine_type', 'inlet_type', 'gearbox_type', 'fuel_grade',*/
        'eco_standard', /* 'cylinder_arrangement', 'number_of_cylinders', 'number_of_valves_per_cylinder', 'color' */], 'safe'],
            [['price_from', 'price_to', 'mileage_from', 'mileage_to', 'capacity_from', 'capacity_to', 'number_of_seats', /* 'number_of_gears', */
            'number_of_seats_from', 'number_of_seats_to', 'width_from', 'width_to', 'length_from', 'length_to', 'height_from', 'height_to', 'ground_clearance_from',
            'ground_clearance_to', 'wheelbase_from', 'wheelbase_to', 'track_front_from', 'track_front_to', 'rear_track_from', 'rear_track_to',
            'trunk_volume_min_from', 'trunk_volume_min_to', 'trunk_volume_max_from', 'trunk_volume_max_to', 'turnover_of_max_power_from', 'turnover_of_max_power_to',
                'max_torque_from', 'max_torque_to', 'curb_weight_from', 'curb_weight_to', 'fuel_tank_capacity_from', 'fuel_tank_capacity_to',
            'acceleration_to_100_from', 'acceleration_to_100_to', 'fuel_consumption_city_for_100_from', 'fuel_consumption_city_for_100_to', 'fuel_consumption_highway_for_100_from',
            'fuel_consumption_highway_for_100_to', 'fuel_consumption_mixed_cycle_for_100_from', 'fuel_consumption_mixed_cycle_for_100_to'], 'integer'],
            [['year_from', 'year_to'], 'integer', 'min' => 1900, 'max' => date('Y')],
            [['power_from', 'power_to'], 'integer', 'min' => 0, 'max' => 999],
            [['price_from', 'price_to'], 'integer', 'min' => 0, 'max' => 100000000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        $scenarios = Model::scenarios();
        $scenarios['admin'] = ['id', 'id_car_mark', 'id_car_model', 'id_car_generation', 
                                'id_car_serie', 'id_car_modification','user_id', 'city_id','status','is_paid'];
        return $scenarios;
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
        $this->load($params);

        $query = AdsForm::find()->distinct()
            ->where(['temp' => false]);

        if (!Yii::$app->request->get('sort')) {
            $query->orderBy(['ads.id' => SORT_DESC]);
        }

        if ($this->type == null) {
            $query->leftJoin('ads_car_characteristic', 'ads_car_characteristic.ads_id = ads.id');
            $query->leftJoin('car_serie', 'car_serie.id_car_serie = ads.id');
        } else {
            //$query->leftJoin('ads_car_characteristic', 'ads_car_characteristic.id = ads.id');
            //$query->leftJoin('car_serie', 'car_serie.id_car_serie = ads.id');
            $query->joinWith('adsCarCharacteristic');
            $query->joinWith('serie');
        };




        /*if (Yii::$app->controller->id == 'users-car' && Yii::$app->controller->action->id == 'search') {
            $query->joinWith('adsCarCharacteristic');
            $query->joinWith('serie');
        };*/

        /*if (Yii::$app->controller->id == 'users-car' && Yii::$app->controller->action->id == 'search') {
            $query->joinWith('adsCarCharacteristic');
            $query->joinWith('serie');
        }

        if (!Yii::$app->controller->id == 'site' && !Yii::$app->controller->action->id == 'top') {
            $query->orderBy(['ads.id' => SORT_DESC]);
        }

        if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') {
            $query->orderBy(['ads.id' => SORT_DESC]);
        }

        if (!Yii::$app->request->get('sort')) {
            //$query->orderBy(['ads.id' => SORT_DESC]);
        }*/

        /*if ($this->end_paid) {
            //dd(111);
            $query->limit(4);
        }*/

        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'defaultPageSize' => 8,
                ]
            ]);

        if ($this->type) {
            switch ($this->type) {
                case 'forest':
                    $model = MainFilterExtend::findOne(['name' => $this->type]);
                    $bodyTypes = explode(', ', $model->body);
                    $query = $this->setQuery($query, $bodyTypes, $model);
                    break;
                case 'city':
                    $model = MainFilterExtend::findOne(['name' => $this->type]);
                    $bodyTypes = explode(', ', $model->body);
                    $query = $this->setQuery($query, $bodyTypes, $model);
                    break;
                case 'family':
                    $model = MainFilterExtend::findOne(['name' => $this->type]);
                    $bodyTypes = explode(', ', $model->body);
                    $query = $this->setQuery($query, $bodyTypes, $model);
                    break;
                case 'travel':
                    $model = MainFilterExtend::findOne(['name' => $this->type]);
                    $bodyTypes = explode(', ', $model->body);
                    $query = $this->setQuery($query, $bodyTypes, $model);
                    break;
            }
        }
        //dd(555);

        $range = Yii::$app->request->get('range');
        if ($range) {
            $range_array = explode(";", $range);
            $this->price_from = $range_array[0];
            $this->price_to = $range_array[1];
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*if ($this->is_picture) {
            //$query->innerJoin('photo', 'photo.object_id = ads.id')
            $query->innerJoin('photo', 'photo.object_id = ads.id')
                ->andWhere(['deleted' => 0])/*->all();
            //$query->andFilterWhere(['mileage_rus' => 1]);
            //dd($model);
        };*/

        //dd(555);
        $this->city_id = !$this->city_id ? \Yii::$app->session->get("_cityUrl") : $this->city_id;
        $this->city_id = $this->city_id == -1 ? '' : $this->city_id;

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ads.id_car_mark' => $this->id_car_mark,
            'ads.id_car_model' => $this->id_car_model,
            'ads.id_car_generation' => $this->id_car_generation,
            'ads.id_car_serie' => $this->id_car_serie,
            'ads.id_car_modification' => $this->id_car_modification,
            'mileage' => $this->mileage,
            'power_ptc' => $this->power_ptc,
            //'mileage_rus' => $this->mileage_rus,
            //'doc' => $this->doc,
            //'broken' => $this->broken,
            //'work' => $this->work,
            'price' => $this->price,
            //'exchange' => $this->exchange,
            'user_id' => $this->user_id,
            // Если явно не указан город, то вывод объявлений из города посетителя
            'city_id' => $this->city_id,
            'temp' => $this->temp,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'year' => $this->year,
            'rating' => $this->rating,
            'is_paid' => $this->is_paid,
            'color' => $this->color,            
            //'end_paid' => $this->end_paid,
            'state' => $this->state,
            'tariff_id' => $this->tariff_id,
            'ads_car_characteristic.number_of_seats' => $this->number_of_seats,
            'ads_car_characteristic.inlet_type' => $this->inlet_type,
            'ads_car_characteristic.gearbox_type' => $this->gearbox_type,
            'ads_car_characteristic.eco_standard' => $this->eco_standard,
            'ads_car_characteristic.number_of_gears' => $this->number_of_gears,
            'ads_car_characteristic.cylinder_arrangement' => $this->cylinder_arrangement,
            'ads_car_characteristic.number_of_cylinders' => $this->number_of_cylinders,
            'ads_car_characteristic.number_of_valves_per_cylinder' => $this->number_of_valves_per_cylinder,
            'ads_car_characteristic.drive_unit' => $this->drive_unit,
        ]);

        if ($this->mileage_rus) {
            $query->andFilterWhere(['mileage_rus' => 1]);
        };

        if ($this->doc) {
            $query->andFilterWhere(['doc' => 1]);
        };

        if ($this->broken) {
            $query->andFilterWhere(['broken' => 1]);
        };

        if ($this->work) {
            $query->andFilterWhere(['work' => 1]);
        };

        if ($this->exchange) {
            $query->andFilterWhere(['exchange' => 1]);
        };

        $query->andFilterWhere(['like', 'vin', $this->vin])
            ->andFilterWhere(['like', 'num_reg', $this->num_reg])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'image_main', $this->image_main])
            ->andFilterWhere(['or ilike', 'engine_type', $this->engine_type])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['or ilike', 'ads_car_characteristic.fuel_grade', $this->fuel_grade]);

        if ($this->acceleration_to_100_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.acceleration_to_100', intval($this->acceleration_to_100_from)]);
        }
        if ($this->acceleration_to_100_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.acceleration_to_100', intval($this->acceleration_to_100_to)]);
        }
        
        if ($this->curb_weight_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.curb_weight', intval($this->curb_weight_from)]);
        }
        if ($this->curb_weight_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.curb_weight', intval($this->curb_weight_to)]);
        }

        if ($this->fuel_consumption_mixed_cycle_for_100_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_mixed_cycle_for_100', intval($this->fuel_consumption_mixed_cycle_for_100_from)]);
        }
        if ($this->fuel_consumption_mixed_cycle_for_100_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.fuel_consumption_mixed_cycle_for_100', intval($this->fuel_consumption_mixed_cycle_for_100_to)]);
        }

        if ($this->fuel_consumption_highway_for_100_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_highway_for_100', intval($this->fuel_consumption_highway_for_100_from)]);
        }
        if ($this->fuel_consumption_highway_for_100_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.fuel_consumption_highway_for_100', intval($this->fuel_consumption_highway_for_100_to)]);
        }

        if ($this->fuel_consumption_city_for_100_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_city_for_100', intval($this->fuel_consumption_city_for_100_from)]);
        }
        if ($this->fuel_consumption_city_for_100_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.fuel_consumption_city_for_100', intval($this->fuel_consumption_city_for_100_to)]);
        }

        if ($this->fuel_tank_capacity_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_tank_capacity', intval($this->fuel_tank_capacity_from)]);
        }
        if ($this->fuel_tank_capacity_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.fuel_tank_capacity', intval($this->fuel_tank_capacity_to)]);
        }

        if ($this->ground_clearance_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.ground_clearance', intval($this->ground_clearance_from)]);
        }
        if ($this->ground_clearance_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.ground_clearance', intval($this->ground_clearance_to)]);
        }

        if ($this->number_of_seats_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.number_of_seats', intval($this->number_of_seats_from)]);
        }
        if ($this->number_of_seats_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.number_of_seats', intval($this->number_of_seats_to)]);
        }

        if ($this->price_from) {
            $query->andFilterWhere(['>=', 'price', $this->price_from]);
        }

        if ($this->price_to && $this->price_to != '5000000') {
            $query->andFilterWhere(['<=', 'price', $this->price_to]);
        }

        if ($this->length_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.length', intval($this->length_from)]);
        }
        if ($this->length_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.length', intval($this->length_to)]);
        }

        if ($this->max_speed_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.max_speed', intval($this->max_speed_from)]);
        }
        if ($this->max_speed_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.max_speed', intval($this->max_speed_to)]);
        }

        if ($this->max_torque_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.max_torque', intval($this->max_torque_from)]);
        }
        if ($this->max_torque_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.max_torque', intval($this->max_torque_to)]);
        }

        if ($this->mileage_from) {
            $query->andFilterWhere(['>=', 'mileage', $this->mileage_from]);
        }
        if ($this->mileage_to) {
            $query->andFilterWhere(['<=', 'mileage', $this->mileage_to]);
        }

        if ($this->height_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.height', intval($this->height_from)]);
        }
        if ($this->height_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.height', intval($this->height_to)]);
        }

        if ($this->year_from) {
            $query->andFilterWhere(['>=', 'year', $this->year_from]);
        }
        if ($this->year_to) {
            $query->andFilterWhere(['<=', 'year', $this->year_to]);
        }

        if ($this->power_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.engine_power', intval($this->power_from)]);
        }
        if ($this->power_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.engine_power', intval($this->power_to)]);
        }

        if ($this->capacity_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.engine_capacity', intval($this->capacity_from)]);
        }
        if ($this->capacity_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.engine_capacity', intval($this->capacity_to)]);
        }

        //if ($this->fuel_grade) {
        //    $query->andFilterWhere(['ilike', 'ads_car_characteristic.fuel_grade', $this->fuel_grade]);
        //}

        if ($this->end_paid) {
            $query->andFilterWhere(['>=', 'end_paid', $this->end_paid]);
        }

        if ($this->rear_track_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.rear_track', intval($this->rear_track_from)]);
        }
        if ($this->rear_track_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.rear_track', intval($this->rear_track_to)]);
        }

        if ($this->track_front_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.track_front', intval($this->track_front_from)]);
        }
        if ($this->track_front_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.track_front', intval($this->track_front_to)]);
        }

        if ($this->trunk_volume_min_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.trunk_volume_min', intval($this->trunk_volume_min_from)]);
        }
        if ($this->trunk_volume_min_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.trunk_volume_min', intval($this->trunk_volume_min_to)]);
        }

        if ($this->trunk_volume_max_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.trunk_volume_max', intval($this->trunk_volume_max_from)]);
        }
        if ($this->trunk_volume_max_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.trunk_volume_max', intval($this->trunk_volume_max_to)]);
        }

        if ($this->turnover_of_max_power_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.turnover_of_max_power', intval($this->turnover_of_max_power_from)]);
        }
        if ($this->turnover_of_max_power_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.turnover_of_max_power', intval($this->turnover_of_max_power_to)]);
        }


        if ($this->wheelbase_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.wheelbase', intval($this->wheelbase_from)]);
        }
        if ($this->wheelbase_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.wheelbase', intval($this->wheelbase_to)]);
        }

        if ($this->width_from) {
            $query->andFilterWhere(['>=', 'ads_car_characteristic.width', intval($this->width_from)]);
        }
        if ($this->width_to) {
            $query->andFilterWhere(['<=', 'ads_car_characteristic.width', intval($this->width_to)]);
        }

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchPaid($params)
    {
        $query = AdsForm::find()->distinct()
            ->joinWith('adsCarCharacteristic')
            ->joinWith('serie')
            ->innerJoinWith('invoices')
            ->where(['temp' => 0]);
            //->orderBy(['invoice.id' => SORT_DESC]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    // количество пунктов на странице
                    'defaultPageSize' => 8,
                ]
            ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // Если явно не указан город, то вывод объявлений из города посетителя
        $query->andFilterWhere([
            'ads.status' => $this->status,
            'city_id' => !$this->city_id ? \Yii::$app->session->get("_cityUrl") : $this->city_id,            
        ]);
        

        return $dataProvider;
    }

    private function setQuery($query, $bodyTypes, $model) {
        /* @var $model MainFilterExtend */
        foreach ($bodyTypes as $key => $value) {
            if ($value != 'GT') {
                $value = mb_substr( $value, 1);
            }
            $items[$key] = $value;
        }

        switch (count($bodyTypes)) {
            case 0:
                break;
            case 1:
                $query->where(['like', 'car_serie.name', $items[0]]);
                break;
            case 2:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]]);
                break;
            case 3:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]]);
                break;
            case 4:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]]);
                break;
            case 5:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]])
                    ->orWhere(['like', 'car_serie.name', $items[4]]);
                break;
            case 6:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]])
                    ->orWhere(['like', 'car_serie.name', $items[4]])
                    ->orWhere(['like', 'car_serie.name', $items[5]]);
                break;
            case 7:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]])
                    ->orWhere(['like', 'car_serie.name', $items[4]])
                    ->orWhere(['like', 'car_serie.name', $items[5]])
                    ->orWhere(['like', 'car_serie.name', $items[6]]);
                break;
            case 8:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]])
                    ->orWhere(['like', 'car_serie.name', $items[4]])
                    ->orWhere(['like', 'car_serie.name', $items[5]])
                    ->orWhere(['like', 'car_serie.name', $items[6]])
                    ->orWhere(['like', 'car_serie.name', $items[7]]);
                break;
            case 9:
                $query->where(['like', 'car_serie.name', $items[0]])
                    ->orWhere(['like', 'car_serie.name', $items[1]])
                    ->orWhere(['like', 'car_serie.name', $items[2]])
                    ->orWhere(['like', 'car_serie.name', $items[3]])
                    ->orWhere(['like', 'car_serie.name', $items[4]])
                    ->orWhere(['like', 'car_serie.name', $items[5]])
                    ->orWhere(['like', 'car_serie.name', $items[6]])
                    ->orWhere(['like', 'car_serie.name', $items[7]])
                    ->orWhere(['like', 'car_serie.name', $items[8]]);
                break;
        }

        if ($model->number_of_seats)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.number_of_seats', intval($model->number_of_seats)]);
        if ($model->width)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.width', intval($model->width)]);
        if ($model->length)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.length', intval($model->length)]);
        if ($model->height)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.height', intval($model->height)]);
        if ($model->wheelbase)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.wheelbase', intval($model->wheelbase)]);
        if ($model->track_front)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.track_front', intval($model->track_front)]);
        if ($model->trunk_volume_min)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.trunk_volume_min', intval($model->trunk_volume_min)]);
        if ($model->trunk_volume_max)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.trunk_volume_max', intval($model->trunk_volume_max)]);
        if ($model->rear_track)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.rear_track', intval($model->rear_track)]);
        if ($model->ground_clearance)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.ground_clearance', intval($model->ground_clearance)]);
        if ($model->engine_type)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.engine_type', intval($model->engine_type)]);
        if ($model->engine_capacity)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.engine_capacity', intval($model->engine_capacity)]);
        if ($model->engine_power)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.engine_power', intval($model->engine_power)]);
        if ($model->turnover_of_max_power)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.turnover_of_max_power', intval($model->turnover_of_max_power)]);
        if ($model->max_torque)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.max_torque', intval($model->max_torque)]);
        if ($model->inlet_type)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.inlet_type', intval($model->inlet_type)]);
        if ($model->cylinder_arrangement)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.cylinder_arrangement', intval($model->cylinder_arrangement)]);
        if ($model->number_of_cylinders)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.number_of_cylinders', intval($model->number_of_cylinders)]);
        if ($model->cylinder_diameter)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.cylinder_diameter', intval($model->cylinder_diameter)]);
        if ($model->piston_stroke)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.piston_stroke', intval($model->piston_stroke)]);
        if ($model->number_of_valves_per_cylinder)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.number_of_valves_per_cylinder', intval($model->number_of_valves_per_cylinder)]);
        //TODO Сделать нормально
        //if ($model->fuel_grade)
        //    $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_grade', intval($model->fuel_grade)]);
        if ($model->front_suspension)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.front_suspension', intval($model->front_suspension)]);
        if ($model->rear_suspension)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.rear_suspension', intval($model->rear_suspension)]);
        if ($model->gearbox_type)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.gearbox_type', intval($model->gearbox_type)]);
        if ($model->number_of_gears)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.number_of_gears', intval($model->number_of_gears)]);
        if ($model->drive_unit) {
            $driveUnits = explode(', ', $model->drive_unit);
            /* @var , $model MainFilterExtend */
            foreach ($driveUnits as $key => $value) {
                $value = mb_substr($value, 1);
                $items[$key] = $value;
            }
            switch (count($bodyTypes)) {
                case 0:
                    break;
                case 1:
                    $query->where(['like', 'ads_car_characteristic.drive_unit', $items[0]]);
                    break;
                case 2:
                    $query->where(['like', 'ads_car_characteristic.drive_unit', $items[0]])
                        ->orWhere(['like', 'ads_car_characteristic.drive_unit', $items[1]]);
                    break;
            }
        }
        //$query->andFilterWhere(['>=', 'ads_car_characteristic.drive_unit', intval($model->drive_unit)]);
        if ($model->front_brakes)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.front_brakes', intval($model->front_brakes)]);
        if ($model->rear_brakes)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.rear_brakes', intval($model->rear_brakes)]);
        if ($model->max_speed)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.max_speed', intval($model->max_speed)]);
        if ($model->acceleration_to_100)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.acceleration_to_100', intval($model->acceleration_to_100)]);
        if ($model->fuel_consumption_city_for_100)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_city_for_100', intval($model->fuel_consumption_city_for_100)]);
        if ($model->fuel_consumption_highway_for_100)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_highway_for_100', intval($model->fuel_consumption_highway_for_100)]);
        if ($model->fuel_consumption_mixed_cycle_for_100)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_consumption_mixed_cycle_for_100', intval($model->fuel_consumption_mixed_cycle_for_100)]);
        if ($model->curb_weight)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.curb_weight', intval($model->curb_weight)]);
        if ($model->full_mass)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.full_mass', intval($model->full_mass)]);
        if ($model->fuel_tank_capacity)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.fuel_tank_capacity', intval($model->fuel_tank_capacity)]);
        if ($model->power_reserve)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.power_reserve', intval($model->power_reserve)]);
        if ($model->eco_standard)
            $query->andFilterWhere(['like', 'ads_car_characteristic.eco_standard', intval($model->eco_standard)]);
        if ($model->max_torque_revolutions)
            $query->andFilterWhere(['>=', 'ads_car_characteristic.max_torque_revolutions', intval($model->max_torque_revolutions)]);

        return $query;
    }


    public function exportFields()
    {
        return [
            'id_car_mark',
            'id_car_model',
            'id_car_generation',
            'id_car_serie',
            'id_car_modification',
            'mileage',
            'power_ptc',
            'mileage_rus',
            'doc',
            'broken',
            'work',
            'vin',
            'num_reg',
            'desc',
            'price',
            'exchange',
            'user_id',
            'city_id',
            'address',
            'image_main',
            'images',
            'temp',
            'status',
            'year',
            'color',
            'state',
            'rating',
            'is_paid',
            'end_paid',
            'tariff_id',
            'created_at',
            'updated_at',
        ];
    }
}
