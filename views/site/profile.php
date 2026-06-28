<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile'];

$fotoProfil = (isset($user->foto) && $user->foto)
    ? Url::to('@web/uploads/profile/' . $user->foto)
    : Url::to('@web/ui-assets/images/pegawai/default.jpg');
?>

<div class="container">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="<?= Url::to(['site/profile']) ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

        <div class="card overflow-hidden">
            <div class="card-header p-0">
                <div class="bg-secondary w-100" style="height: 200px;"></div>
            </div>
            <div class="card-body">
                <div class="row g-4 mb-5">
                    <div class="col-auto text-center">
                        <img id="preview-foto" src="<?= $fotoProfil ?>" alt="Photo Profile" class="rounded-circle profile-img bg-white" style="width: 150px; height: 150px; object-fit: cover; margin-top: -75px; border: 4px solid white;">

                        <div class="mt-3">
                            <label for="upload-foto" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="bi bi-camera me-1"></i> Ubah Foto
                            </label>
                            <input type="file" name="foto" id="upload-foto" class="d-none" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="mb-1"><?= Html::encode($user->nama ?: $user->username) ?></h2>
                        <div class="text-secondary">
                            <i class="bi bi-building me-1"></i> <?= Html::encode($roleName) ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="input-name" class="form-label">Name</label>
                        <input type="text" name="nama" id="input-name" class="form-control" value="<?= Html::encode($user->nama ?: $user->username) ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="input-email" class="form-label">Email</label>
                        <input type="email" name="email" id="input-email" class="form-control" value="<?= Html::encode($user->email ?? '') ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="input-birthday" class="form-label">Birthday</label>
                        <input type="date" name="tanggal_lahir" id="input-birthday" class="form-control" value="2000-12-31">
                    </div>
                </div>

                <div>
                    <label for="input-note" class="form-label">Note</label>
                    <textarea name="catatan" id="input-note" class="form-control" rows="4">Have a good bio doesn't make you good person</textarea>
                </div>
            </div>
            <div class="card-footer d-flex">
                <div class="ms-auto">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview-foto');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
