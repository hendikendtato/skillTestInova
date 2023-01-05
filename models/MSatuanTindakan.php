<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_satuan_tindakan".
 *
 * @property int $id
 * @property string|null $nama_satuan
 *
 * @property MTindakan[] $mTindakans
 */
class MSatuanTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_satuan_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_satuan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_satuan' => 'Nama Satuan',
        ];
    }

    /**
     * Gets query for [[MTindakans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMTindakans()
    {
        return $this->hasMany(MTindakan::class, ['satuan_tindakan' => 'id']);
    }
}
