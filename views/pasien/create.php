<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MPasien $model */

$this->title = 'Tambah Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Data Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
