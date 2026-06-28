<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Tunjangan Transport';
$this->params['breadcrumbs'][] = $this->title;

$selectedYear = Yii::$app->request->get('tahun', date('Y'));
$roleId = Yii::$app->user->identity->id_role;
?>

<div class="row align-items-center mb-3 d-print-none">
    <div class="col">
        <form method="GET" action="<?= Url::to(['tunjangan/index']) ?>" class="d-flex align-items-center gap-2" style="max-width: 300px;">
            <label class="form-label mb-0 fw-bold">Filter Tahun:</label>
            <select name="tahun" class="form-select" onchange="this.form.submit()">
                <?php
                $startYear = date('Y') - 3;
                for ($y = date('Y') + 1; $y >= $startYear; $y--): ?>
                    <option value="<?= $y ?>" <?= $selectedYear == $y ? 'selected' : '' ?>><?= $y ?></option>
                <?php endfor; ?>
            </select>
        </form>
    </div>

    <?php if ($roleId == 3): ?>
    <div class="col-auto ms-auto text-end">
        <a href="<?= Url::to(['tunjangan/buat-bulan']) ?>" class="btn btn-success d-none d-sm-inline-block">
            <i class="bi bi-plus"></i> Generate Bulan Ini
        </a>
        <a href="<?= Url::to(['tunjangan/setting']) ?>" class="btn btn-secondary d-none d-sm-inline-block">
            <i class="bi bi-gear"></i> Pengaturan Tarif
        </a>
    </div>
    <?php endif; ?>
</div>

<div class="container-xl">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Bulan Berjalan (Tahun <?= Html::encode($selectedYear) ?>)</h3>
        </div>
        <div class="table-responsive card-body p-0">
            <table class="table table-vcenter table-striped mb-0">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Nama Bulan</th>
                        <th>Tahun</th>
                        <th class="text-center">Total Penerima</th>
                        <th class="text-end">Total Tunjangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    $filteredList = array_filter($bulanList, function($item) use ($selectedYear) {
                        return $item->tahun == $selectedYear;
                    });

                    foreach ($filteredList as $item): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="fw-bold"><?= Html::encode($item->nama_bulan) ?></td>
                            <td><?= Html::encode($item->tahun) ?></td>
                            <td class="text-center"><span class=""><?= $item->total_penerima ?> Pegawai</span></td>
                            <td class="text-end fw-bold text-success">Rp <?= number_format($item->total_tunjangan, 0, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="<?= Url::to(['tunjangan/detail', 'id' => $item->id]) ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if(empty($filteredList)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data untuk tahun ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
