<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Setting Tunjangan Transport';
$this->params['breadcrumbs'][] = ['label' => 'Tunjangan Transport', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-xl">
    <div class="row">
        <div class="col-md-6">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><?= Yii::$app->session->getFlash('success') ?></div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-header bg-light"><h3 class="card-title">Form Pengaturan Tarif</h3></div>

                <?php $form = ActiveForm::begin(['id' => 'form-setting']); ?>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <?= $form->field($model, 'base_fare', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-light">Rp</span>{input}<span class="input-group-text bg-light">/ km</span></div>{error}{hint}'
                            ])->textInput(['id' => 'input-tarif', 'class' => 'form-control', 'placeholder' => 'Contoh: 5000'])->label('Tarif per Kilometer') ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'berlaku_mulai')->textInput(['type' => 'date']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'min_km')->textInput(['type' => 'number', 'min' => 0])->label('Minimal (Batas Bawah)') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'max_km')->textInput(['type' => 'number', 'min' => 0])->label('Maksimal (Batas Atas)') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex gap-2">
                    <?= Html::submitButton('<i class="bi bi-save me-1"></i> Simpan Pengaturan', ['class' => 'btn btn-primary']) ?>
                    <a href="<?= \yii\helpers\Url::to(['index']) ?>" class="btn btn-outline-secondary">Kembali</a>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputTarif = document.getElementById('input-tarif');
    const formSetting = document.getElementById('form-setting');

    if (inputTarif.value) {
        inputTarif.value = formatRupiah(inputTarif.value);
    }

    inputTarif.addEventListener('input', function(e) {
        let rawValue = this.value.replace(/[^0-9]/g, '');
        this.value = formatRupiah(rawValue);
    });


    formSetting.addEventListener('submit', function() {
        inputTarif.value = inputTarif.value.replace(/\./g, '');
    });

    function formatRupiah(angka) {
        if (!angka) return '';
        return new Intl.NumberFormat('id-ID').format(angka);
    }
});
</script>
