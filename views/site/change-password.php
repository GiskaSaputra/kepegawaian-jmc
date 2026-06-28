<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div><i class="bi bi-check-circle-fill me-2 fs-3"></i></div>
                        <div><?= Yii::$app->session->getFlash('success') ?></div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div><i class="bi bi-exclamation-triangle-fill me-2 fs-3"></i></div>
                        <div><?= Yii::$app->session->getFlash('error') ?></div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <form method="post" action="<?= Url::to(['/site/change-password']) ?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

                    <div class="card-header bg-light">
                        <h3 class="card-title">Form Ganti Password</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="input-recent-password" class="form-label">Recent Password (Password Saat Ini)</label>
                            <div class="input-group input-group-flat">
                                <input type="password" id="input-recent-password" name="recent_password" class="form-control" required>
                                <span class="input-group-text bg-white show-password cursor-pointer">
                                    <i class="bi bi-eye icon-show text-muted"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="input-new-password" class="form-label">New Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" id="input-new-password" name="new_password" class="form-control" required>
                                <span class="input-group-text bg-white show-password cursor-pointer">
                                    <i class="bi bi-eye icon-show text-muted"></i>
                                </span>
                            </div>
                            <small class="form-hint text-muted">Minimal 8 karakter, tanpa spasi, 1 huruf besar, 1 huruf kecil, 1 simbol/karakter khusus.</small>
                        </div>

                        <div class="mb-3">
                            <label for="input-confirm-password" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" id="input-confirm-password" name="confirm_password" class="form-control" required>
                                <span class="input-group-text bg-white show-password cursor-pointer">
                                    <i class="bi bi-eye icon-show text-muted"></i>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex bg-light">
                        <div class="ms-auto gap-2 d-flex">
                            <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Simpan Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleButtons = document.querySelectorAll('.show-password');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('.icon-show');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
});
</script>
