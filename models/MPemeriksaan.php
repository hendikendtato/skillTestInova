<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan".
 *
 * @property int $id
 * @property string|null $nomor_pemeriksaan
 * @property string|null $tgl_pemeriksaan
 * @property int|null $pendaftaran
 * @property int|null $pasien
 * @property int|null $dokter
 * @property string|null $diagnosa
 * @property int|null $tindakan
 * @property float|null $biaya_tindakan
 *
 * @property DetailObat[] $detailObats
 * @property MPegawai $dokter0
 * @property PendaftaranPasien $pendaftaran0
 * @property MTindakan $tindakan0
 */
class MPemeriksaan extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_pemeriksaan'], 'safe'],
            [['pendaftaran', 'pasien', 'dokter', 'tindakan'], 'integer'],
            [['biaya_tindakan'], 'number'],
            [['nomor_pemeriksaan'], 'string', 'max' => 50],
            [['diagnosa'], 'string', 'max' => 255],
            [['dokter'], 'exist', 'skipOnError' => true, 'targetClass' => MPegawai::class, 'targetAttribute' => ['dokter' => 'id']],
            [['pendaftaran'], 'exist', 'skipOnError' => true, 'targetClass' => PendaftaranPasien::class, 'targetAttribute' => ['pendaftaran' => 'id']],
            [['tindakan'], 'exist', 'skipOnError' => true, 'targetClass' => MTindakan::class, 'targetAttribute' => ['tindakan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomor_pemeriksaan' => 'Nomor Pemeriksaan',
            'tgl_pemeriksaan' => 'Tanggal Pemeriksaan',
            'pendaftaran' => 'Nomor Pendaftaran',
            'pasien' => 'Pasien',
            'dokter' => 'Dokter',
            'diagnosa' => 'Diagnosa',
            'tindakan' => 'Tindakan',
            'biaya_tindakan' => 'Biaya Tindakan',
        ];
    }

    /**
     * Gets query for [[DetailObats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailObats()
    {
        return $this->hasMany(MDetailObat::class, ['id_pemeriksaan' => 'id']);
    }

    public function setDetailObats($value)
    {
        $this->loadRelated('detailObats', $value);
    }

    /**
     * Gets query for [[Dokter0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDokter0()
    {
        return $this->hasOne(MPegawai::class, ['id' => 'dokter']);
    }

    /**
     * Gets query for [[Pendaftaran0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftaran0()
    {
        return $this->hasOne(PendaftaranPasien::class, ['id' => 'pendaftaran']);
    }

    /**
     * Gets query for [[Tindakan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTindakan0()
    {
        return $this->hasOne(MTindakan::class, ['id' => 'tindakan']);
    }
    public function getPasien0()
    {
        return $this->hasOne(MPasien::class, ['id' => 'pasien']);
    }
}
