<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MPembayaran $model */

$this->title = 'Pembayaran';
$this->params['breadcrumbs'][] = ['label' => 'Data Pembayaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpembayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
