<?php

namespace frontend\modules\reportonline\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\reportonline\models\Reportonline;

/**
 * ReportonlineSearch represents the model behind the search form about `frontend\modules\reportonline\models\Reportonline`.
 */
class ReportonlineSearch extends Reportonline
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['reporttype_id', 'name', 'details', 'image', 'files', 'order_date', 'defined_date', 'link_id', 'finish_date', 'report_status_id', 'create_date', 'modify_date', 'token_upload'], 'safe'],
            [['unit'], 'number'],
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
        $query = Reportonline::find();

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
            'order_date' => $this->order_date,
            'defined_date' => $this->defined_date,
            'unit' => $this->unit,
            'finish_date' => $this->finish_date,
            'create_date' => $this->create_date,
            'modify_date' => $this->modify_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'reporttype_id', $this->reporttype_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'link_id', $this->link_id])
            ->andFilterWhere(['like', 'report_status_id', $this->report_status_id])
            ->andFilterWhere(['like', 'token_upload', $this->token_upload]);

        return $dataProvider;
    }
}
