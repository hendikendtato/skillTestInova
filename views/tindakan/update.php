<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MTindakan $model */

$this->title = 'Ubah Master Tindakan';
$this->params['breadcrumbs'][] = ['label' => 'Data Master Tindakan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="mtindakan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
