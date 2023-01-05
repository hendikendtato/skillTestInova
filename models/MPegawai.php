<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pegawai".
 *
 * @property int $id
 * @property string|null $nama_lengkap
 * @property string|null $tempat_lahir
 * @property string|null $tgl_lahir
 * @property string|null $jenis_kelamin
 * @property string|null $golongan_darah
 * @property string|null $alamat
 * @property int|null $jabatan
 *
 * @property MJabatan $jabatan0
 */
class MPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_lahir'], 'safe'],
            [['jenis_kelamin'], 'string'],
            [['jabatan'], 'integer'],
            [['nama_lengkap', 'alamat'], 'string', 'max' => 255],
            [['tempat_lahir', 'golongan_darah'], 'string', 'max' => 50],
            [['jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatan::class, 'targetAttribute' => ['jabatan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_lengkap' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'golongan_darah' => 'Golongan Darah',
            'alamat' => 'Alamat',
            'jabatan' => 'Jabatan',
        ];
    }

    /**
     * Gets query for [[Jabatan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan0()
    {
        return $this->hasOne(MJabatan::class, ['id' => 'jabatan']);
    }
}
