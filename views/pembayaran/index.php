<?php

use app\models\MPembayaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PembayaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nomor_nota',
            'pemeriksaan.nomor_pemeriksaan',
            'pasien001.nama_pasien',
            'total',
            //'bayar',
            //'kembalian',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MPembayaran $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
