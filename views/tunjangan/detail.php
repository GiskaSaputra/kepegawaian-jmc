<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Detail Tunjangan: ' . $bulan->nama_bulan . ' ' . $bulan->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Tunjangan Transport', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Ambil Role ID user yang sedang login
$roleId = Yii::$app->user->identity->id_role;
?>

<div class="container-xl">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><?= Yii::$app->session->getFlash('success') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <?php if ($roleId == 3): ?>
                <a href="<?= Url::to(['tunjangan/hitung', 'id' => $bulan->id]) ?>" class="btn btn-primary" onclick="return confirm('Hitung ulang tunjangan untuk seluruh pegawai tetap di bulan ini?')">
                    <i class="bi bi-calculator me-2"></i> Hitung Otomatis Tunjangan
                </a>
                <?php else: ?>
                <h3 class="card-title text-primary">Rekapitulasi Tunjangan Transport</h3>
                <?php endif; ?>
            </div>

            <a href="<?= Url::to(['tunjangan/index']) ?>" class="btn btn-outline-secondary">Kembali</a>
        </div>
        <div class="table-responsive card-body p-0">
            <table class="table table-vcenter table-hover mb-0" id="tabel-tunjangan">
                <thead>
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th style="cursor:pointer;" onclick="sortTable(1)" title="Klik untuk mengurutkan">Nama Penerima <i class="bi bi-arrow-down-up text-muted ms-1"></i></th>
                        <th style="cursor:pointer;" class="text-center" onclick="sortTable(2, true)" title="Klik untuk mengurutkan">Jarak (KM) <i class="bi bi-arrow-down-up text-muted ms-1"></i></th>
                        <th style="cursor:pointer;" class="text-center" onclick="sortTable(3, true)" title="Klik untuk mengurutkan">Jumlah Hari <i class="bi bi-arrow-down-up text-muted ms-1"></i></th>
                        <th style="cursor:pointer;" class="text-end" onclick="sortTable(4, true)" title="Klik untuk mengurutkan">Nominal Tunjangan <i class="bi bi-arrow-down-up text-muted ms-1"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($details as $item): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="fw-bold"><?= Html::encode($item->pegawai->nama_pegawai ?? 'Pegawai Terhapus') ?></td>
                            <td class="text-center"><?= Html::encode($item->km) ?> KM</td>
                            <td class="text-center">
                                <span class="badge text-white <?= $item->hari_masuk >= 19 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= Html::encode($item->hari_masuk) ?> Hari
                                </span>
                            </td>
                            <td class="text-end fw-bold <?= $item->nominal > 0 ? 'text-success' : 'text-muted' ?>" data-nominal="<?= $item->nominal ?>">
                                Rp <?= number_format($item->nominal, 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Fungsi Sorting Table Murni Javascript (Tanpa Library Tambahan)
let sortDirection = false;

function sortTable(columnIndex, isNumeric = false) {
    const table = document.getElementById("tabel-tunjangan");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.querySelectorAll("tr"));

    // Toggle arah sort
    sortDirection = !sortDirection;

    const sortedRows = rows.sort((a, b) => {
        let valA = a.cells[columnIndex].innerText.trim();
        let valB = b.cells[columnIndex].innerText.trim();

        // Jika mengurutkan nominal uang, ambil angka aslinya dari data-nominal (jika ada)
        if (columnIndex === 4) {
            valA = a.cells[columnIndex].getAttribute('data-nominal') || 0;
            valB = b.cells[columnIndex].getAttribute('data-nominal') || 0;
        }

        if (isNumeric) {
            valA = parseFloat(valA.replace(/[^0-9.-]+/g,"")) || 0;
            valB = parseFloat(valB.replace(/[^0-9.-]+/g,"")) || 0;
            return sortDirection ? valA - valB : valB - valA;
        } else {
            return sortDirection
                ? valA.localeCompare(valB)
                : valB.localeCompare(valA);
        }
    });

    // Masukkan kembali baris yang sudah diurutkan
    tbody.append(...sortedRows);

    // Perbaiki penomoran (No. Urut) agar tetap 1, 2, 3... berurutan
    Array.from(tbody.querySelectorAll("tr")).forEach((row, index) => {
        row.cells[0].innerText = index + 1;
    });
}
</script>
