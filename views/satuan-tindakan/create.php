<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MSatuanTindakan $model */

$this->title = 'Tambah Satuan Tindakan';
$this->params['breadcrumbs'][] = ['label' => 'Data Satuan Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msatuan-tindakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
