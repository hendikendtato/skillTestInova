<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


use app\models\MPemeriksaan;
use app\models\MPasien;

/** @var yii\web\View $this */
/** @var app\models\MPembayaran $model */
/** @var yii\widgets\ActiveForm $form */

$pasien = ArrayHelper::map(MPasien::find()->asArray()->all(), 'id', 'nama_pasien');
$pemeriksaan = ArrayHelper::map(MPemeriksaan::find()->asArray()->all(), 'id', 'nomor_pemeriksaan');
?>

<div class="mpembayaran-form">

    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>
        
            <?= $form->field($model, 'nomor_nota')->textInput(['maxlength' => true]) ?>
        
            <?php //$form->field($model, 'nomor_pemeriksaan')->textInput() ?>
            <?=
                $form->field($model, 'nomor_pemeriksaan')->dropDownList(
                    $pemeriksaan,
                    [
                        'prompt'=>'Pilih ...',
                    ]
                );
            ?>
        
            <?php //$form->field($model, 'pasien')->textInput() ?>
            <?=
                $form->field($model, 'pasien')->dropDownList(
                    $pasien,
                    [
                        'prompt'=>'Nama Pasien',
                    ]
                );
            ?>
        
            <?= $form->field($model, 'total')->textInput() ?>
        
            <?= $form->field($model, 'bayar')->textInput() ?>
        
            <?= $form->field($model, 'kembalian')->textInput() ?>
        
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6" id="detail">
            <table class="table table-striped table-bordered mt-4">
                <thead>
                    <tr id="header-detail">
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <?php 
        $script = <<< JS

        // Set autofill pasien
        $('#mpembayaran-nomor_pemeriksaan').change(function(){
            var pemeriksaan = $(this).val();
            $.get('/skilltest_simklinik/web/pembayaran/detail?id='+pemeriksaan, function(data){
                var data = $.parseJSON(data);
                $.each(data, function (i, item) {
                    console.log(item.harga);
                    // console.log(item.name);
                    // string += "<option value=" + item.kode_kab + ">" + item.nama + "</option>";
                    $('tbody').append("<tr>"+
                    +"<td>Tess</td>"+
                    +"</tr>");

                });
            });
        });
        
        JS;
        $this->registerJs($script);
    ?>

</div>
