<?php

namespace frontend\modules\personals\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\personals\models\Personal;

/**
 * PersonalSearch represents the model behind the search form about `frontend\models\Personal`.
 */
class PersonalSearch extends Personal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'group_id', 'depart_id'], 'integer'],
            [['cid', 'pname', 'fname', 'lname', 'age', 'religion_id', 'bloodgroup', 'marrystatus_id', 'birthdate', 'address', 'province_id', 'amphur_id', 'district_id', 'zip_code', 'lat', 'lng', 'phone', 'email', 'skill', 'education_id', 'token_upload', 'img', 'startwork_date', 'position_id', 'persontype_id', 'created_at', 'updated_at'], 'safe'],
            [['salary'], 'number'],
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
        $query = Personal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'startwork_date' => $this->startwork_date,
            'salary' => $this->salary,
            'group_id' => $this->group_id,
            'depart_id' => $this->depart_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'pname', $this->pname])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'religion_id', $this->religion_id])
            ->andFilterWhere(['like', 'bloodgroup', $this->bloodgroup])
            ->andFilterWhere(['like', 'marrystatus_id', $this->marrystatus_id])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'amphur_id', $this->amphur_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'skill', $this->skill])
            ->andFilterWhere(['like', 'education_id', $this->education_id])
            ->andFilterWhere(['like', 'token_upload', $this->token_upload])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'position_id', $this->position_id])
            ->andFilterWhere(['like', 'persontype_id', $this->persontype_id]);

        return $dataProvider;
    }
}
