<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\MSatuanObat;

/** @var yii\web\View $this */
/** @var app\models\MDetailObat $model */
/** @var yii\widgets\ActiveForm $form */

$Obat = ArrayHelper::map(MSatuanObat::find()->asArray()->all(), 'id', 'nama_satuan');
?>

<div class="mdetail-obat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pemeriksaan')->textInput() ?>

    <?php //$form->field($model, 'id_obat')->textInput() ?>
    <?=
        $form->field($model, 'id_obat')->dropDownList(
            $Obat,
            ['prompt'=>'Select...']
        );
    ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
