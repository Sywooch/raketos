<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\GeoRegionForm;

/**
 * GeoRegionSearch represents the model behind the search form about `common\models\forms\GeoRegionForm`.
 */
class GeoRegionSearch extends GeoRegionForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['iso', 'country', 'name_ru', 'name_en', 'timezone', 'okato'], 'safe'],
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
        $query = GeoRegionForm::find();

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
        ]);

        $query->andFilterWhere(['like', 'iso', $this->iso])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'timezone', $this->timezone])
            ->andFilterWhere(['like', 'okato', $this->okato]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id',
            'iso',
            'country',
            'name_ru',
            'name_en',
            'timezone',
            'okato'
        ];
    }
}
