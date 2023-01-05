<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MSatuanObat $model */

$this->title = 'Update M Satuan Obat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Satuan Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="msatuan-obat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
