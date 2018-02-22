<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\CarOptionValueForm;

/**
 * CarOptionValueSearch represents the model behind the search form about `common\models\forms\CarOptionValueForm`.
 */
class CarOptionValueSearch extends CarOptionValueForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_option_value', 'is_base', 'id_car_option', 'id_car_equipment', 'date_create', 'date_update', 'id_car_type'], 'integer'],
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
        $query = CarOptionValueForm::find();

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
            'id_car_option_value' => $this->id_car_option_value,
            'is_base' => $this->is_base,
            'id_car_option' => $this->id_car_option,
            'id_car_equipment' => $this->id_car_equipment,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'id_car_type' => $this->id_car_type,
        ]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id_car_option_value',
            'is_base',
            'id_car_option',
            'id_car_equipment',
            'date_create',
            'date_update',
            'id_car_type',
        ];
    }
}
