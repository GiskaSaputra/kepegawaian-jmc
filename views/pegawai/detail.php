<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Detail Data Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Data Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .foto-profil {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .datagrid-title {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        line-height: 1.6;
        color: #6c7a91;
        margin-bottom: .25rem;
    }
    .datagrid-content {
        font-weight: 500;
        margin-bottom: 1.25rem;
        color: #1e293b;
    }

    /* CSS Khusus Print (Merapikan tampilan saat di-download sebagai PDF) */
    @media print {
        .navbar, .page-header, .btn, .card-footer, .breadcrumbs { display: none !important; }
        .card { border: none !important; box-shadow: none !important; }
        .page-wrapper { margin: 0 !important; padding: 0 !important; }
        body { background-color: #fff !important; }
    }
</style>

<div class="row align-items-center mb-3 d-print-none">
    <div class="col-auto ms-auto text-end">
        <button onclick="window.print()" class="btn btn-danger d-none d-sm-inline-block">
            <i class="bi bi-file-pdf me-2"></i> Download PDF
        </button>
    </div>
</div>

<div class="container-xl" id="printable-area">
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title fw-bold">Data Diri Pegawai</h3>
                </div>
                <div class="card-body bg-light rounded m-3 mt-0 pb-0">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="row align-items-center mb-2">
                                <div class="col-auto">
                                    <img src="<?= Url::to('@web/ui-assets/images/pegawai/default.jpg') ?>" alt="Foto Profil" class="foto-profil bg-white" id="det-foto" />
                                </div>
                                <div class="col">
                                    <div class="datagrid-title">NIP</div>
                                    <div class="datagrid-content fs-3 fw-bold text-primary" id="det-nip">-</div>

                                    <div class="datagrid-title">Nama Lengkap</div>
                                    <div class="datagrid-content fs-3 fw-bold" id="det-nama">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="datagrid-title">Email</div>
                            <div class="datagrid-content" id="det-email">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Nomor HP</div>
                            <div class="datagrid-content" id="det-hp">-</div>
                        </div>

                        <div class="col-md-6">
                            <div class="datagrid-title">Jenis Kelamin</div>
                            <div class="datagrid-content" id="det-gender">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Tempat Lahir</div>
                            <div class="datagrid-content" id="det-tempat-lahir">-</div>
                        </div>

                        <div class="col-md-6">
                            <div class="datagrid-title">Tanggal Lahir</div>
                            <div class="datagrid-content" id="det-tanggal-lahir">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Usia</div>
                            <div class="datagrid-content" id="det-usia">-</div>
                        </div>

                        <div class="col-md-6">
                            <div class="datagrid-title">Status Pernikahan</div>
                            <div class="datagrid-content text-capitalize" id="det-status-kawin">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Jumlah Anak</div>
                            <div class="datagrid-content" id="det-anak">-</div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="datagrid-title border-bottom pb-2 mb-3">Riwayat Pendidikan</div>
                            <div id="det-pendidikan">
                                <div class="datagrid-content text-muted small">Memuat data...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex flex-column gap-3">
            <div class="card shadow-sm border-0">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title fw-bold">Alamat Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="datagrid-title">Alamat Lengkap</div>
                            <div class="datagrid-content" id="det-alamat">-</div>
                        </div>
                        <div class="col-md-4">
                            <div class="datagrid-title">Kecamatan</div>
                            <div class="datagrid-content" id="det-kecamatan">-</div>
                        </div>
                        <div class="col-md-4">
                            <div class="datagrid-title">Kabupaten</div>
                            <div class="datagrid-content">Jakarta Pusat</div>
                        </div>
                        <div class="col-md-4">
                            <div class="datagrid-title">Provinsi</div>
                            <div class="datagrid-content">DKI Jakarta</div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="datagrid-title text-primary fw-bold">Jarak Rumah - Kantor</div>
                            <div class="datagrid-content mb-0 fs-3" id="det-jarak">-</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm h-100 border-0">
                <div class="card-header border-bottom-0">
                    <h3 class="card-title fw-bold">Data Kepegawaian</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="datagrid-title">Tanggal Masuk</div>
                            <div class="datagrid-content" id="det-tanggal-masuk">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Jabatan</div>
                            <div class="datagrid-content" id="det-jabatan">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Departemen</div>
                            <div class="datagrid-content" id="det-departemen">-</div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Status Kontrak</div>
                            <div class="datagrid-content"><span class="badge text-white bg-primary" id="det-kontrak">-</span></div>
                        </div>
                        <div class="col-md-6">
                            <div class="datagrid-title">Status Pegawai</div>
                            <div class="datagrid-content" id="det-status">-</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-4 d-print-none text-end">
                    <a href="<?= Url::to(['pegawai/index']) ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const idPegawai = urlParams.get('id');
    const token = localStorage.getItem('jwt_token');

    if(!idPegawai) {
        alert("ID Pegawai tidak ditemukan.");
        window.location.href = '<?= Url::to(['pegawai/index']) ?>';
        return;
    }

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
            const data = res.data.find(item => item.id == idPegawai);

            if(data) {
                // LOGIKA MENAMPILKAN FOTO REAL DARI SERVER
                const fotoReal = data.foto_pegawai ? '<?= Url::to('@web/uploads/pegawai/') ?>' + data.foto_pegawai : '<?= Url::to('@web/ui-assets/images/pegawai/default.jpg') ?>';
                document.getElementById('det-foto').src = fotoReal;

                // Mapping Data Diri
                document.getElementById('det-nip').innerText = data.nip;
                document.getElementById('det-nama').innerText = data.nama_pegawai;
                document.getElementById('det-email').innerText = data.email || '-';
                document.getElementById('det-hp').innerText = data.nomor_hp || '-';
                document.getElementById('det-gender').innerText = data.jenis_kelamin || '-';
                document.getElementById('det-tempat-lahir').innerText = data.tempat_lahir || '-';
                document.getElementById('det-tanggal-lahir').innerText = data.tanggal_lahir || '-';
                document.getElementById('det-usia').innerText = data.usia ? data.usia + ' Tahun' : '-';
                document.getElementById('det-alamat').innerText = data.alamat_lengkap || '-';
                document.getElementById('det-kecamatan').innerText = data.kecamatan ? data.kecamatan.kecamatan : '-';
                document.getElementById('det-status-kawin').innerText = data.status_kawin || '-';
                document.getElementById('det-anak').innerText = data.jumlah_anak || '0';
                document.getElementById('det-jarak').innerText = data.jarak_rumah_kantor ? data.jarak_rumah_kantor + ' Km' : '-';

                // Mapping Data Kepegawaian
                document.getElementById('det-tanggal-masuk').innerText = data.tanggal_masuk || '-';
                document.getElementById('det-jabatan').innerText = data.jabatan ? data.jabatan.nama : '-';
                document.getElementById('det-departemen').innerText = data.departemen ? data.departemen.nama : '-';
                document.getElementById('det-kontrak').innerText = data.status_kontrak || '-';

                const statusBadge = data.status === 'Aktif' ? 'bg-success' : 'bg-danger';
                document.getElementById('det-status').innerHTML = `<span class="badge text-white ${statusBadge}">${data.status}</span>`;

                const pendContainer = document.getElementById('det-pendidikan');
                pendContainer.innerHTML = '';
                if(data.pendidikan && data.pendidikan.length > 0) {
                    data.pendidikan.forEach(p => {
                        pendContainer.innerHTML += `
                        <div class="datagrid-content mb-2 border p-2 rounded bg-light">
                            <i class="bi bi-mortarboard-fill text-primary me-2"></i>
                            <span class="fw-bold">${p.tingkat}</span> — ${p.nama_sekolah} (${p.tahun_lulus})
                        </div>`;
                    });
                } else {
                    pendContainer.innerHTML = '<div class="datagrid-content text-muted">Tidak ada riwayat pendidikan.</div>';
                }
            } else {
                alert("Data pegawai tidak ditemukan.");
            }
        }
    })
    .catch(err => {
        console.error(err);
        alert("Gagal mengambil data detail pegawai.");
    });
});
</script>
