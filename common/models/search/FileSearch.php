<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\File;

/**
 * FileSearch represents the model behind the search form of `common\models\File`.
 */
class FileSearch extends File
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'folder_id', 'size', 'created_at', 'updated_at', 'downloads'], 'integer'],
            [['title', 'description', 'file', 'ext', 'slug', 'folder', 'domain', 'path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = File::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'folder_id' => $this->folder_id,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'downloads' => $this->downloads,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'ext', $this->ext])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'folder', $this->folder])
            ->andFilterWhere(['like', 'domain', $this->domain])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
