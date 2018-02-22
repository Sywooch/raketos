<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use phpnt\cropper\models\Photo;

/**
 * PhotoSearch represents the model behind the search form about `phpnt\cropper\models\Photo`.
 */
class PhotoSearch extends Photo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'user_id', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['file', 'file_small', 'type'], 'safe'],
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
        $query = Photo::find();

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
            'object_id' => $this->object_id,
            'user_id' => $this->user_id,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'file_small', $this->file_small])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }

    public function exportFields()
    {
        return [
            'id',
            'file',
            'file_small',
            'type',
            'object_id',
            'user_id',
            'deleted',
            'created_at',
            'updated_at'
        ];
    }
}
