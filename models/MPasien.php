<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pasien".
 *
 * @property int $id
 * @property string|null $nama_pasien
 * @property string|null $tempat_lahir
 * @property string|null $tgl_lahir
 * @property string|null $golongan_darah
 * @property string|null $agama
 * @property string|null $jenis_kelamin
 * @property string|null $nomor_handphone
 * @property string|null $alamat
 */
class MPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_lahir'], 'safe'],
            [['jenis_kelamin'], 'string'],
            [['nama_pasien', 'tempat_lahir', 'alamat'], 'string', 'max' => 255],
            [['golongan_darah', 'agama'], 'string', 'max' => 50],
            [['nomor_handphone'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pasien' => 'Nama Pasien',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'golongan_darah' => 'Golongan Darah',
            'agama' => 'Agama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'nomor_handphone' => 'Nomor Handphone',
            'alamat' => 'Alamat',
        ];
    }
}
