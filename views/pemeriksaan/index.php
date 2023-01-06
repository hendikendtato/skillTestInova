<?php

use app\models\MPemeriksaan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PemeriksaanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pemeriksaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpemeriksaan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Pemeriksaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'pendaftaran0.nomor_pendaftaran',
            'nomor_pemeriksaan',
            'tgl_pemeriksaan',
            'pasien0.nama_pasien',
            //'dokter',
            'diagnosa',
            //'tindakan',
            //'biaya_tindakan',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MPemeriksaan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
