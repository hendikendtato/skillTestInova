<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PendaftaranPasien $model */

$this->title = 'Pendaftaran Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran Pasien', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-pasien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
