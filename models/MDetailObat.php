<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_obat".
 *
 * @property int $id
 * @property int|null $id_pemeriksaan
 * @property int|null $id_obat
 * @property string|null $jumlah
 * @property float|null $harga
 *
 * @property MObat $obat
 * @property Pemeriksaan $pemeriksaan
 */
class MDetailObat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pemeriksaan', 'id_obat'], 'integer'],
            [['harga'], 'number'],
            [['jumlah'], 'string', 'max' => 50],
            [['id_obat'], 'exist', 'skipOnError' => true, 'targetClass' => MObat::class, 'targetAttribute' => ['id_obat' => 'id']],
            [['id_pemeriksaan'], 'exist', 'skipOnError' => true, 'targetClass' => Pemeriksaan::class, 'targetAttribute' => ['id_pemeriksaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pemeriksaan' => 'Id Pemeriksaan',
            'id_obat' => 'Nama Obat',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
        ];
    }

    /**
     * Gets query for [[Obat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObat()
    {
        return $this->hasOne(MObat::class, ['id' => 'id_obat']);
    }

    /**
     * Gets query for [[Pemeriksaan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class, ['id' => 'id_pemeriksaan']);
    }
}
