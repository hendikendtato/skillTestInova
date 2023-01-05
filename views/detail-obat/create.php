<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MDetailObat $model */

$this->title = 'Create M Detail Obat';
$this->params['breadcrumbs'][] = ['label' => 'M Detail Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdetail-obat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
