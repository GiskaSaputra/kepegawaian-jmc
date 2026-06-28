# 🏢 Aplikasi Kepegawaian JMC
### Uji Teknis Programmer PHP Junior — PT. JMC IT Consultant

<p align="center">
  <img src="https://img.shields.io/badge/PHP-%3E%3D8.2-blue?style=for-the-badge&logo=php" alt="PHP Version"/>
  <img src="https://img.shields.io/badge/Framework-Yii2-orange?style=for-the-badge&logo=yii" alt="Yii2"/>
  <img src="https://img.shields.io/badge/Database-MariaDB%20%2F%20MySQL-teal?style=for-the-badge&logo=mysql" alt="Database"/>
  <img src="https://img.shields.io/badge/Bootstrap-5.x-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap"/>
  <img src="https://img.shields.io/badge/Auth-JWT-red?style=for-the-badge&logo=jsonwebtokens" alt="JWT"/>
</p>

---

Aplikasi manajemen kepegawaian berbasis web yang dibangun menggunakan **Yii2 Basic Template** sebagai pemenuhan spesifikasi **Uji Teknis Programmer PHP Junior** PT. JMC IT Consultant. Aplikasi ini dilengkapi dengan sistem **RBAC statis berbasis database**, modul tunjangan transport otomatis, dan **REST API** yang diamankan dengan **JWT (JSON Web Token)**.

---

## 📋 Spesifikasi Teknis

| Komponen | Detail |
|---|---|
| **PHP Version** | `>= 8.2` |
| **Framework** | Yii2 Basic Template `~2.0.54` |
| **Database** | MariaDB / MySQL (`kepegawaian_db`) |
| **UI Library** | Bootstrap 5 (`yii2-bootstrap5`) |
| **Autentikasi API** | JWT via `firebase/php-jwt ^7.1` |
| **Mailer** | Symfony Mailer (`yii2-symfonymailer`) |
| **Session Timeout** | 3 menit (180 detik) |

---

## ⚙️ Cara Instalasi (Setup Environment)

### Prasyarat
Pastikan perangkat Anda sudah memiliki:
- PHP `>= 8.2` (dengan ekstensi `pdo_mysql`, `gd`, `mbstring`, `openssl` aktif)
- Composer
- MySQL / MariaDB
- Web Server (XAMPP, Laragon, atau WAMP)

---

### Langkah 1 — Clone Repository

Clone repositori ini ke dalam direktori server lokal Anda (misal: `htdocs` atau `www`).

```bash
git clone https://github.com/GiskaSaputra/kepegawaian-jmc.git
cd kepegawaian-jmc
```

---

### Langkah 2 — Install Dependencies

Jalankan perintah Composer untuk mengunduh semua package yang dibutuhkan.

```bash
composer install
```

---

### Langkah 3 — Setup Database

1. Buka **phpMyAdmin** atau DBMS pilihan Anda.
2. Buat database baru dengan nama:

   ```
   kepegawaian_db
   ```

3. Import file SQL yang disertakan di folder utama repositori:

   ```
   kepegawaian_db.sql
   ```

---

### Langkah 4 — Konfigurasi Database

Buka file `config/db.php` dan sesuaikan kredensial database dengan environment lokal Anda:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn'      => 'mysql:host=localhost;dbname=kepegawaian_db',
    'username' => 'root',   // Sesuaikan
    'password' => '',       // Sesuaikan
    'charset'  => 'utf8mb4',
];
```

---

### Langkah 5 — Jalankan Aplikasi

**Opsi A** — Menggunakan XAMPP / Laragon:

Akses melalui browser:
```
http://localhost/kepegawaian-jmc/web
```

**Opsi B** — Menggunakan server bawaan Yii2:

```bash
php yii serve --port=8080
```

Kemudian akses di browser:
```
http://localhost:8080
```

---

## 🔐 Akun Login & Role

Aplikasi menggunakan sistem **Role Based Access Control (RBAC) Statis berbasis database** dengan 3 tingkatan peran:

| No | Role | Username | Password |
|:---:|---|---|---|
| 1 | **Superadmin** | `superadmin` | `superadmin123` |
| 2 | **Manager HRD** | `manager_hrd` | `manager123` |
| 3 | **Admin HRD** | `admin_hrd` | `adminhrd123` |

---

## 🗂️ Fitur & Hak Akses per Role

### Matriks Hak Akses

| Modul / Fitur | Superadmin | Manager HRD | Admin HRD |
|---|:---:|:---:|:---:|
| Login / Logout | ✅ | ✅ | ✅ |
| Dashboard | ✅ | ✅ (dengan statistik) | ✅ |
| Profil & Ganti Password | ✅ | ✅ | ✅ |
| **Kelola Role** | ✅ | ❌ | ❌ |
| **Kelola User** (CRUD) | ✅ | ❌ | ❌ |
| **Log Aktivitas** | ✅ | ❌ | ❌ |
| **Data Pegawai** (Lihat) | ❌ | ✅ | ✅ |
| **Data Pegawai** (CRUD via API) | ❌ | ❌ | ✅ |
| **Tunjangan Transport** (Lihat) | ❌ | ✅ | ✅ |
| **Tunjangan Transport** (Setting & Hitung) | ❌ | ❌ | ✅ |

---

### 📌 Detail Fitur per Modul

#### 1. Dashboard
- **Superadmin**: Halaman sambutan dengan informasi profil pengguna.
- **Manager HRD**: Menampilkan **statistik ringkas** jumlah pegawai aktif, breakdown per jenis kontrak (PKWT, PKWTT, Magang), dan daftar 5 pegawai terbaru.

#### 2. Kelola Role (Superadmin)
- Melihat daftar seluruh role yang terdaftar.
- Melihat detail **Matriks Hak Akses** per role secara terperinci.

#### 3. Kelola User (Superadmin)
- Operasi CRUD lengkap untuk manajemen akun pengguna.
- Fitur pencarian pegawai dinamis (AJAX) saat membuat akun baru.
- Pengaturan status aktif/nonaktif akun.
- Proteksi: tidak dapat menghapus akun sendiri.

#### 4. Data Pegawai (via REST API)
Pengelolaan data pegawai dilakukan melalui **REST API** yang diamankan dengan **JWT Bearer Token**. Admin HRD mendapatkan hak CRUD penuh, sedangkan Manager HRD hanya dapat membaca data.

| Field Utama | Keterangan |
|---|---|
| NIP | Minimal 8 digit angka, harus unik |
| Nama Pegawai | Hanya huruf, angka, spasi, dan petik atas |
| Jenis Kelamin, Status Kawin | Enum |
| Nomor HP | Format internasional (`+62...`) |
| Jabatan & Departemen | Relasi ke tabel `master_data` |
| Kecamatan | Relasi ke tabel `master_wilayah` |
| Jarak Rumah–Kantor | Integer, maks. 2 digit (untuk kalkulasi tunjangan) |
| Foto Pegawai | Upload via Base64 (PNG, JPG, JPEG) |
| Riwayat Pendidikan | One-to-Many (tingkat, nama sekolah, tahun lulus) |

#### 5. Modul Tunjangan Transport (Admin HRD)
Kalkulasi tunjangan transport otomatis berdasarkan jarak rumah ke kantor dan kehadiran:

- **Setting Tarif**: Mengatur biaya per km (`base_fare`), jarak minimum (`min_km`), dan jarak maksimum (`max_km`).
- **Generate Bulan**: Membuat periode tunjangan baru untuk bulan berjalan.
- **Hitung Tunjangan**: Kalkulasi otomatis untuk seluruh pegawai berstatus **PKWTT (Tetap)** dan **Aktif**.

**Formula Kalkulasi:**
```
Syarat: Jarak > min_km DAN Hari Masuk >= 19 hari

Nominal = base_fare × min(jarak, max_km) × hari_masuk
```

#### 6. Log Aktivitas (Superadmin)
Seluruh aktivitas pengguna (login, logout, CRUD, akses halaman) dicatat secara otomatis ke tabel `activities`, mencakup: judul aksi, deskripsi, IP Address, User Agent, waktu, dan URL yang diakses.

---

## 🔌 REST API Documentation

Base URL: `http://localhost:8080/api`

Seluruh endpoint API wajib menyertakan **JWT Bearer Token** di header:
```
Authorization: Bearer <your_jwt_token>
```

> **Catatan:** Token JWT digenerate secara otomatis saat login berhasil melalui web dan disimpan di sesi. Untuk pengujian API eksternal, gunakan endpoint `/api/auth/login`.

---

### Endpoint Auth

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| `POST` | `/api/auth/login` | Login & mendapatkan JWT Token | All |

---

### Endpoint Pegawai

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| `GET` | `/api/pegawai/list` | Mengambil daftar seluruh pegawai | Manager HRD, Admin HRD |
| `POST` | `/api/pegawai/create` | Menambahkan data pegawai baru | Admin HRD |
| `PUT` | `/api/pegawai/update?id={id}` | Memperbarui data pegawai | Admin HRD |
| `DELETE` | `/api/pegawai/delete?id={id}` | Menghapus data pegawai | Admin HRD |

**Catatan Akses:**
- `Superadmin` **tidak diizinkan** mengakses endpoint data pegawai.
- `Manager HRD` hanya dapat mengakses `list` (read-only).
- `Admin HRD` memiliki akses penuh (CRUD).

---

### Contoh Request Body — `POST /api/pegawai/create`

```json
{
  "nip": "199002152012022001",
  "nama_pegawai": "Ahmad Fauzi",
  "jenis_kelamin": "Laki-laki",
  "email": "ahmad.fauzi@email.com",
  "nomor_hp": "+6282211223344",
  "tempat_lahir": "Cilacap",
  "tanggal_lahir": "1990-02-15",
  "status_kawin": "Menikah",
  "tanggal_masuk": "2023-01-10",
  "id_jabatan": 1,
  "id_departemen": 2,
  "id_kecamatan": 5,
  "status": "Aktif",
  "status_kontrak": "PKWTT",
  "jarak_rumah_kantor": 12,
  "jumlah_anak": 2,
  "foto_base64": "data:image/jpeg;base64,/9j/4AAQ...",
  "pendidikan": [
    {
      "tingkat": "S1",
      "nama_sekolah": "Universitas Jenderal Soedirman",
      "tahun_lulus": 2013
    }
  ]
}
```

---

## 🏗️ Struktur Direktori Proyek

```
kepegawaian-jmc/
├── assets/             # Asset bundler (AppAsset)
├── commands/           # Yii console commands
├── components/         # Komponen custom (LogBehavior, dll.)
├── config/             # Konfigurasi aplikasi
│   ├── db.php          # Konfigurasi koneksi database ⭐
│   ├── web.php         # Konfigurasi aplikasi web
│   └── params.php      # Parameter global
├── controllers/        # Controller web
│   ├── SiteController.php      # Login, Logout, Dashboard, Profil
│   ├── UserController.php      # Kelola User (Superadmin)
│   ├── RoleController.php      # Kelola Role & Hak Akses (Superadmin)
│   ├── PegawaiController.php   # Tampilan data pegawai (web)
│   ├── TunjanganController.php # Modul Tunjangan Transport
│   ├── LogController.php       # Log Aktivitas (Superadmin)
│   └── api/
│       ├── AuthController.php      # API: Login & JWT
│       └── PegawaiController.php   # API: CRUD Pegawai (JWT Protected)
├── models/             # Model ActiveRecord
│   ├── User.php                # Model user & autentikasi
│   ├── UserRole.php            # Model role pengguna
│   ├── Pegawai.php             # Model data pegawai (validasi lengkap)
│   ├── PegawaiPendidikan.php   # Model riwayat pendidikan (One-to-Many)
│   ├── MasterData.php          # Master jabatan & departemen
│   ├── MasterWilayah.php       # Master data wilayah/kecamatan
│   ├── TunjanganBulan.php      # Model periode tunjangan bulanan
│   ├── TunjanganDetail.php     # Model detail penerima tunjangan
│   ├── TunjanganSetting.php    # Model pengaturan tarif tunjangan
│   ├── Activities.php          # Model log aktivitas
│   └── LoginForm.php           # Form model untuk login
├── views/              # Tampilan (template PHP)
│   ├── layouts/        # Layout utama (header, sidebar, footer)
│   ├── site/           # View: dashboard, login, profil, ganti password
│   ├── user/           # View: kelola user
│   ├── role/           # View: kelola role & hak akses
│   ├── pegawai/        # View: data pegawai
│   ├── tunjangan/      # View: modul tunjangan
│   └── log/            # View: log aktivitas
├── web/                # Document root (index.php, assets, uploads)
│   └── uploads/
│       └── pegawai/    # Direktori foto pegawai (auto-created)
├── swagger.yaml        # Dokumentasi API (OpenAPI 3.0)
├── composer.json       # Dependensi PHP
└── yii                 # Yii CLI entry point
```

---

## 🛡️ Keamanan & Validasi

- **Password Hashing**: Menggunakan `Yii::$app->security->generatePasswordHash()` (bcrypt).
- **Ganti Password**: Validasi kekuatan password — minimal 8 karakter, mengandung huruf besar, huruf kecil, dan karakter spesial.
- **JWT API**: Semua endpoint API dilindungi token JWT dengan masa berlaku **2 jam**.
- **RBAC Static**: Proteksi akses berbasis `id_role` diterapkan di level `behaviors()` setiap controller.
- **Session Timeout**: Sesi web otomatis berakhir setelah **3 menit** tidak aktif.
- **CSRF Validation**: Aktif untuk semua form web (dinonaktifkan khusus untuk API endpoint).
- **Validasi Input**: Diterapkan ketat di layer model menggunakan Yii2 validation rules (format NIP, HP, email, dll.).
- **Audit Trail**: Seluruh aksi pengguna direkam otomatis ke tabel `activities`.

---

## 📦 Dependensi Utama

| Package | Versi | Fungsi |
|---|---|---|
| `yiisoft/yii2` | `~2.0.54` | Framework utama |
| `yiisoft/yii2-bootstrap5` | `~2.0.2` | Komponen UI Bootstrap 5 |
| `yiisoft/yii2-symfonymailer` | `~2.0.3` | Layanan pengiriman email |
| `firebase/php-jwt` | `^7.1` | Generate & validasi JWT Token |

---

## 👨‍💻 Pengembang

<table>
  <tr>
    <td align="center">
      <b>Giska Saputra</b><br/>
      Mahasiswa Teknik Informatika<br/>
      Politeknik Negeri Cilacap<br/>
      <br/>
      Dikembangkan untuk <b>Tes Uji Teknis</b><br/>
      PT. JMC IT Consultant, 2026
    </td>
  </tr>
</table>

---

<p align="center">
  <sub>© 2026 Giska Saputra · Politeknik Negeri Cilacap · Magang JMC Indonesia</sub>
</p>
