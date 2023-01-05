<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendaftaran_pasien".
 *
 * @property int $id
 * @property string $nomor_pendaftaran
 * @property int $pasien
 * @property string $tgl_daftar
 * @property string $status
 *
 * @property MPasien $pasien0
 */
class PendaftaranPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_pendaftaran', 'pasien', 'tgl_daftar', 'status'], 'required'],
            [['pasien'], 'integer'],
            [['tgl_daftar'], 'safe'],
            [['status'], 'string'],
            [['nomor_pendaftaran'], 'string', 'max' => 50],
            [['pasien'], 'exist', 'skipOnError' => true, 'targetClass' => MPasien::class, 'targetAttribute' => ['pasien' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_pendaftaran' => 'Nomor Pendaftaran',
            'pasien' => 'Pasien',
            'tgl_daftar' => 'Tanggal Daftar',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Pasien0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPasien0()
    {
        return $this->hasOne(MPasien::class, ['id' => 'pasien']);
    }
}
