<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\CarEquipmentForm;

/**
 * CarEquipmentSearch represents the model behind the search form about `common\models\forms\CarEquipmentForm`.
 */
class CarEquipmentSearch extends CarEquipmentForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_equipment', 'date_create', 'date_update', 'id_car_modification', 'price_min', 'id_car_type', 'year'], 'integer'],
            [['name'], 'safe'],
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
        $query = CarEquipmentForm::find();

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
            'id_car_equipment' => $this->id_car_equipment,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'id_car_modification' => $this->id_car_modification,
            'price_min' => $this->price_min,
            'id_car_type' => $this->id_car_type,
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id_car_equipment',
            'name',
            'date_create',
            'date_update',
            'id_car_modification',
            'price_min',
            'id_car_type',
            'year',
        ];
    }
}
