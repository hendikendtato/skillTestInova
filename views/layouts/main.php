<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-md navbar-dark bg-primary fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-md-auto'],
        'items' => [
            [
                'label' => 'Master Data',
                'items' => [
                     ['label' => 'Master Pasien', 'url' => ['/pasien/index']],
                     ['label' => 'Master Obat', 'url' => ['/obat/index']],
                     ['label' => 'Master Satuan Obat', 'url' => ['/satuan-obat/index']],
                     ['label' => 'Master Tindakan', 'url' => ['/tindakan/index']],
                     ['label' => 'Master Satuan Tindakan', 'url' => ['/satuan-tindakan/index']],
                     ['label' => 'Master Pegawai', 'url' => ['/pegawai/index']],
                     ['label' => 'Master Jabatan', 'url' => ['/jabatan/index']],
                ],
            ],
            ['label' => 'Pendaftaran Pasien', 'url' => ['/pendaftaran-pasien/index']],
            ['label' => 'Tindakan Dokter', 'url' => ['/site/about']],
            ['label' => 'Pembayaran', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? 
                ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#w1-add-button").append("Tambah +");
</script>