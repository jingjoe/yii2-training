<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\News;

/**
 * NewsSearch represents the model behind the search form about `frontend\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view', 'created_by', 'updated_by'], 'integer'],
            [['cat_id', 'title', 'detail', 'img', 'token_upload', 'status', 'create_date', 'modify_date','catname'], 'safe'],
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
        
        $query = News::find();
        $query->joinWith(['cat']);
        
        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination'=>[
            'pageSize'=>10 //แบ่งหน้า
        ]
        ]);
            
    // สำหรับ coluumn pttype
        $dataProvider->sort->attributes['catname'] = [
            'asc' => ['cat_name' => SORT_ASC],
            'desc' => ['cat_name' => SORT_DESC],
        ];

        $this->load($params);
        

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'view' => $this->view,
            'create_date' => $this->create_date,
            'modify_date' => $this->modify_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'cat_id', $this->cat_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'token_upload', $this->token_upload])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cat_name', $this->catname]);

        return $dataProvider;
    }
}
