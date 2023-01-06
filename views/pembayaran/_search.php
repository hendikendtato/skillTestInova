<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PembayaranSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mpembayaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nomor_nota') ?>

    <?= $form->field($model, 'nomor_pemeriksaan') ?>

    <?= $form->field($model, 'pasien') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'bayar') ?>

    <?php // echo $form->field($model, 'kembalian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
