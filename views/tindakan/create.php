<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MTindakan $model */

$this->title = 'Create M Tindakan';
$this->params['breadcrumbs'][] = ['label' => 'M Tindakans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mtindakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
