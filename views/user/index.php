<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manajemen User';
$this->params['breadcrumbs'][] = $this->title;

$currentUserId = Yii::$app->user->identity->id;
?>

<div class="col-auto ms-auto d-print-none mb-3 text-end">
    <a href="javascript:void(0)" class="btn btn-danger d-none d-sm-inline-block btn-add">
        <i class="bi bi-plus"></i> Tambah Data
    </a>
</div>

<div class="container-xl">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><?= Yii::$app->session->getFlash('success') ?></div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><?= Yii::$app->session->getFlash('error') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom-0 pt-3 pb-3">
            <div class="ms-auto d-flex gap-2">
                <select id="filter-role" class="form-select" style="width:160px;">
                    <option value="">Semua Role</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= $r->id ?>"><?= Html::encode($r->nama_role) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group" style="width: 250px;">
                    <input type="text" id="filter-search" class="form-control" placeholder="Cari NAMA / USERNAME..">
                    <button class="btn bg-white border"><i class="bi bi-search text-muted"></i></button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter text-nowrap mb-0 align-middle">
                <thead>
                    <tr>
                        <th width="1%" class="text-muted fw-bold text-center">NO</th>
                        <th width="1%" class="text-muted fw-bold text-center">ACTION</th>
                        <th class="text-muted fw-bold">NAMA PENGGUNA</th>
                        <th class="text-muted fw-bold">USERNAME</th>
                        <th class="text-muted fw-bold">JABATAN</th>
                        <th class="text-muted fw-bold">DEPARTEMEN</th>
                        <th class="text-muted fw-bold">ROLE</th>
                        <th class="text-muted fw-bold text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody id="table-user-body">
                    <?php $number = 1; foreach ($users as $item): ?>
                        <?php
                            // Persiapkan variabel nama, jabatan, dll agar mudah difilter oleh JS
                            $namaPegawai = $item->pegawai->nama_pegawai ?? $item->nama ?? 'Admin System';
                            $namaJabatan = $item->pegawai->jabatan->nama ?? '-';
                            $namaDept = $item->pegawai->departemen->nama ?? '-';

                            // Gabungkan semua teks untuk pencarian real-time
                            $searchData = strtolower($namaPegawai . ' ' . $item->username . ' ' . $namaJabatan);
                        ?>

                        <tr class="user-row" data-role="<?= $item->id_role ?>" data-search="<?= Html::encode($searchData) ?>">
                            <td class="text-muted text-center row-number"><?= $number++ ?></td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="javascript:void(0)" class="text-dark btn-edit"
                                        data-id="<?= $item->id ?>"
                                        data-id_pegawai="<?= $item->id_pegawai ?>"
                                        data-nama="<?= Html::encode($namaPegawai) ?>"
                                        data-username="<?= Html::encode($item->username) ?>"
                                        data-jabatan="<?= Html::encode($namaJabatan) ?>"
                                        data-departemen="<?= Html::encode($namaDept) ?>"
                                        data-id_role="<?= $item->id_role ?>"
                                        data-status="<?= $item->disabled ?>"
                                        title="Edit">
                                        <i class="bi bi-pencil fs-4"></i>
                                    </a>

                                    <?php if ($item->id !== $currentUserId): ?>
                                        <a href="<?= Url::to(['delete', 'id' => $item->id]) ?>" class="text-danger"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                                            <i class="bi bi-trash fs-4"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" title="Tidak bisa menghapus diri sendiri"><i class="bi bi-trash fs-4"></i></span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td class="text-dark fw-bold"><?= Html::encode($namaPegawai) ?></td>
                            <td class="text-dark"><?= Html::encode($item->username) ?></td>
                            <td class="text-dark"><?= Html::encode($namaJabatan) ?></td>
                            <td class="text-dark"><?= Html::encode($namaDept) ?></td>

                            <td class="text-dark">
                                <?= Html::encode($item->id_role == 1 ? 'Super Admin' : ($item->id_role == 2 ? 'Manager HRD' : 'Admin')) ?>
                            </td>

                            <td class="text-center">
                                <?php if($item->disabled == 0): ?>
                                    <i class="bi bi-check-circle-fill text-success fs-3" title="Aktif"></i>
                                <?php else: ?>
                                    <i class="bi bi-x-circle-fill text-danger fs-3" title="Non-Aktif"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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

<div class="modal fade modal-blur" id="modal-form-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= Url::to(['create']) ?>" method="POST" class="modal-content" id="form-user">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" name="id_pegawai" id="id_pegawai" required />

            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-user">Form Manajemen User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 position-relative" style="z-index: 9999;">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_search" class="form-control" placeholder="Ketik min. 2 huruf..." autocomplete="off" />
                    <ul class="list-group position-absolute w-100 shadow-lg bg-white" id="suggest-box" style="display:none; top: 100%; left: 0; max-height: 200px; overflow-y: auto; border: 1px solid #e6e8eb; border-radius: 4px;"></ul>
                    <small class="text-muted d-none" id="edit-nama-hint">Nama pengguna diambil dari data pegawai dan tidak dapat diubah di sini.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required />
                    <small class="text-danger d-none" id="username-error">Min 6 karakter, huruf kecil, tanpa spasi.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <select id="jabatan_show" class="form-select bg-light" disabled>
                        <option value="" selected disabled>Pilih terlebih dahulu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select id="departemen_show" class="form-select bg-light" disabled>
                        <option value="" selected disabled>Pilih terlebih dahulu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="id_role" id="id_role" class="form-select" required>
                        <option value="" selected disabled>Pilih terlebih dahulu</option>
                        <?php foreach ($roles as $r): ?>
                            <option value="<?= $r->id ?>"><?= Html::encode($r->nama_role) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="text" name="password" id="password" class="form-control bg-light" readonly placeholder="Akan digenerate otomatis..." />
                        <button type="button" class="btn btn-primary" id="btn-generate">Generate</button>
                    </div>
                    <small class="text-muted" id="password-hint">Biarkan kosong saat edit jika tidak ingin merubah password.</small>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <label class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status" checked />
                        <span class="form-check-label">Aktif</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex gap-2 ms-auto">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit" disabled><i class="bi bi-check me-1"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // ==========================================
        // FITUR FILTER & PENCARIAN REALTIME (JS)
        // ==========================================
        const filterRole = document.getElementById('filter-role');
        const filterSearch = document.getElementById('filter-search');

        function applyTableFilter() {
            const roleValue = filterRole.value;
            const searchValue = filterSearch.value.toLowerCase();
            const rows = document.querySelectorAll('.user-row');
            let counter = 1;

            rows.forEach(row => {
                const rowRole = row.getAttribute('data-role');
                const rowSearch = row.getAttribute('data-search');

                const matchRole = (roleValue === "" || rowRole === roleValue);
                const matchSearch = (searchValue === "" || rowSearch.includes(searchValue));

                if (matchRole && matchSearch) {
                    row.style.display = '';
                    row.querySelector('.row-number').innerText = counter++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        filterRole.addEventListener('change', applyTableFilter);
        filterSearch.addEventListener('keyup', applyTableFilter);
        // ==========================================

        const myModal = new bootstrap.Modal(document.getElementById('modal-form-user'));
        const formUser = document.getElementById('form-user');
        const modalTitle = document.getElementById('modal-title-user');

        const searchInput = document.getElementById('nama_search');
        const suggestBox = document.getElementById('suggest-box');
        const inputIdPegawai = document.getElementById('id_pegawai');
        const inputUsername = document.getElementById('username');
        const usernameError = document.getElementById('username-error');
        const jabatanShow = document.getElementById('jabatan_show');
        const departemenShow = document.getElementById('departemen_show');
        const inputRole = document.getElementById('id_role');
        const inputPassword = document.getElementById('password');
        const inputStatus = document.getElementById('status');
        const btnSubmit = document.getElementById('btn-submit');
        const hintNama = document.getElementById('edit-nama-hint');

        document.querySelectorAll('.btn-add').forEach(btn => {
            btn.addEventListener('click', () => {
                formUser.reset();
                formUser.action = '<?= Url::to(['create']) ?>';
                modalTitle.innerText = 'Tambah User Baru';

                inputIdPegawai.value = '';
                searchInput.removeAttribute('readonly');
                searchInput.classList.remove('bg-light');
                hintNama.classList.add('d-none');

                jabatanShow.innerHTML = '<option value="" selected disabled>Pilih terlebih dahulu</option>';
                departemenShow.innerHTML = '<option value="" selected disabled>Pilih terlebih dahulu</option>';

                inputPassword.setAttribute('required', 'true');
                inputStatus.checked = true;

                validateAll();
                myModal.show();
            });
        });

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                formUser.reset();

                formUser.action = '<?= Url::to(['update']) ?>?id=' + this.dataset.id;
                modalTitle.innerText = 'Edit Data User';

                inputIdPegawai.value = this.dataset.id_pegawai;

                searchInput.value = this.dataset.nama;
                searchInput.setAttribute('readonly', 'true');
                searchInput.classList.add('bg-light');
                hintNama.classList.remove('d-none');

                inputUsername.value = this.dataset.username;
                jabatanShow.innerHTML = `<option>${this.dataset.jabatan}</option>`;
                departemenShow.innerHTML = `<option>${this.dataset.departemen}</option>`;
                inputRole.value = this.dataset.id_role;

                inputPassword.removeAttribute('required');
                inputPassword.value = '';

                inputStatus.checked = (this.dataset.status == 0);

                validateAll();
                myModal.show();
            });
        });

        searchInput.addEventListener('keyup', function () {
            if (this.hasAttribute('readonly')) return;

            const val = this.value;
            if (val.length >= 2) {
                fetch(`<?= Url::to(['/user/cari-pegawai']) ?>?q=${val}`)
                    .then(r => r.json())
                    .then(data => {
                        suggestBox.innerHTML = '';
                        if (data.length > 0) {
                            suggestBox.style.display = 'block';
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.className = 'list-group-item list-group-item-action cursor-pointer';
                                li.innerText = item.text;
                                li.onclick = function () {
                                    searchInput.value = item.text;
                                    inputIdPegawai.value = item.id;
                                    jabatanShow.innerHTML = `<option>${item.jabatan}</option>`;
                                    departemenShow.innerHTML = `<option>${item.departemen}</option>`;
                                    suggestBox.style.display = 'none';
                                    validateAll();
                                };
                                suggestBox.appendChild(li);
                            });
                        } else {
                            suggestBox.style.display = 'none';
                        }
                    });
            } else {
                suggestBox.style.display = 'none';
                inputIdPegawai.value = '';
            }
        });

        inputUsername.addEventListener('keyup', function () {
            const val = this.value;
            const isValid = /^[a-z0-9]{6,}$/.test(val);

            if (!isValid && val.length > 0) {
                this.classList.add('is-invalid');
                usernameError.classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                usernameError.classList.add('d-none');
            }
            validateAll();
        });

        document.getElementById('btn-generate').addEventListener('click', function () {
            const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const lower = "abcdefghijklmnopqrstuvwxyz";
            const num = "0123456789";
            const sym = "!@#$%^&*()_+~";
            const all = upper + lower + num + sym;

            let pass = "";
            pass += upper[Math.floor(Math.random() * upper.length)];
            pass += lower[Math.floor(Math.random() * lower.length)];
            pass += num[Math.floor(Math.random() * num.length)];
            pass += sym[Math.floor(Math.random() * sym.length)];

            for (let i = 0; i < 4; i++) {
                pass += all[Math.floor(Math.random() * all.length)];
            }

            pass = pass.split('').sort(() => 0.5 - Math.random()).join('');

            inputPassword.value = pass;
            validateAll();
        });

        function validateAll() {
            const hasPegawai = inputIdPegawai.value !== "";
            const isUsernameValid = /^[a-z0-9]{6,}$/.test(inputUsername.value);

            const isPasswordValid = inputPassword.hasAttribute('required') ? inputPassword.value !== "" : true;

            if (hasPegawai && isUsernameValid && isPasswordValid) {
                btnSubmit.removeAttribute('disabled');
            } else {
                btnSubmit.setAttribute('disabled', 'true');
            }
        }
    });
</script>
