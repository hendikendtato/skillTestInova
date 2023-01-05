<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\widgets\GridInput;
use yii\helpers\ArrayHelper;

use app\models\MObat;
use app\models\PendaftaranPasien;

/** @var yii\web\View $this */
/** @var app\models\MPemeriksaan $model */
/** @var yii\widgets\ActiveForm $form */

$Obat = ArrayHelper::map(MObat::find()->asArray()->all(), 'id', 'nama_obat');
$n_pendaftaran = ArrayHelper::map(PendaftaranPasien::find()->where(['=', 'status', 'Aktif'])->asArray()->all(), 'id', 'nomor_pendaftaran');
?>

<div class="mpemeriksaan-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row mb-3">
        <div class="col-md-12">
            <?php //$form->field($model, 'pendaftaran')->textInput() ?>
            <?=
                $form->field($model, 'pendaftaran')->dropDownList(
                    $n_pendaftaran,
                    ['prompt'=>'Select...']
                );
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nomor_pemeriksaan')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_pemeriksaan')->textInput() ?>
        </div>
    </div>



    <?= $form->field($model, 'pasien')->textInput() ?>

    <?= $form->field($model, 'dokter')->textInput() ?>

    <?= $form->field($model, 'diagnosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tindakan')->textInput() ?>

    <?= $form->field($model, 'biaya_tindakan')->textInput() ?>

    <div class="form-group">
        <?=
            GridInput::widget([
                'allModels' => $model->detailObats,
                'model' => \app\models\MDetailObat::className(),
                'form' => $form,
                'columns' => [
                    ['class' => 'mdm\widgets\SerialColumn'],
                    [
                        'attribute' => 'id_obat',
                        'items' => $Obat
                    ],
                    'jumlah',
                    'harga',
                    ['class' => 'mdm\widgets\ButtonColumn']
                ],
                'hiddens'=>[
                    'id_pemeriksaan'
                ]
            ])
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
