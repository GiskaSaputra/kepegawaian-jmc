<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Detail Hak Akses';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-xl">

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label text-muted">Nama Role</label>
                    <input type="text" class="form-control fw-bold" value="<?= Html::encode($role->nama_role) ?>" readonly disabled />
                </div>
                <div class="col-md-8 col-lg-9">
                    <label class="form-label text-muted">Deskripsi Akses Utama</label>
                    <input type="text" class="form-control" value="Pengaturan akses modul ini bersifat tetap (Hardcoded) sesuai panduan spesifikasi." readonly disabled />
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h3 class="card-title"><i class="bi bi-table me-2"></i> Matriks Perizinan Modul</h3>
        </div>
        <div class="table-responsive card-body p-0">
            <table class="table table-vcenter table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Modul / Fitur</th>
                        <th class="text-center">Akses Menu</th>
                        <th class="text-center">Create</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($permissions as $item): ?>
                        <tr>
                            <td class="text-center text-muted"><?= $number++ ?></td>
                            <td class="fw-medium"><?= Html::encode($item['modul']) ?></td>
                            <td class="text-center">
                                <?= $item['canAksesMenu'] ? '<i class="bi bi-check-circle-fill text-success fs-4"></i>' : '<i class="bi bi-x-circle text-danger fs-4"></i>' ?>
                            </td>
                            <td class="text-center">
                                <?= $item['canCreateMenu'] ? '<i class="bi bi-check-circle-fill text-success fs-4"></i>' : '<i class="bi bi-x-circle text-danger fs-4"></i>' ?>
                            </td>
                            <td class="text-center"><span class="badge <?= $item['read'] == 'No' ? 'bg-secondary' : 'bg-primary' ?>"><?= $item['read'] ?></span></td>
                            <td class="text-center"><span class="badge <?= $item['update'] == 'No' ? 'bg-secondary' : 'bg-primary' ?>"><?= $item['update'] ?></span></td>
                            <td class="text-center"><span class="badge <?= $item['delete'] == 'No' ? 'bg-secondary' : 'bg-danger' ?>"><?= $item['delete'] ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
