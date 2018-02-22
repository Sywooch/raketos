<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\CarGenerationForm;

/**
 * CarGenerationSearch represents the model behind the search form about `common\models\forms\CarGenerationForm`.
 */
class CarGenerationSearch extends CarGenerationForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_generation', 'id_car_model', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name', 'year_begin', 'year_end'], 'safe'],
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
        $query = CarGenerationForm::find();

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
            'id_car_generation' => $this->id_car_generation,
            'id_car_model' => $this->id_car_model,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'id_car_type' => $this->id_car_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'year_begin', $this->year_begin])
            ->andFilterWhere(['like', 'year_end', $this->year_end]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id_car_generation',
            'name',
            'id_car_model',
            'year_begin',
            'year_end',
            'date_create',
            'date_update',
            'id_car_type',
        ];
    }
}
