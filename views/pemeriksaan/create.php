<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MPemeriksaan $model */

$this->title = 'Pemeriksaan Dokter';
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpemeriksaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
