<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Data Pegawai';
$this->params['breadcrumbs'][] = $this->title;

// Ambil Role ID user yang sedang login
$roleId = Yii::$app->user->identity->id_role;
?>

<div class="row align-items-end mb-3 d-print-none">
    <div class="col">
        <div class="text-muted small fw-bold text-uppercase mb-1">DATA PEGAWAI</div>
        <h2 class="page-title fw-bold m-0">Data Pegawai</h2>
    </div>

    <?php if ($roleId == 3): ?>
    <div class="col-auto ms-auto text-end d-flex gap-2">
        <button onclick="exportExcel()" class="btn btn-success d-none d-sm-inline-block shadow-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </button>
        <button onclick="exportBulkPDF()" class="btn btn-danger d-none d-sm-inline-block shadow-sm">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </button>
        <a href="<?= Url::to(['pegawai/tambah']) ?>" class="btn btn-primary d-none d-sm-inline-block shadow-sm">
            <i class="bi bi-plus"></i> Tambah Data
        </a>
    </div>
    <?php endif; ?>
</div>

<div class="container-xl p-0">
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom-0 pt-4 pb-3">
            <div class="d-flex w-100 justify-content-between align-items-center">

                <div id="bulk-action-container" class="d-none d-flex gap-2 align-items-center">
                    <select id="bulk-status-select" class="form-select bg-light text-muted" style="width:140px;">
                        <option value="Aktif">Set Aktif</option>
                        <option value="Nonaktif">Set Non-Aktif</option>
                    </select>
                    <button class="btn btn-warning" onclick="applyBulkStatus()">Ubah Status</button>
                </div>

                <div class="ms-auto d-flex gap-2 align-items-center" id="filter-container">
                    <div class="d-flex align-items-center gap-2 me-2">
                        <span class="text-nowrap text-dark small">Masa Kerja (Thn)</span>
                        <input type="number" id="filter-min" class="form-control text-center" style="width: 60px" min="0" placeholder="Min" />
                        <span class="text-muted">-</span>
                        <input type="number" id="filter-max" class="form-control text-center" style="width: 60px" min="0" placeholder="Max" />
                    </div>

                    <select id="filter-jabatan" class="form-select text-muted" style="width: 160px; background-color: #f8f9fa;">
                        <option value="">Semua Jabatan</option>
                    </select>

                    <select id="filter-kontrak" class="form-select text-muted" style="width: 150px; background-color: #f8f9fa;">
                        <option value="">Status Kontrak</option>
                        <option value="PKWTT">PKWTT</option>
                        <option value="PKWT">PKWT</option>
                        <option value="Magang">Magang</option>
                    </select>

                    <div class="input-group" style="width: 220px">
                        <input type="text" id="filter-search" class="form-control" placeholder="Cari data..">
                        <button class="btn bg-white border text-muted" onclick="applyFilters()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter text-nowrap mb-0 align-middle">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th width="1%" class="text-center"><input type="checkbox" id="check-all" class="form-check-input m-0"></th>
                        <th width="1%" class="text-muted fw-bold text-center">NO</th>
                        <th width="8%" class="text-muted fw-bold text-center">AKSI</th>
                        <th class="text-muted fw-bold">NIP</th>
                        <th class="text-muted fw-bold">NAMA</th>
                        <th class="text-muted fw-bold">JABATAN</th>
                        <th class="text-muted fw-bold">TANGGAL MASUK</th>
                        <th class="text-muted fw-bold">MASA KERJA</th>
                    </tr>
                </thead>
                <tbody id="table-pegawai-body">
                    <tr><td colspan="8" class="text-center py-4 text-muted">Memuat data dari API...</td></tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-top-0 pt-4 pb-4 d-flex align-items-center justify-content-between">
            <span class="text-muted small" id="count-info">Menampilkan 0 dari 0 data</span>
            <ul class="pagination m-0 ms-auto">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">next <i class="bi bi-chevron-right ms-1"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
let allPegawaiData = [];
let currentFilteredData = []; // Menyimpan data yang sedang tampil untuk diexport
const userRoleId = <?= $roleId ?>;

document.addEventListener("DOMContentLoaded", function() {
    fetchDataPegawai();

    document.getElementById('filter-min').addEventListener('input', applyFilters);
    document.getElementById('filter-max').addEventListener('input', applyFilters);
    document.getElementById('filter-jabatan').addEventListener('change', applyFilters);
    document.getElementById('filter-kontrak').addEventListener('change', applyFilters);
    document.getElementById('filter-search').addEventListener('keyup', applyFilters);

    document.getElementById('check-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkAction();
    });
});

function toggleBulkAction() {
    const checkedCount = document.querySelectorAll('.check-item:checked').length;
    const bulkContainer = document.getElementById('bulk-action-container');
    const filterContainer = document.getElementById('filter-container');

    if (checkedCount > 0) {
        bulkContainer.classList.remove('d-none');
        filterContainer.classList.add('d-none');
    } else {
        bulkContainer.classList.add('d-none');
        filterContainer.classList.remove('d-none');
    }
}

function applyBulkStatus() {
    alert("Fitur Ubah Status Massal siap dikembangkan menuju Endpoint API!");
}

function fetchDataPegawai() {
    const token = localStorage.getItem('jwt_token') || 'DUMMY_TOKEN';

    fetch('<?= Url::to(['/api/pegawai/list']) ?>', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(res => {
        if(res.status === 'success') {
            allPegawaiData = res.data;
            currentFilteredData = res.data; // Set awal data untuk export

            document.getElementById('count-info').innerText = `Menampilkan ${allPegawaiData.length} dari ${allPegawaiData.length} data`;

            const jabatanSelect = document.getElementById('filter-jabatan');
            const uniqueJabatan = [...new Set(allPegawaiData.map(item => item.jabatan ? item.jabatan.nama : null).filter(Boolean))];
            uniqueJabatan.forEach(j => {
                jabatanSelect.innerHTML += `<option value="${j}">${j}</option>`;
            });

            renderTable(allPegawaiData);
        } else {
            showError(res.message || 'Gagal memuat data.');
        }
    })
    .catch(error => {
        console.error('Error fetching data:', error);
        showError('Gagal mengambil data dari API.');
    });
}

function renderTable(dataArray) {
    const tbody = document.getElementById('table-pegawai-body');
    tbody.innerHTML = '';
    document.getElementById('count-info').innerText = `Menampilkan ${dataArray.length} dari ${allPegawaiData.length} data`;

    document.getElementById('check-all').checked = false;
    toggleBulkAction();

    if(dataArray.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="text-center text-muted py-4">Data tidak ditemukan.</td></tr>';
        return;
    }

    dataArray.forEach((item, index) => {
        const tglMasuk = new Date(item.tanggal_masuk);
        const masaKerjaAngka = new Date().getFullYear() - tglMasuk.getFullYear();
        const masaKerja = masaKerjaAngka + ' tahun';
        const namaJabatan = item.jabatan ? item.jabatan.nama : '-';

        // URL dengan autoPrint=true untuk ikon unduh kecil
        const urlPrintDetail = `<?= Url::to(['pegawai/detail']) ?>?id=${item.id}&autoPrint=true`;

        let actionButtons = `
            <a href="<?= Url::to(['pegawai/detail']) ?>?id=${item.id}" class="text-muted text-decoration-none mx-1" title="Detail"><i class="bi bi-file-earmark-text fs-5"></i></a>
            <a href="${urlPrintDetail}" target="_blank" class="text-muted text-decoration-none mx-1" title="Download PDF"><i class="bi bi-cloud-download fs-5"></i></a>
        `;

        if (userRoleId === 3) {
            actionButtons = `
                <a href="<?= Url::to(['pegawai/tambah']) ?>?id=${item.id}" class="text-muted text-decoration-none mx-1" title="Edit"><i class="bi bi-pencil fs-5"></i></a>
                ${actionButtons}
                <a href="javascript:void(0)" class="text-danger text-decoration-none mx-1" onclick="deletePegawai(${item.id})" title="Hapus"><i class="bi bi-trash fs-5"></i></a>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="text-center"><input type="checkbox" class="form-check-input check-item m-0" value="${item.id}" onchange="toggleBulkAction()"></td>
                <td class="text-muted text-center">${index + 1}</td>
                <td class="text-center text-nowrap">
                    <div class="d-flex justify-content-center align-items-center">
                        ${actionButtons}
                    </div>
                </td>
                <td class="text-dark">${item.nip}</td>
                <td class="fw-bold text-dark">${item.nama_pegawai}</td>
                <td class="text-dark">${namaJabatan}</td>
                <td class="text-dark">${item.tanggal_masuk}</td>
                <td class="text-dark">${masaKerja}</td>
            </tr>
        `;
    });
}

function applyFilters() {
    const minStr = document.getElementById('filter-min').value;
    const maxStr = document.getElementById('filter-max').value;
    const jabatan = document.getElementById('filter-jabatan').value.toLowerCase();
    const kontrak = document.getElementById('filter-kontrak').value.toLowerCase();
    const search = document.getElementById('filter-search').value.toLowerCase();

    currentFilteredData = allPegawaiData.filter(item => {
        const tglMasuk = new Date(item.tanggal_masuk);
        const masaKerja = new Date().getFullYear() - tglMasuk.getFullYear();

        const matchMin = minStr === '' || masaKerja >= parseInt(minStr);
        const matchMax = maxStr === '' || masaKerja <= parseInt(maxStr);
        const namaJabatan = item.jabatan ? item.jabatan.nama.toLowerCase() : '';
        const statusKontrak = item.status_kontrak ? item.status_kontrak.toLowerCase() : '';
        const matchJabatan = jabatan === '' || namaJabatan === jabatan;
        const matchKontrak = kontrak === '' || statusKontrak === kontrak;

        const searchString = `${item.nip} ${item.nama_pegawai} ${namaJabatan}`.toLowerCase();
        const matchSearch = search === '' || searchString.includes(search);

        return matchMin && matchMax && matchJabatan && matchKontrak && matchSearch;
    });

    renderTable(currentFilteredData);
}

function deletePegawai(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')) {
        const token = localStorage.getItem('jwt_token') || '';
        fetch('<?= Url::to(['/api/pegawai/delete']) ?>?id=' + id, {
            method: 'DELETE',
            headers: { 'Authorization': 'Bearer ' + token }
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Data berhasil dihapus.');
                fetchDataPegawai();
            } else {
                alert(res.message || 'Gagal menghapus data.');
            }
        })
        .catch(err => alert('Terjadi kesalahan jaringan.'));
    }
}

function showError(msg) {
    document.getElementById('table-pegawai-body').innerHTML = `<tr><td colspan="8" class="text-center text-danger py-4">${msg}</td></tr>`;
}

// --- FUNGSI EXPORT EXCEL ---
function exportExcel() {
    if (currentFilteredData.length === 0) return alert("Tidak ada data untuk diexport!");

    // Mapping data agar kolomnya rapi dan berbahasa Indonesia
    const dataToExport = currentFilteredData.map((item, index) => ({
        "No": index + 1,
        "NIP": item.nip,
        "Nama Pegawai": item.nama_pegawai,
        "Jabatan": item.jabatan ? item.jabatan.nama : '-',
        "Status Kontrak": item.status_kontrak,
        "Tanggal Masuk": item.tanggal_masuk,
        "Email": item.email || '-',
        "Nomor HP": item.nomor_hp || '-'
    }));

    const worksheet = XLSX.utils.json_to_sheet(dataToExport);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Data Pegawai");

    XLSX.writeFile(workbook, "Data_Pegawai_JMC.xlsx");
}

// --- FUNGSI EXPORT PDF BULK ---
function exportBulkPDF() {
    if (currentFilteredData.length === 0) return alert("Tidak ada data untuk diexport!");

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4'); // Kertas A4, posisi Portrait

    // Header PDF
    doc.setFontSize(16);
    doc.text("Laporan Data Pegawai JMC", 14, 15);
    doc.setFontSize(10);
    doc.text("Dicetak pada: " + new Date().toLocaleDateString('id-ID'), 14, 22);

    // Format Data untuk Tabel jsPDF
    const tableData = currentFilteredData.map((item, index) => [
        index + 1,
        item.nip,
        item.nama_pegawai,
        item.jabatan ? item.jabatan.nama : '-',
        item.tanggal_masuk,
        item.status_kontrak
    ]);

    doc.autoTable({
        startY: 28,
        head: [['No', 'NIP', 'Nama Lengkap', 'Jabatan', 'Tgl Masuk', 'Status']],
        body: tableData,
        theme: 'striped',
        headStyles: { fillColor: [43, 80, 142] } // Warna biru tua (mirip tema prototipe)
    });

    doc.save("Laporan_Data_Pegawai_JMC.pdf");
}
</script>
