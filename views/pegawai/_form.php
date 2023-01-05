<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

use app\models\MJabatan;

/** @var yii\web\View $this */
/** @var app\models\MPegawai $model */
/** @var yii\widgets\ActiveForm $form */

$ar_jabatan = ArrayHelper::map(MJabatan::find()->asArray()->all(), 'id', 'jabatan');
?>

<div class="mpegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'tgl_lahir')->textInput() ?>
    <?=
        $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Pilih tanggal ...'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true
            ]
        ]);
    ?>
    <?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'golongan_darah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'jabatan')->textInput() ?>

    <?=
        $form->field($model, 'jabatan')->dropDownList(
            $ar_jabatan,
            ['prompt'=>'Pilih jabatan ...']
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
