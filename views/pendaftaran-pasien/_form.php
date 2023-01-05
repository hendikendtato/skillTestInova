<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\MPasien;

/** @var yii\web\View $this */
/** @var app\models\PendaftaranPasien $model */
/** @var yii\widgets\ActiveForm $form */

$pasiens = ArrayHelper::map(MPasien::find()->asArray()->all(), 'id', 'nama_pasien');

?>

<div class="pendaftaran-pasien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_pendaftaran')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'pasien')->textInput() ?>

    <?=
        $form->field($model, 'pasien')->widget(Select2::classname(), [
            'data' => $pasiens,
            'language' => 'id',
            'options' => ['placeholder' => 'Pilih pasien ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php //$form->field($model, 'tgl_daftar')->textInput() ?>
    <?=
        $form->field($model, 'tgl_daftar')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih tanggal ...'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'readonly' => true, 'value' => 'Aktif']) ?>

    <?php //$form->field($model, 'status')->dropDownList([ 'Aktif' => 'Aktif', 'Selesai' => 'Selesai', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
