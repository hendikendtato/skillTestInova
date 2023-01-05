<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MPemeriksaan;

/**
 * PemeriksaanSearch represents the model behind the search form of `app\models\MPemeriksaan`.
 */
class PemeriksaanSearch extends MPemeriksaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pendaftaran', 'pasien', 'dokter', 'tindakan'], 'integer'],
            [['nomor_pemeriksaan', 'tgl_pemeriksaan', 'diagnosa'], 'safe'],
            [['biaya_tindakan'], 'number'],
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
        $query = MPemeriksaan::find();

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
            'tgl_pemeriksaan' => $this->tgl_pemeriksaan,
            'pendaftaran' => $this->pendaftaran,
            'pasien' => $this->pasien,
            'dokter' => $this->dokter,
            'tindakan' => $this->tindakan,
            'biaya_tindakan' => $this->biaya_tindakan,
        ]);

        $query->andFilterWhere(['like', 'nomor_pemeriksaan', $this->nomor_pemeriksaan])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa]);

        return $dataProvider;
    }
}
