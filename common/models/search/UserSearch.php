<?php

namespace common\models\search;

use common\models\extend\UserExtend;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\forms\UserForm;

/**
 * UserSearch represents the model behind the search form about `common\models\forms\UserForm`.
 */
class UserSearch extends UserForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'balance', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'phone', 'email', 'first_name', 'last_name', 'middle_name', 'image_main', 'images', 'directory', 'password_hash', 'password_encrypted', 'auth_key', 'password_reset_token', 'email_confirm_token'], 'safe'],
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
    public function search($params, $getCreator = true)
    {
        $query = UserForm::find()->joinWith('authAssignments');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 10,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!$getCreator) {
            $query->andFilterWhere(['!=', 'auth_assignment.item_name', 'creator']);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'balance' => $this->balance,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'image_main', $this->image_main])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'directory', $this->directory])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_encrypted', $this->password_encrypted])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email_confirm_token', $this->email_confirm_token]);

        return $dataProvider;
    }

    // указываются свойства, которые нужно выводить в файлы
    public function exportFields()
    {
        return [
            'id',
            'username',
            'phone',
            'email',
            'first_name',
            'last_name',
            'middle_name',
            'balance',
            'image_main',
            'images',
            'directory',
            'status',
            'password_hash',
            'password_encrypted',
            'auth_key',
            'password_reset_token',
            'email_confirm_token',
            'created_at',
            'updated_at'
        ];
    }
}
