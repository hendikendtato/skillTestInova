<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MDetailObat $model */

$this->title = 'Update M Detail Obat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Detail Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mdetail-obat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
