<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\MSatuanTindakan;

/** @var yii\web\View $this */
/** @var app\models\MTindakan $model */
/** @var yii\widgets\ActiveForm $form */

$satuanTindakan = ArrayHelper::map(MSatuanTindakan::find()->asArray()->all(), 'id', 'nama_satuan');

?>

<div class="mtindakan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tindakan')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'satuan_tindakan')->textInput() ?>

    <?=
        $form->field($model, 'satuan_tindakan')->dropDownList(
            $satuanTindakan,
            ['prompt'=>'Select...']
        );
    ?>

    <?= $form->field($model, 'biaya')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
