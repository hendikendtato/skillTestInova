<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_satuan_obat".
 *
 * @property int $id
 * @property string|null $kode_satuan
 * @property string|null $nama_satuan
 *
 * @property MObat[] $mObats
 */
class MSatuanObat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_satuan_obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_satuan', 'nama_satuan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_satuan' => 'Kode Satuan',
            'nama_satuan' => 'Nama Satuan',
        ];
    }

    /**
     * Gets query for [[MObats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMObats()
    {
        return $this->hasMany(MObat::class, ['satuan' => 'id']);
    }
}
