<?php
use yii\helpers\Html;
$this->title = 'Log Aktifitas';
$this->params['breadcrumbs'][] = ['label' => 'Log Aktifitas'];
?>

<div class="container-xl">
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom-0 pt-3 pb-3">
            <div class="ms-auto d-flex gap-2">
                <div class="input-group" style="width: 250px;">
                    <input type="text" id="filter-search" class="form-control" placeholder="Cari nama, modul, aksi...">
                    <button class="btn bg-white border"><i class="bi bi-search text-muted"></i></button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter table-hover text-nowrap mb-0 align-middle">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th width="5%" class="text-muted fw-bold text-center">NO</th>
                        <th class="text-muted fw-bold">NAMA USER</th>
                        <th class="text-muted fw-bold">MODUL</th>
                        <th class="text-muted fw-bold">AKSI</th>
                        <th class="text-muted fw-bold text-center">TIMESTAMP</th>
                    </tr>
                </thead>
                <tbody id="log-table-body">
                    <?php $number = 1; foreach ($logs as $log): ?>
                        <?php
                            $namaUser = $log['username'] ?? 'Administrator';
                            $searchString = strtolower($namaUser . ' ' . $log['title'] . ' ' . $log['content']);

                            $timestamp = '-';
                            if (!empty($log['created_at'])) {
                                $timestamp = date('d M Y, H:i', strtotime($log['created_at'] . ' +7 hours')) . ' WIB';
                            }
                        ?>
                        <tr class="log-row" data-search="<?= Html::encode($searchString) ?>">
                            <td class="text-muted text-center row-number"><?= $number++ ?></td>
                            <td class="text-dark fw-bold"><?= Html::encode($namaUser) ?></td>
                            <td class="text-dark">
                                <span class="text-dark"><?= Html::encode($log['title']) ?></span>
                            </td>
                            <td class="text-muted text-wrap" style="max-width: 400px;"><?= Html::encode($log['content']) ?></td>
                            <td class="text-muted text-center">
                                <?= $timestamp ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($logs)): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada log aktifitas.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center bg-white border-top-0 pt-4 pb-4">
            <ul class="pagination m-0 ms-auto">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">next <i class="bi bi-chevron-right ms-1"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterSearch = document.getElementById('filter-search');

    filterSearch.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('.log-row');
        let counter = 1;

        rows.forEach(row => {
            const searchData = row.getAttribute('data-search');

            if (searchData.includes(searchValue)) {
                row.style.display = '';
                row.querySelector('.row-number').innerText = counter++;
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
