<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MObat;

/**
 * ObatSearch represents the model behind the search form of `app\models\MObat`.
 */
class ObatSearch extends MObat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'satuan'], 'integer'],
            [['kode_obat', 'nama_obat', 'keterangan'], 'safe'],
            [['stok', 'harga'], 'number'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MObat::find();

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
            'stok' => $this->stok,
            'satuan' => $this->satuan,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['like', 'kode_obat', $this->kode_obat])
            ->andFilterWhere(['like', 'nama_obat', $this->nama_obat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
