<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PemeriksaanSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mpemeriksaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor_pemeriksaan') ?>

    <?= $form->field($model, 'tgl_pemeriksaan') ?>

    <?= $form->field($model, 'pendaftaran') ?>

    <?= $form->field($model, 'pasien') ?>

    <?php // echo $form->field($model, 'dokter') ?>

    <?php // echo $form->field($model, 'diagnosa') ?>

    <?php // echo $form->field($model, 'tindakan') ?>

    <?php // echo $form->field($model, 'biaya_tindakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
