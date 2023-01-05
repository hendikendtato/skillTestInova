<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PendaftaranPasien;

/**
 * PendaftaranPasienSearch represents the model behind the search form of `app\models\PendaftaranPasien`.
 */
class PendaftaranPasienSearch extends PendaftaranPasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pasien'], 'integer'],
            [['nomor_pendaftaran', 'tgl_daftar', 'status'], 'safe'],
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
        $query = PendaftaranPasien::find();

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
            'pasien' => $this->pasien,
            'tgl_daftar' => $this->tgl_daftar,
        ]);

        $query->andFilterWhere(['like', 'nomor_pendaftaran', $this->nomor_pendaftaran])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
