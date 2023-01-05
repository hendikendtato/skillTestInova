<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MJabatan $model */

$this->title = 'Tambah Jabatan';
$this->params['breadcrumbs'][] = ['label' => 'Data Jabatan Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mjabatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
