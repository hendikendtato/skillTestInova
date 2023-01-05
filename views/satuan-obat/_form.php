<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MSatuanObat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="msatuan-obat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_satuan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
