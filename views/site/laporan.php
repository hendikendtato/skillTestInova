<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\MPembayaran;

/** @var yii\web\View $this */
/** @var app\models\MObat $model */
/** @var yii\widgets\ActiveForm $form */

$pendapatan = MPembayaran::find()->select(['tgl_pembayaran, SUM(total) AS total'])->groupBy(['tgl_pembayaran'])->asArray()->all();

$total_pendapatan = MPembayaran::find()->select(['SUM(total) AS total'])->where('tgl_pembayaran = "'.date("Y-m-d").'"')->all();
$transaksi = MPembayaran::find()->select(['COUNT(id) AS jumlah_transaksi'])->where('tgl_pembayaran = "'.date("Y-m-d").'"')->asArray()->all();
$pasien = MPembayaran::find()->select(['COUNT(pasien) AS jumlah_pasien'])->where('tgl_pembayaran = "'.date("Y-m-d").'"')->asArray()->all();

foreach ($pendapatan as $value) {
    $data[] = (int)$value['total'];
    $array[] = [
        'name' => date("d-M-Y", strtotime($value['tgl_pembayaran'])),
        'data' => [
            (int)$value['total']
        ]
    ];
}

?>
<div class="row">
    <div class="col-md-4 mt-4">
        <div class="card" style="height: 9rem;">
            <div class="card-body">
                <h5 class="card-title">Transaksi</h5>
                <h3 class="mt-4"><b><?= ($transaksi[0]['jumlah_transaksi']) ? $transaksi[0]['jumlah_transaksi'] : 0 ?></b></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-4">
        <div class="card" style="height: 9rem;">
            <div class="card-body">
                <h5 class="card-title">Pasien</h5>
                <h3 class="mt-4"><b><?= ($pasien) ? $pasien[0]['jumlah_pasien'] : 0 ?></b></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-4">
        <div class="card" style="height: 9rem;">
            <div class="card-body">
                <h5 class="card-title">Pendapatan</h5>
                <h3 class="mt-4"><b>Rp <?= number_format((($total_pendapatan[0]['total']) ? $total_pendapatan[0]['total'] : 0)) ?></b></h3>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <?=
        \dosamigos\highcharts\HighCharts::widget([
            'clientOptions' => [
                'chart' => [
                        'type' => 'column'
                ],
                'title' => [
                    'text' => 'Pendapatan per Hari'
                    ],
                'xAxis' => [
                    'categories' => [
                        'Tanggal'
                    ]
                ],
                'yAxis' => [
                    'title' => [
                        'text' => 'Total'
                    ]
                ],
                'series' => $array
            ]
        ]);
        ?> 
    </div>
</div>