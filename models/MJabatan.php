<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_jabatan".
 *
 * @property int $id
 * @property string|null $jabatan
 *
 * @property MPegawai[] $mPegawais
 */
class MJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jabatan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jabatan' => 'Jabatan',
        ];
    }

    /**
     * Gets query for [[MPegawais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMPegawais()
    {
        return $this->hasMany(MPegawai::class, ['jabatan' => 'id']);
    }
}
