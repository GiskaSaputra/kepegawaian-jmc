<?php
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Aplikasi Kepegawaian</title>
    <link rel="icon" type="image/png" href="<?= \yii\helpers\Url::to('@web/ui-assets/images/favicon.png') ?>">
    <?php $this->head() ?>
</head>
<body class="flex-md-row page-login">
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
