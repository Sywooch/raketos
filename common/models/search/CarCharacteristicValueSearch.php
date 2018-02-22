<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\CarCharacteristicValueForm;

/**
 * CarCharacteristicValueSearch represents the model behind the search form about `common\models\forms\CarCharacteristicValueForm`.
 */
class CarCharacteristicValueSearch extends CarCharacteristicValueForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_characteristic_value', 'id_car_characteristic', 'id_car_modification', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['value', 'unit'], 'safe'],
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
        $query = CarCharacteristicValueForm::find();

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
            'id_car_characteristic_value' => $this->id_car_characteristic_value,
            'id_car_characteristic' => $this->id_car_characteristic,
            'id_car_modification' => $this->id_car_modification,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'id_car_type' => $this->id_car_type,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id_car_characteristic_value',
            'value',
            'unit',
            'id_car_characteristic',
            'id_car_modification',
            'date_create',
            'date_update',
            'id_car_type',
        ];
    }
}
