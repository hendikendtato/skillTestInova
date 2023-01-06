<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MPemeriksaan $model */

$this->title = "View";
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mpemeriksaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nomor_pemeriksaan',
            'tgl_pemeriksaan',
            'pendaftaran0.nomor_pendaftaran',
            'pasien0.nama_pasien',
            'dokter0.nama_lengkap',
            'diagnosa',
            'tindakan0.tindakan',
            'biaya_tindakan',
            'status',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider'=>new yii\data\ActiveDataProvider([
            'query'=>$model->getDetailObats(),
            'pagination'=>false
        ]),
        'columns'=>[
            'obat.nama_obat',
            'jumlah',
            'harga'
        ]
    ]) ?>

</div>
