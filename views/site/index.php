<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Overview'];

// Menerapkan warna gradien persis seperti prototipe
$totalStatistik = [
  [
    'title' => 'Total Pegawai',
    'value' => $totalPegawai ?? 0,
    'icon' => '<i class="bi bi-people"></i>',
    'backgroundColor' => 'linear-gradient(180deg, #549CE3 0%, #4A7BB2 100%)',
  ],
  [
    'title' => 'Total Pegawai Kontrak',
    'value' => $totalKontrak ?? 0,
    'icon' => '<i class="bi bi-hourglass"></i>',
    'backgroundColor' => 'linear-gradient(180deg, #EACE5C 0%, #D4A94D 100%)',
  ],
  [
    'title' => 'Total Pegawai Tetap',
    'value' => $totalTetap ?? 0,
    'icon' => '<i class="bi bi-file-earmark-person"></i>',
    'backgroundColor' => 'linear-gradient(180deg, #20BF91 0%, #1DA17D 100%)',
  ],
  [
    'title' => 'Peserta Magang',
    'value' => $totalMagang ?? 0,
    'icon' => '<i class="bi bi-backpack"></i>',
    'backgroundColor' => 'linear-gradient(180deg, #F48968 0%, #CD795D 100%)',
  ],
];
?>

<div class="container-xl">
    <?php if (strtolower($roleName) !== 'manager hrd'): ?>
        <div class="card shadow-sm mt-4">
            <div class="card-body py-5 text-center">
                <h1 class="display-6 fw-bold text-primary">
                    Selamat Datang <?= Html::encode($user->nama ?: $user->username) ?> - <?= Html::encode($roleName) ?>
                </h1>
                <p class="text-muted mt-3">Anda login sebagai <?= Html::encode($roleName) ?>. Gunakan menu di sidebar untuk mengelola aplikasi.</p>
            </div>
        </div>

    <?php else: ?>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card bg-dark h-100 position-relative">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?= Url::to('@web/ui-assets/images/illustrations/greeting-img.svg') ?>" alt="" class="img-fluid mb-4" />
                        </div>
                        <h3 class="card-title text-white">
                            Halo, selamat datang <?= Html::encode($user->nama ?: $user->username) ?> di Aplikasi Kepegawaian
                        </h3>
                        <p class="text-white fw-lighter fst-italic">
                            "Fokuskan tujuan yang ingin didapat, jangan biarkan faktor lain menghalangi tujuan Anda"
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <?php foreach ($totalStatistik as $item): ?>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="d-flex rounded-circle" style="width: 56px; height: 56px; background: <?= $item['backgroundColor'] ?>">
                                                        <span class="m-auto text-white fs-2"><?= $item['icon'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h3 class="fs-2 mb-1"><?= $item['value'] ?></h3>
                                                    <p class="text-secondary fw-light mb-0"><?= $item['title'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Total Pegawai Berdasarkan Status Kontrak</h3>
                                <div id="chart-status-pegawai"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Total Pegawai Berdasarkan Gender</h3>
                                <div id="chart-gender-pegawai"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pegawai Terbaru</h3>
                    </div>
                    <div class="table-responsive card-body p-0">
                        <table class="table table-vcenter table-striped card-table">
                            <thead>
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>NIPP</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status Kepegawaian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; foreach ($latestPegawai ?? [] as $item): ?>
                                    <tr>
                                        <td class="text-center"><?= $index++ ?></td>
                                        <td><?= Html::encode($item->nip) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <img src="<?= $item->foto_pegawai ? Url::to('@web/uploads/pegawai/'.$item->foto_pegawai) : Url::to('@web/ui-assets/images/pegawai/default.jpg') ?>" alt="" style="width: 32px; height: 32px; object-fit: cover;" class="rounded-pill" />
                                                <p class="mb-0"><?= Html::encode($item->nama_pegawai) ?></p>
                                            </div>
                                        </td>
                                        <td><?= $item->tanggal_masuk ? date('d M Y', strtotime($item->tanggal_masuk)) : '-' ?></td>
                                        <td><?= Html::encode($item->status_kontrak) ?></td>
                                        <td>
                                            <a href="<?= Url::to(['pegawai/detail', 'id' => $item->id]) ?>" class="btn btn-primary btn-sm">Detail Pegawai</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        setTimeout(function() {
            if (document.querySelector("#chart-status-pegawai")) {
                new ApexCharts(document.querySelector("#chart-status-pegawai"), {
                    chart: { type: "donut", height: 250 },
                    series: [<?= $totalKontrak ?? 0 ?>, <?= $totalTetap ?? 0 ?>, <?= $totalMagang ?? 0 ?>],
                    labels: ["PKWT", "PKWTT", "Magang"],
                    colors: ["#5480C7", "#2B508E", "#FE7E00"],
                    legend: { position: "bottom" },
                    dataLabels: { enabled: true }
                }).render();
            }

            if (document.querySelector("#chart-gender-pegawai")) {
                new ApexCharts(document.querySelector("#chart-gender-pegawai"), {
                    chart: { type: "donut", height: 250 },
                    series: [70, 30],
                    labels: ["Laki-laki", "Perempuan"],
                    colors: ["#2B508E", "#FE7E00"],
                    legend: { position: "bottom" },
                    dataLabels: { enabled: true }
                }).render();
            }
        }, 100);
        </script>
    <?php endif; ?>
</div>
