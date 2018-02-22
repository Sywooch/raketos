<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\RatingCalculateForm;

/**
 * RatingCalculateSearch represents the model behind the search form about `common\models\forms\RatingCalculateForm`.
 */
class RatingCalculateSearch extends RatingCalculateForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rating_calculate'], 'integer'],
            [['mileage', 'year', 'state', 'rating', 'price', 'formula'], 'safe'],
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
        $query = RatingCalculateForm::find();

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
            'id_rating_calculate' => $this->id_rating_calculate,
        ]);

        $query->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'formula', $this->formula]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id_rating_calculate',
            'mileage',
            'year',
            'state',
            'rating',
            'price',
            'formula',
        ];
    }
}
