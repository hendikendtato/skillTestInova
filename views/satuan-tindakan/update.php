<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MSatuanTindakan $model */

$this->title = 'Ubah Satuan Tindakan';
$this->params['breadcrumbs'][] = ['label' => 'Data Satuan Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="msatuan-tindakan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
