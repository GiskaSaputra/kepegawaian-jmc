<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\MasterData;
use app\models\MasterWilayah;
use app\models\UserRole;
use app\models\RolePermission;
use app\models\User;
use app\models\Pegawai;
use app\models\PegawaiPendidikan;
use app\models\Activities;

class SeederController extends Controller
{
    /**
     * Run all seeders in order
     */
    public function actionIndex()
    {
        echo "Starting seed...\n";

        $this->actionMasterData();
        $this->actionMasterWilayah();
        $this->actionUserRole();
        $this->actionRolePermission();
        $this->actionUser();
        $this->actionPegawai();
        $this->actionPegawaiPendidikan();
        $this->actionActivities();

        echo "All seeders completed!\n";
        return ExitCode::OK;
    }

    public function actionMasterData()
    {
        $data = [
            ['nama' => 'Manager', 'tipe' => 'jabatan'],
            ['nama' => 'Staf', 'tipe' => 'jabatan'],
            ['nama' => 'Magang', 'tipe' => 'jabatan'],
            ['nama' => 'Marketing', 'tipe' => 'departemen'],
            ['nama' => 'HRD', 'tipe' => 'departemen'],
            ['nama' => 'Production', 'tipe' => 'departemen'],
            ['nama' => 'Executive', 'tipe' => 'departemen'],
            ['nama' => 'Commissioner', 'tipe' => 'departemen'],
            // Tambahan Departemen agar relasi Pegawai tidak error
            ['nama' => 'Sekretariat', 'tipe' => 'departemen'],
            ['nama' => 'Bagian Umum', 'tipe' => 'departemen'],
            ['nama' => 'Bagian Keuangan', 'tipe' => 'departemen'],
        ];

        foreach ($data as $row) {
            $model = new MasterData();
            $model->setAttributes($row, false); // Bypass safe attributes check
            $model->save(false);
        }
        echo "master_data seeded: " . count($data) . " rows\n";
    }

    public function actionMasterWilayah()
    {
        $data = [
            ['kecamatan' => 'Cempaka Putih', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Johar Baru', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Kemayoran', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Sawah Besar', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Senen', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Tanah Abang', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Menteng', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Gambir', 'kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Kebon Jeruk', 'kabupaten' => 'Jakarta Barat', 'provinsi' => 'DKI Jakarta'],
            ['kecamatan' => 'Kebayoran Baru', 'kabupaten' => 'Jakarta Selatan', 'provinsi' => 'DKI Jakarta'],
        ];

        foreach ($data as $row) {
            $model = new MasterWilayah();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "master_wilayah seeded: " . count($data) . " rows\n";
    }

    public function actionUserRole()
    {
        $data = [
            ['nama_role' => 'Superadmin'],
            ['nama_role' => 'Manager HRD'],
            ['nama_role' => 'Admin HRD'],
        ];

        foreach ($data as $row) {
            $model = new UserRole();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "user_role seeded: " . count($data) . " rows\n";
    }

    public function actionRolePermission()
    {
        $permissions = [
            1 => [
                'kelola_role'                 => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'kelola_user'                 => ['akses' => 1, 'create' => 1, 'read' => 'All', 'update' => 1, 'delete' => 1],
                'my_profile'                  => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 1, 'delete' => 0],
                'dashboard'                   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'modul_pegawai'               => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'modul_tunjangan_transport'   => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'setting_tunjangan_transport' => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'modul_log'                   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
            ],
            2 => [
                'kelola_role'                 => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'kelola_user'                 => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'my_profile'                  => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 1, 'delete' => 0],
                'dashboard'                   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'modul_pegawai'               => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'modul_tunjangan_transport'   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'setting_tunjangan_transport' => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'modul_log'                   => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
            ],
            3 => [
                'kelola_role'                 => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'kelola_user'                 => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
                'my_profile'                  => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 1, 'delete' => 0],
                'dashboard'                   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'modul_pegawai'               => ['akses' => 1, 'create' => 1, 'read' => 'All', 'update' => 1, 'delete' => 1],
                'modul_tunjangan_transport'   => ['akses' => 1, 'create' => 0, 'read' => 'All', 'update' => 0, 'delete' => 0],
                'setting_tunjangan_transport' => ['akses' => 1, 'create' => 1, 'read' => 'All', 'update' => 1, 'delete' => 1],
                'modul_log'                   => ['akses' => 0, 'create' => 0, 'read' => 'No',  'update' => 0, 'delete' => 0],
            ],
        ];

        $count = 0;
        foreach ($permissions as $roleId => $moduls) {
            foreach ($moduls as $modul => $perms) {
                $model = new RolePermission();
                $model->id_role = $roleId;
                $model->modul_fitur = $modul;
                $model->setAttributes($perms, false);
                $model->save(false);
                $count++;
            }
        }
        echo "role_permission seeded: " . $count . " rows\n";
    }

    public function actionUser()
    {
        $data = [
            [
                'id_role' => 1,
                'username' => 'superadmin',
                'password_hash' => Yii::$app->security->generatePasswordHash('superadmin123'),
                'nama' => 'Superadmin',
                'email' => 'superadmin@kepegawaian.go.id',
                'disabled' => 0,
            ],
            [
                'id_role' => 2,
                'username' => 'manager_hrd',
                'password_hash' => Yii::$app->security->generatePasswordHash('manager123'),
                'nama' => 'Agus Prasetyo',
                'email' => 'agus.prasetyo@kepegawaian.go.id',
                'disabled' => 0,
            ],
            [
                'id_role' => 3,
                'username' => 'admin_hrd',
                'password_hash' => Yii::$app->security->generatePasswordHash('adminhrd123'),
                'nama' => 'Rina Marlina',
                'email' => 'rina.marlina@kepegawaian.go.id',
                'disabled' => 0,
            ],
        ];

        foreach ($data as $row) {
            $model = new User();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "user seeded: " . count($data) . " rows\n";
    }

    public function actionPegawai()
    {
        $data = [
            [
                'nip' => '198501012010011001',
                'nama_pegawai' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@kepegawaian.go.id',
                'nomor_hp' => '081234567890',
                'tempat_lahir' => 'Jakarta',
                'id_kecamatan' => 1,
                'alamat_lengkap' => 'Jl. Merdeka No. 10, Cempaka Putih',
                'jarak_rumah_kantor' => 5,
                'tanggal_lahir' => '1985-01-01',
                'status_kawin' => 'kawin',
                'jumlah_anak' => 2,
                'tanggal_masuk' => '2010-01-15',
                'id_jabatan' => 1,
                'id_departemen' => 9,
                'usia' => 41,
                'status' => 'Aktif',
                'status_kontrak' => 'PKWTT' // Asumsi untuk tunjangan transport
            ],
            [
                'nip' => '199002152012022001',
                'nama_pegawai' => 'Rina Marlina',
                'email' => 'rina.marlina@kepegawaian.go.id',
                'nomor_hp' => '081234567891',
                'tempat_lahir' => 'Bandung',
                'id_kecamatan' => 3,
                'alamat_lengkap' => 'Jl. Kemayoran Jaya No. 25',
                'jarak_rumah_kantor' => 8,
                'tanggal_lahir' => '1990-02-15',
                'status_kawin' => 'kawin',
                'jumlah_anak' => 1,
                'tanggal_masuk' => '2012-02-20',
                'id_jabatan' => 1,
                'id_departemen' => 11,
                'usia' => 36,
                'status' => 'Aktif',
                'status_kontrak' => 'PKWTT'
            ],
            [
                'nip' => '199208302015032002',
                'nama_pegawai' => 'Budi Santoso',
                'email' => 'budi.santoso@kepegawaian.go.id',
                'nomor_hp' => '081234567892',
                'tempat_lahir' => 'Surabaya',
                'id_kecamatan' => 5,
                'alamat_lengkap' => 'Jl. Senen Raya No. 88',
                'jarak_rumah_kantor' => 3,
                'tanggal_lahir' => '1992-08-30',
                'status_kawin' => 'tidak kawin',
                'jumlah_anak' => 0,
                'tanggal_masuk' => '2015-03-10',
                'id_jabatan' => 2,
                'id_departemen' => 10,
                'usia' => 33,
                'status' => 'Aktif',
                'status_kontrak' => 'PKWT'
            ],
            [
                'nip' => '198811112013011003',
                'nama_pegawai' => 'Dewi Lestari',
                'email' => 'dewi.lestari@kepegawaian.go.id',
                'nomor_hp' => '081234567893',
                'tempat_lahir' => 'Yogyakarta',
                'id_kecamatan' => 8,
                'alamat_lengkap' => 'Jl. Gambir No. 5',
                'jarak_rumah_kantor' => 2,
                'tanggal_lahir' => '1988-11-11',
                'status_kawin' => 'kawin',
                'jumlah_anak' => 3,
                'tanggal_masuk' => '2013-01-05',
                'id_jabatan' => 2,
                'id_departemen' => 9,
                'usia' => 37,
                'status' => 'Aktif',
                'status_kontrak' => 'PKWT'
            ],
            [
                'nip' => '199506202018012004',
                'nama_pegawai' => 'Siti Aminah',
                'email' => 'siti.aminah@kepegawaian.go.id',
                'nomor_hp' => '081234567894',
                'tempat_lahir' => 'Semarang',
                'id_kecamatan' => 6,
                'alamat_lengkap' => 'Jl. Tanah Abang No. 12',
                'jarak_rumah_kantor' => 6,
                'tanggal_lahir' => '1995-06-20',
                'status_kawin' => 'tidak kawin',
                'jumlah_anak' => 0,
                'tanggal_masuk' => '2018-01-20',
                'id_jabatan' => 3,
                'id_departemen' => 11,
                'usia' => 31,
                'status' => 'Aktif',
                'status_kontrak' => 'Magang'
            ],
        ];

        foreach ($data as $row) {
            $model = new Pegawai();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "pegawai seeded: " . count($data) . " rows\n";
    }

    public function actionPegawaiPendidikan()
    {
        $data = [
            ['id_pegawai' => 1, 'tingkat' => 'SD', 'nama_sekolah' => 'SD Negeri 01 Jakarta', 'tahun_lulus' => 1997],
            ['id_pegawai' => 1, 'tingkat' => 'SMP', 'nama_sekolah' => 'SMP Negeri 10 Jakarta', 'tahun_lulus' => 2000],
            ['id_pegawai' => 1, 'tingkat' => 'SMA', 'nama_sekolah' => 'SMA Negeri 01 Jakarta', 'tahun_lulus' => 2003],
            ['id_pegawai' => 1, 'tingkat' => 'S1', 'nama_sekolah' => 'Universitas Indonesia', 'tahun_lulus' => 2007],
            ['id_pegawai' => 1, 'tingkat' => 'S2', 'nama_sekolah' => 'Universitas Indonesia', 'tahun_lulus' => 2010],
            ['id_pegawai' => 2, 'tingkat' => 'SD', 'nama_sekolah' => 'SD Negeri 05 Bandung', 'tahun_lulus' => 2000],
            ['id_pegawai' => 2, 'tingkat' => 'SMP', 'nama_sekolah' => 'SMP Negeri 08 Bandung', 'tahun_lulus' => 2003],
            ['id_pegawai' => 2, 'tingkat' => 'SMA', 'nama_sekolah' => 'SMA Negeri 03 Bandung', 'tahun_lulus' => 2006],
            ['id_pegawai' => 2, 'tingkat' => 'S1', 'nama_sekolah' => 'Universitas Padjadjaran', 'tahun_lulus' => 2010],
            ['id_pegawai' => 5, 'tingkat' => 'SD', 'nama_sekolah' => 'SD Negeri 12 Semarang', 'tahun_lulus' => 2005],
            ['id_pegawai' => 5, 'tingkat' => 'SMP', 'nama_sekolah' => 'SMP Negeri 07 Semarang', 'tahun_lulus' => 2008],
            ['id_pegawai' => 5, 'tingkat' => 'SMA', 'nama_sekolah' => 'SMA Negeri 02 Semarang', 'tahun_lulus' => 2011],
            ['id_pegawai' => 5, 'tingkat' => 'S1', 'nama_sekolah' => 'Universitas Diponegoro', 'tahun_lulus' => 2015],
        ];

        foreach ($data as $row) {
            $model = new PegawaiPendidikan();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "pegawai_pendidikan seeded: " . count($data) . " rows\n";
    }

    public function actionActivities()
    {
        $data = [
            [
                'title' => 'Login Aplikasi',
                'content' => 'User melakukan login ke sistem',
                'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'ip' => '127.0.0.1',
                'url' => '/site/login',
                'created_by' => 1,
            ],
            [
                'title' => 'Tambah Pegawai',
                'content' => 'Menambah data pegawai baru: Ahmad Fauzi',
                'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'ip' => '127.0.0.1',
                'url' => '/pegawai/create',
                'created_by' => 1,
            ],
            [
                'title' => 'Update Data Jabatan',
                'content' => 'Mengubah data jabatan Kepala Dinas',
                'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'ip' => '127.0.0.1',
                'url' => '/master-data/update?id=1',
                'created_by' => 1,
            ],
        ];

        foreach ($data as $row) {
            $model = new Activities();
            $model->setAttributes($row, false);
            $model->save(false);
        }
        echo "activities seeded: " . count($data) . " rows\n";
    }

    public function actionFlush()
    {
        Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=0;')->execute();

        $tables = [
            'activities', 'user', 'role_permission', 'user_role',
            'pegawai_pendidikan', 'pegawai', 'master_wilayah', 'master_data'
        ];

        foreach ($tables as $table) {
            Yii::$app->db->createCommand()->delete($table)->execute();
            Yii::$app->db->createCommand("ALTER TABLE `$table` AUTO_INCREMENT = 1;")->execute();
        }

        Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=1;')->execute();
        echo "All tables flushed safely.\n";
    }
}
