<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\MSatuanObat;

/** @var yii\web\View $this */
/** @var app\models\MObat $model */
/** @var yii\widgets\ActiveForm $form */

$satuanObat = ArrayHelper::map(MSatuanObat::find()->asArray()->all(), 'id', 'nama_satuan');

?>

<div class="mobat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_obat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_obat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stok')->textInput() ?>

    <?php // $form->field($model, 'satuan')->textInput() ?>

    <?=
        $form->field($model, 'satuan')->dropDownList(
            $satuanObat,
            ['prompt'=>'Select...']
        );
    ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
