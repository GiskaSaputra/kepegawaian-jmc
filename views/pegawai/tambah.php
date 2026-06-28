<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Form Data Pegawai';
$this->params['breadcrumbs'][] = ['label' => 'Data Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .foto-profil { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
</style>

<div class="container-xl">
    <form id="form-pegawai">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-header border-bottom-0"><h3 class="card-title fw-bold" id="form-title">Data Diri</h3></div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-auto text-center">
                                        <img src="<?= Url::to('@web/ui-assets/images/pegawai/default.jpg') ?>" alt="Foto" id="img-preview" class="foto-profil bg-light mb-2" />
                                        <label for="unggah-foto" class="d-block form-label text-primary cursor-pointer fw-bold mt-2"><i class="bi bi-camera me-1"></i> Ubah Foto</label>
                                        <input id="unggah-foto" type="file" accept="image/png, image/jpeg, image/jpg" hidden />
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">NIP</label>
                                            <input type="text" id="nip" class="form-control" required />
                                        </div>
                                        <div>
                                            <label class="form-label text-muted">Nama Lengkap</label>
                                            <input type="text" id="nama_pegawai" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6"><label class="form-label text-muted">Email</label><input type="email" id="email" class="form-control" required /></div>
                            <div class="col-md-6"><label class="form-label text-muted">Nomor HP</label><input type="text" id="nomor_hp" class="form-control" placeholder="+628..." required /></div>

                            <div class="col-md-5"><label class="form-label text-muted">Tempat Lahir</label><input type="text" id="tempat_lahir" class="form-control" required /></div>
                            <div class="col-md-5"><label class="form-label text-muted">Tanggal Lahir</label><input type="date" id="tanggal_lahir" class="form-control" required /></div>
                            <div class="col-md-2"><label class="form-label text-muted">Usia</label><input type="number" id="usia" class="form-control bg-light" readonly /></div>

                            <div class="col-md-4">
                                <label class="form-label text-muted">Jenis Kelamin</label>
                                <select id="jenis_kelamin" class="form-select" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted">Status Pernikahan</label>
                                <select id="status_kawin" class="form-select">
                                    <option value="tidak kawin">Belum Menikah</option>
                                    <option value="kawin">Menikah</option>
                                </select>
                            </div>
                            <div class="col-md-4"><label class="form-label text-muted">Jumlah Anak</label><input type="number" id="jumlah_anak" value="0" class="form-control" /></div>

                            <div class="col-12">
                                <div class="card border border-light">
                                    <div class="card-body p-3 bg-light rounded">
                                        <label class="form-label fw-bold">Riwayat Pendidikan</label>
                                        <table class="table table-borderless align-middle mb-2">
                                            <thead>
                                                <tr>
                                                    <th class="py-0 text-muted small">Jenjang</th>
                                                    <th class="py-0 text-muted small">Nama Sekolah</th>
                                                    <th class="py-0 text-muted small">Tahun Lulus</th>
                                                    <th class="py-0"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody-pendidikan">
                                                <tr>
                                                    <td><input type="text" class="form-control edu-tingkat" placeholder="S1" /></td>
                                                    <td><input type="text" class="form-control edu-sekolah" placeholder="Universitas..." /></td>
                                                    <td><input type="number" class="form-control edu-tahun" placeholder="2020" /></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button type="button" id="btn-add-pendidikan" class="btn btn-white border btn-sm"><i class="bi bi-plus-circle me-1 text-primary"></i> Tambah Baris Pendidikan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm mb-3 border-0">
                    <div class="card-header border-bottom-0"><h3 class="card-title fw-bold">Alamat Pegawai</h3></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12"><label class="form-label text-muted">Alamat Lengkap</label><textarea id="alamat_lengkap" class="form-control" rows="3"></textarea></div>
                            <div class="col-md-4"><label class="form-label text-muted">Kecamatan</label><select id="id_kecamatan" class="form-select"><option value="1">Cempaka Putih</option></select></div>
                            <div class="col-md-4"><label class="form-label text-muted">Kabupaten</label><input type="text" class="form-control bg-light" value="Jakarta Pusat" readonly /></div>
                            <div class="col-md-4"><label class="form-label text-muted">Provinsi</label><input type="text" class="form-control bg-light" value="DKI Jakarta" readonly /></div>

                            <div class="col-md-6">
                                <label class="form-label text-primary fw-bold">Jarak Rumah - Kantor (Km)</label>
                                <input type="number" id="jarak_rumah_kantor" class="form-control border-primary" max="99" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom-0"><h3 class="card-title fw-bold">Data Kepegawaian</h3></div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12"><label class="form-label text-muted">Tanggal Masuk</label><input type="date" id="tanggal_masuk" class="form-control" required /></div>
                            <div class="col-md-6"><label class="form-label text-muted">Jabatan</label><select id="id_jabatan" class="form-select"><option value="1">Manager</option><option value="2">Staf</option><option value="3">Magang</option></select></div>
                            <div class="col-md-6"><label class="form-label text-muted">Departemen</label><select id="id_departemen" class="form-select"><option value="4">Marketing</option><option value="5">HRD</option><option value="11">Bagian Keuangan</option></select></div>
                            <div class="col-md-6"><label class="form-label text-muted">Status Kontrak</label><select id="status_kontrak" class="form-select"><option value="PKWTT">PKWTT (Tetap)</option><option value="PKWT">PKWT (Kontrak)</option><option value="Magang">Magang</option></select></div>
                            <div class="col-md-6"><label class="form-label text-muted">Status</label><select id="status" class="form-select"><option value="Aktif">Aktif</option><option value="Nonaktif">Non-Aktif</option></select></div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-4 d-flex">
                        <div class="d-flex gap-2 ms-auto">
                            <a href="<?= Url::to(['pegawai/index']) ?>" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary" id="btn-submit"><i class="bi bi-save me-2"></i> Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let fotoBase64 = ""; // Menyimpan string base64 gambar

document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('jwt_token') || 'DUMMY_TOKEN';
    const urlParams = new URLSearchParams(window.location.search);
    const idPegawai = urlParams.get('id');

    // LOGIKA UPLOAD & PREVIEW FOTO PROFIL
    document.getElementById('unggah-foto').addEventListener('change', function(e) {
        const file = this.files[0];
        if(file) {
            const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            if(!validTypes.includes(file.type)) {
                alert("Format file tidak didukung! Hanya boleh PNG atau JPG.");
                this.value = '';
                return;
            }

            // Konversi File Fisik ke Text Base64 agar bisa masuk Payload JSON API
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('img-preview').src = event.target.result;
                fotoBase64 = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    if (idPegawai) {
        document.getElementById('form-title').innerText = 'Edit Data Pegawai';
        document.getElementById('btn-submit').innerHTML = '<i class="bi bi-save me-2"></i> Update Data';

        fetch('<?= Url::to(['/api/pegawai/list']) ?>', {
            headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(res => {
            if (res.status === 'success') {
                const data = res.data.find(item => item.id == idPegawai);
                if (data) {
                    // Munculkan foto jika sebelumnya pernah upload
                    if (data.foto_pegawai) {
                        document.getElementById('img-preview').src = '<?= Url::to('@web/uploads/pegawai/') ?>' + data.foto_pegawai;
                    }

                    document.getElementById('nip').value = data.nip;
                    document.getElementById('nama_pegawai').value = data.nama_pegawai;
                    document.getElementById('email').value = data.email;
                    document.getElementById('nomor_hp').value = data.nomor_hp;
                    document.getElementById('jenis_kelamin').value = data.jenis_kelamin || 'Laki-laki';
                    document.getElementById('tempat_lahir').value = data.tempat_lahir;
                    document.getElementById('tanggal_lahir').value = data.tanggal_lahir;
                    document.getElementById('usia').value = data.usia;
                    document.getElementById('status_kawin').value = data.status_kawin;
                    document.getElementById('jumlah_anak').value = data.jumlah_anak;
                    document.getElementById('alamat_lengkap').value = data.alamat_lengkap;
                    document.getElementById('id_kecamatan').value = data.id_kecamatan;
                    document.getElementById('jarak_rumah_kantor').value = data.jarak_rumah_kantor;
                    document.getElementById('tanggal_masuk').value = data.tanggal_masuk;
                    document.getElementById('id_jabatan').value = data.id_jabatan;
                    document.getElementById('id_departemen').value = data.id_departemen;
                    document.getElementById('status_kontrak').value = data.status_kontrak;
                    document.getElementById('status').value = data.status;

                    const tbody = document.getElementById('tbody-pendidikan');
                    if (data.pendidikan && data.pendidikan.length > 0) {
                        tbody.innerHTML = '';
                        data.pendidikan.forEach(p => {
                            tbody.innerHTML += `
                                <tr>
                                    <td><input type="text" class="form-control edu-tingkat" value="${p.tingkat}" /></td>
                                    <td><input type="text" class="form-control edu-sekolah" value="${p.nama_sekolah}" /></td>
                                    <td><input type="number" class="form-control edu-tahun" value="${p.tahun_lulus}" /></td>
                                    <td><span class="text-danger cursor-pointer btn-remove"><i class="bi bi-x-circle-fill fs-3"></i></span></td>
                                </tr>
                            `;
                        });
                    }
                }
            }
        });
    }

    document.getElementById('tanggal_lahir').addEventListener('change', function() {
        if(!this.value) return;
        const dob = new Date(this.value);
        const diff_ms = Date.now() - dob.getTime();
        const age_dt = new Date(diff_ms);
        document.getElementById('usia').value = Math.abs(age_dt.getUTCFullYear() - 1970);
    });

    const tbody = document.getElementById('tbody-pendidikan');
    document.getElementById('btn-add-pendidikan').addEventListener('click', function() {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="text" class="form-control edu-tingkat" placeholder="Jenjang" /></td>
            <td><input type="text" class="form-control edu-sekolah" placeholder="Nama Institusi" /></td>
            <td><input type="number" class="form-control edu-tahun" placeholder="Tahun" /></td>
            <td><span class="text-danger cursor-pointer btn-remove"><i class="bi bi-x-circle-fill fs-3"></i></span></td>
        `;
        tbody.appendChild(tr);
    });

    tbody.addEventListener('click', function(e) {
        if(e.target.closest('.btn-remove')) e.target.closest('tr').remove();
    });

    document.getElementById('form-pegawai').addEventListener('submit', function(e) {
        e.preventDefault();

        let arrayPendidikan = [];
        document.querySelectorAll('#tbody-pendidikan tr').forEach(row => {
            arrayPendidikan.push({
                tingkat: row.querySelector('.edu-tingkat').value,
                nama_sekolah: row.querySelector('.edu-sekolah').value,
                tahun_lulus: row.querySelector('.edu-tahun').value
            });
        });

        const payload = {
            nip: document.getElementById('nip').value,
            nama_pegawai: document.getElementById('nama_pegawai').value,
            email: document.getElementById('email').value,
            nomor_hp: document.getElementById('nomor_hp').value,
            jenis_kelamin: document.getElementById('jenis_kelamin').value,
            tempat_lahir: document.getElementById('tempat_lahir').value,
            tanggal_lahir: document.getElementById('tanggal_lahir').value,
            usia: document.getElementById('usia').value,
            status_kawin: document.getElementById('status_kawin').value,
            jumlah_anak: document.getElementById('jumlah_anak').value,
            alamat_lengkap: document.getElementById('alamat_lengkap').value,
            id_kecamatan: document.getElementById('id_kecamatan').value,
            jarak_rumah_kantor: document.getElementById('jarak_rumah_kantor').value,
            tanggal_masuk: document.getElementById('tanggal_masuk').value,
            id_jabatan: document.getElementById('id_jabatan').value,
            id_departemen: document.getElementById('id_departemen').value,
            status_kontrak: document.getElementById('status_kontrak').value,
            status: document.getElementById('status').value,
            pendidikan: arrayPendidikan,
            foto_base64: fotoBase64 // <-- DATA FOTO DIKIRIM KE SINI
        };

        const apiUrl = idPegawai ? '<?= Url::to(['/api/pegawai/update']) ?>?id=' + idPegawai : '<?= Url::to(['/api/pegawai/create']) ?>';

        fetch(apiUrl, {
            method: idPegawai ? 'PUT' : 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Data Berhasil Disimpan!');
                window.location.href = '<?= Url::to(['pegawai/index']) ?>';
            } else {
                alert('Error: ' + res.message);
            }
        })
        .catch(err => alert('Terjadi kesalahan jaringan.'));
    });
});
</script>
