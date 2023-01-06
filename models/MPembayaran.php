<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property int $id
 * @property string|null $nomor_nota
 * @property int|null $nomor_pemeriksaan
 * @property int|null $pasien
 * @property float|null $total
 * @property float|null $bayar
 * @property float|null $kembalian
 */
class MPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_pemeriksaan', 'pasien'], 'integer'],
            [['total', 'bayar', 'kembalian'], 'number'],
            [['nomor_nota'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_nota' => 'Nomor Nota',
            'nomor_pemeriksaan' => 'Nomor Pemeriksaan',
            'pasien' => 'Pasien',
            'total' => 'Total',
            'bayar' => 'Bayar',
            'kembalian' => 'Kembalian',
        ];
    }
}
