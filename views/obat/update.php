<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MObat $model */

$this->title = 'Ubah Obat' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Data Obat', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="mobat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
