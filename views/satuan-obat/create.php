<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MSatuanObat $model */

$this->title = 'Tambah Satuan Obat';
$this->params['breadcrumbs'][] = ['label' => 'Data Satuan Obat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msatuan-obat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
