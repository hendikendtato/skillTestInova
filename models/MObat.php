<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_obat".
 *
 * @property int $id
 * @property string|null $kode_obat
 * @property string|null $nama_obat
 * @property float|null $stok
 * @property int|null $satuan
 * @property float|null $harga
 * @property string|null $keterangan
 *
 * @property MSatuanObat $satuan0
 */
class MObat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stok', 'harga'], 'number'],
            [['satuan'], 'integer'],
            [['kode_obat'], 'string', 'max' => 50],
            [['nama_obat', 'keterangan'], 'string', 'max' => 255],
            [['satuan'], 'exist', 'skipOnError' => true, 'targetClass' => MSatuanObat::class, 'targetAttribute' => ['satuan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_obat' => 'Kode Obat',
            'nama_obat' => 'Nama Obat',
            'stok' => 'Stok',
            'satuan' => 'Satuan',
            'harga' => 'Harga (Rp)',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[Satuan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan0()
    {
        return $this->hasOne(MSatuanObat::class, ['id' => 'satuan']);
    }
}
