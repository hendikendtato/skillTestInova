<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PendaftaranPasien $model */

$this->title = 'Update Pendaftaran Pasien: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendaftaran-pasien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
