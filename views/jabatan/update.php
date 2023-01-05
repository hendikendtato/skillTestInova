<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MJabatan $model */

$this->title = 'Ubah Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Data Jabatan Pegawai', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="mjabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
