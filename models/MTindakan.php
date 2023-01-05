<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_tindakan".
 *
 * @property int $id
 * @property string|null $tindakan
 * @property int|null $satuan_tindakan
 * @property float|null $biaya
 * @property string|null $keterangan
 *
 * @property MSatuanTindakan $satuanTindakan
 */
class MTindakan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_tindakan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['satuan_tindakan'], 'integer'],
            [['biaya'], 'number'],
            [['tindakan', 'keterangan'], 'string', 'max' => 255],
            [['satuan_tindakan'], 'exist', 'skipOnError' => true, 'targetClass' => MSatuanTindakan::class, 'targetAttribute' => ['satuan_tindakan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tindakan' => 'Tindakan',
            'satuan_tindakan' => 'Satuan Tindakan',
            'biaya' => 'Biaya',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[SatuanTindakan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuanTindakan()
    {
        return $this->hasOne(MSatuanTindakan::class, ['id' => 'satuan_tindakan']);
    }
}
