<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MPemeriksaan $model */

$this->title = 'Update M Pemeriksaan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'M Pemeriksaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpemeriksaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
