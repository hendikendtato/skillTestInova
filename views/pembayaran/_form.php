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
$pemeriksaan = ArrayHelper::map(MPemeriksaan::find()->where('status = "Aktif"')->asArray()->all(), 'id', 'nomor_pemeriksaan');

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

            <?= $form->field($model, 'tgl_pembayaran')->textInput([ 'readonly'=>'true' ,'value'=> date('Y-m-d') ]) ?>
        
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6" id="detail">
            <table class="table table-striped table-bordered mt-4">
            </table>
        </div>
    </div>

    <?php 
        $script = <<< JS
        $('#mpembayaran-total').attr('readonly','true');
        // Set autofill pasien
        $('#mpembayaran-nomor_pemeriksaan').change(function(){
            var pemeriksaan = $(this).val();
            var biaya_tindakan = 0;
            var total = 0;
            $.get('/skilltest_simklinik/web/pembayaran/tindakan?id='+pemeriksaan, function(data){
                var data = $.parseJSON(data);
                var table_obj = $('table');

                var table_row_caption = $('<tr>', {});
                var table_caption = $('<th colspan="3">', {}).html("Tindakan");
                table_row_caption.append(table_caption);
                table_obj.append(table_row_caption);

                var table_row = $('<tr>', {});
                var table_cell1 = $('<td>', {html: data.tindakan}).attr("colspan","2");
                var table_cell3 = $('<td>', {html: data.biaya}).attr("style","text-align:right");
                table_row.append(table_cell1,table_cell3);
                table_obj.append(table_row);

                biaya_tindakan += parseFloat(data.biaya);
            });

            $('#detail tr').remove();
            $.get('/skilltest_simklinik/web/pembayaran/detail?id='+pemeriksaan, function(data){
                var data = $.parseJSON(data);
                var table_obj = $('table');
                var subtotal = 0;

                var table_row_caption2 = $('<tr>', {});
                var table_caption2 = $('<th>', {}).html("Obat");
                table_row_caption2.append(table_caption2);
                table_obj.append(table_row_caption2);

                $.each(data, function (index, result) {
                    var table_row = $('<tr>', {});
                    var table_cell1 = $('<td>', {html: result.nama_obat});//result.yourDataAttributes
                    var table_cell2 = $('<td>', {html: result.jumlah});
                    var table_cell3 = $('<td>', {html: result.harga}).attr("style","text-align:right");;
                    table_row.append(table_cell1,table_cell2,table_cell3);
                    table_obj.append(table_row);
                    subtotal += parseFloat(result.harga);
                });
                total += parseFloat(subtotal) + parseFloat(biaya_tindakan)
                var table_row2 = $('<tr>', {});
                var table_cell1 = $('<td colspan="2" style="font-weight:bold">', {}).html("Total");
                var table_cell3 = $('<td>', {html: total}).attr("style","text-align:right; font-weight:bold");
                table_row2.append(table_cell1,table_cell3);
                table_obj.append(table_row2);
                console.log(subtotal);
                $('#mpembayaran-total').val(total);
            });


            // Set autofill pasien
            $.get('/skilltest_simklinik/web/pembayaran/ambil-pasien?id='+pemeriksaan, function(data){
                var data = $.parseJSON(data);
                console.log(data);
                $('#mpembayaran-pasien').val(data.pasien);
            });

        });

        $('#mpembayaran-bayar').keyup(function(){
            var bayar = $(this).val();
            var total = $('#mpembayaran-total').val();

            var kembalian = parseFloat(bayar) - parseFloat(total);
            if(kembalian < 0){
                $('#mpembayaran-kembalian').val(0);
            } else if(kembalian == null){
                $('#mpembayaran-kembalian').val(0);
            } else {
                $('#mpembayaran-kembalian').val(kembalian);
            }
        });

        JS;
        $this->registerJs($script);
    ?>

</div>
