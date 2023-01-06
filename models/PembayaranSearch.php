<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPembayaran;

/**
 * PembayaranSearch represents the model behind the search form of `app\models\MPembayaran`.
 */
class PembayaranSearch extends MPembayaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nomor_pemeriksaan', 'pasien'], 'integer'],
            [['nomor_nota'], 'safe'],
            [['total', 'bayar', 'kembalian'], 'number'],
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
        $query = MPembayaran::find();

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
            'nomor_pemeriksaan' => $this->nomor_pemeriksaan,
            'pasien' => $this->pasien,
            'total' => $this->total,
            'bayar' => $this->bayar,
            'kembalian' => $this->kembalian,
        ]);

        $query->andFilterWhere(['like', 'nomor_nota', $this->nomor_nota]);

        return $dataProvider;
    }
}
