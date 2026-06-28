<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manajemen Role';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-xl">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Hak Akses Role</h3>
        </div>
        <div class="table-responsive card-body p-0">
            <table class="table table-vcenter table-striped">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Role</th>
                        <th>Deskripsi</th>
                        <th class="text-center w-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $number = 1; foreach ($roles as $item): ?>
                        <tr>
                            <td class="text-center"><?= $number++ ?></td>
                            <td class="fw-bold"><?= Html::encode($item->nama_role) ?></td>
                            <td class="text-muted">Hak akses permanen untuk pengguna level <?= Html::encode($item->nama_role) ?></td>
                            <td>
                                <?= Html::a('<i class="bi bi-shield-lock me-1"></i> Hak Akses', ['hak-akses', 'id' => $item->id], ['class' => 'btn btn-outline-primary btn-sm text-nowrap']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if(empty($roles)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada role di database.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
