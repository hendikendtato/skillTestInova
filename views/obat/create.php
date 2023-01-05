<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MObat $model */

$this->title = 'Tambah Obat';
$this->params['breadcrumbs'][] = ['label' => 'Data Obat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
