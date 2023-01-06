<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\widgets\GridInput;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

use app\models\MObat;
use app\models\PendaftaranPasien;
use app\models\MPegawai;
use app\models\MPasien;
use app\models\MTindakan;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\MPemeriksaan $model */
/** @var yii\widgets\ActiveForm $form */

$Obat = ArrayHelper::map(MObat::find()->asArray()->all(), 'id', 'nama_obat');
$n_pendaftaran = ArrayHelper::map(PendaftaranPasien::find()->where(['=', 'status', 'Aktif'])->asArray()->all(), 'id', 'nomor_pendaftaran');
$dokter = ArrayHelper::map(MPegawai::find()->leftjoin('m_jabatan', 'm_pegawai.jabatan = m_jabatan.id')->where(['like', 'm_jabatan.jabatan', 'dokter'])->asArray()->all(), 'id', 'nama_lengkap');
$pasien = ArrayHelper::map(MPasien::find()->asArray()->all(), 'id', 'nama_pasien');
$tindakan = ArrayHelper::map(MTindakan::find()->asArray()->all(), 'id', 'tindakan');

?>

<div class="mpemeriksaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
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
            <div class="row mb-3">
                <div class="col-md-6">
                    <?= $form->field($model, 'nomor_pemeriksaan')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?php //$form->field($model, 'tgl_pemeriksaan')->textInput() ?>
                    <?=
                        $form->field($model, 'tgl_pemeriksaan')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Pilih tanggal ...'],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true
                            ]
                        ]);
                    ?>
                </div>
            </div>
        
            <div class="row mb-3">
                <?php //$form->field($model, 'pasien')->textInput() ?>
                <?=
                    $form->field($model, 'pasien')->dropDownList(
                        $pasien,
                        [
                            'prompt'=>'Nama Pasien',
                        ]
                    );
                ?>
            </div>
            
            <div class="row mb-3">
                <?php //$form->field($model, 'dokter')->textInput() ?>
                <?=
                    $form->field($model, 'dokter')->dropDownList(
                        $dokter,
                        [
                            'prompt'=>'Select...',
                        ],
                        
                    );
                ?>
            </div>
        
            <div class="row mb-3">
                <?= $form->field($model, 'diagnosa')->textInput(['maxlength' => true]) ?>
            </div>
        
            <div class="row mb-5">
                <div class="col-md-6">
                    <?php //$form->field($model, 'tindakan')->textInput() ?>
                    <?=
                        $form->field($model, 'tindakan')->dropDownList(
                            $tindakan,
                            [
                                'prompt'=>'Select...',
                            ],
                            
                        );
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'biaya_tindakan')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php 
        $script = <<< JS
        // Set autofill pasien
        $('#mpemeriksaan-pendaftaran').change(function(){
            var nomor_pendaftaran = $(this).val();
            $.get('/skilltest_simklinik/web/pemeriksaan/ambil-pasien?id='+nomor_pendaftaran, function(data){
                var data = $.parseJSON(data);
                console.log(data);
                $('#mpemeriksaan-pasien').val(data.id);
            });
        });

        // Set autofill biaya tindakan
        $('#mpemeriksaan-tindakan').change(function(){
            var id_tindakan = $(this).val();
            $.get('/skilltest_simklinik/web/pemeriksaan/set-biaya?id='+id_tindakan, function(data){
                var data = $.parseJSON(data);
                $('#mpemeriksaan-biaya_tindakan').val(data.biaya);
            });
        });

        $("#w1-add-button").click(function(){
            $("input[data-field='harga']").attr('readonly', 'true');
            $("input[data-field='jumlah']").keyup(function(){
                var first = $(this).closest('tr').children('td:first').text();
                var qty = $(this).val();
                var index = parseFloat(first) - 1;
                var id_obat = $('#mdetailobat-'+index+'-id_obat').val();
                
                $.get('/skilltest_simklinik/web/pemeriksaan/harga?id='+id_obat, function(data){
                    var data = $.parseJSON(data);
                    var subtotal = parseFloat(data.harga) * parseFloat(qty);
                    $('#mdetailobat-'+index+'-harga').val(subtotal);
                });
                console.log(first);
            });
        });

        $('#mpemeriksaan-pasien').prop('disabled', true);
        $('#mpemeriksaan-biaya_tindakan').prop('disabled', true);
        
        $('form').on('submit', function() {
            $('#mpemeriksaan-pasien').prop('disabled', false);
            $('#mpemeriksaan-biaya_tindakan').prop('disabled', false);
        });
        
        JS;
        $this->registerJs($script);
    ?>

</div>
