<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->context->layout = 'auth';
?>

<?php $this->registerCssFile('@web/ui-vendor/npm-asset/swiper/swiper-bundle.min.css'); ?>

<div class="d-flex flex-column flex-lg-row w-100 vh-100 overflow-hidden">

    <div class="col-12 col-lg-5 d-flex align-items-center justify-content-center bg-white p-4 p-lg-5">
        <div class="w-100" style="max-width: 450px;">
            <div class="d-flex gap-3 mb-4 align-items-center">
                <div class="logo">
                    <img src="<?= Url::to('@web/ui-assets/images/logo_jmc_black.png') ?>" alt="Logo" height="35">
                </div>
                <div class="logo-text">
                    <h2 class="mb-0 text-primary">Aplikasi Kepegawaian</h2>
                    <div class="text-muted small">Sistem Informasi SDM</div>
                </div>
            </div>
            <p class="text-muted mb-4">Selamat Datang, silahkan masukkan kredensial Anda!</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', ['options' => ['class' => 'mb-3']])->textInput([
                    'autofocus' => true,
                    'class' => 'form-control py-3 bg-light',
                    'placeholder' => 'Username / Email / No. HP'
                ])->label(false) ?>

                <?= $form->field($model, 'password', ['options' => ['class' => 'mb-3']])->passwordInput([
                    'class' => 'form-control py-3 bg-light',
                    'placeholder' => 'Password'
                ])->label(false) ?>

                <?= $form->field($model, 'verifyCode', ['options' => ['class' => 'mb-3']])->widget(Captcha::class, [
                    'template' => '<div class="row align-items-center"><div class="col-5">{image}</div><div class="col-7">{input}</div></div>',
                    'options' => ['class' => 'form-control py-2 bg-light', 'placeholder' => 'Ketik kode']
                ])->label(false) ?>

                <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'mb-4']])->checkbox([
                    'template' => "<label class=\"form-check\">\n{input}\n<span class=\"form-check-label\">Remember me</span>\n</label>\n{error}",
                ]) ?>

                <div class="d-grid mt-4">
                    <?= Html::submitButton('MASUK', ['class' => 'btn btn-primary text-uppercase shadow-sm py-3 fw-bold', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="col-12 col-lg-7 d-none d-lg-block bg-dark position-relative swiper m-0 p-0">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?= Url::to('@web/ui-assets/images/login/work02.jpeg') ?>" alt="Work 2" class="w-100 h-100 object-fit-cover">
            </div>
            <div class="swiper-slide">
                <img src="<?= Url::to('@web/ui-assets/images/login/work01.jpeg') ?>" alt="Work 1" class="w-100 h-100 object-fit-cover">
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

</div>

<?php
$this->registerJsFile('@web/ui-vendor/npm-asset/swiper/swiper-bundle.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$js = <<<JS
    localStorage.removeItem('jwt_token');

    const swiper = new Swiper('.swiper', {
        loop: true, effect: 'fade', speed: 2000,
        autoplay: { delay: 5000 },
        pagination: { el: '.swiper-pagination' },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });
JS;
$this->registerJs($js);
?>
