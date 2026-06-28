<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\TunjanganBulan;
use app\models\TunjanganDetail;
use app\models\TunjanganSetting;
use app\models\Pegawai;

class TunjanganController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'detail'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return in_array(Yii::$app->user->identity->id_role, [2, 3]);
                        }
                    ],
                    [
                        'actions' => ['setting', 'buat-bulan', 'hitung'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->id_role == 3;
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('Akses ditolak. Fitur ini dibatasi berdasarkan Role Anda.');
                }
            ],
        ];
    }

    public function actionIndex()
    {
        // --- KODE PEREKAM LOG ---
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Tunjangan Transport',
            'content' => 'Membuka halaman daftar bulan berjalan (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();
        // ------------------------

        $bulanList = TunjanganBulan::find()->orderBy(['tahun' => SORT_DESC, 'id' => SORT_DESC])->all();
        return $this->render('index', ['bulanList' => $bulanList]);
    }

    public function actionSetting()
    {
        $model = TunjanganSetting::find()->one();
        if (!$model) {
            $model = new TunjanganSetting();
            $model->base_fare = 15000;
            $model->min_km = 5;
            $model->max_km = 25;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // --- KODE PEREKAM LOG ---
            Yii::$app->db->createCommand()->insert('activities', [
                'title' => 'Setting Tunjangan Transport',
                'content' => 'Memperbarui pengaturan tarif tunjangan menjadi Rp ' . number_format($model->base_fare, 0, ',', '.') . ' per km (Update)',
                'created_by' => Yii::$app->user->id,
                'created_at' => new \yii\db\Expression('NOW()'),
                'ip' => Yii::$app->request->userIP,
                'url' => \yii\helpers\Url::current(),
            ])->execute();
            // ------------------------

            Yii::$app->session->setFlash('success', 'Pengaturan tarif tunjangan berhasil disimpan.');
            return $this->redirect(['setting']);
        }

        return $this->render('setting', ['model' => $model]);
    }

    public function actionBuatBulan()
    {
        $namaBulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $m = (int)date('m');
        $y = date('Y');

        $exists = TunjanganBulan::findOne(['nama_bulan' => $namaBulan[$m], 'tahun' => $y]);
        if (!$exists) {
            $baru = new TunjanganBulan();
            $baru->nama_bulan = $namaBulan[$m];
            $baru->tahun = $y;
            $baru->total_penerima = 0;
            $baru->total_tunjangan = 0;
            $baru->save(false);

            // --- KODE PEREKAM LOG ---
            Yii::$app->db->createCommand()->insert('activities', [
                'title' => 'Modul Tunjangan Transport',
                'content' => 'Generate bulan berjalan baru: ' . $namaBulan[$m] . ' ' . $y . ' (Create)',
                'created_by' => Yii::$app->user->id,
                'created_at' => new \yii\db\Expression('NOW()'),
                'ip' => Yii::$app->request->userIP,
                'url' => \yii\helpers\Url::current(),
            ])->execute();
            // ------------------------

            Yii::$app->session->setFlash('success', 'Bulan berjalan berhasil digenerate.');
        } else {
            Yii::$app->session->setFlash('error', 'Bulan ini sudah ada di dalam daftar.');
        }
        return $this->redirect(['index']);
    }

    public function actionDetail($id)
    {
        $bulan = TunjanganBulan::findOne($id);
        if (!$bulan) {
            throw new \yii\web\NotFoundHttpException("Data tidak ditemukan.");
        }

        // --- KODE PEREKAM LOG ---
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Tunjangan Transport',
            'content' => 'Melihat detail penerima tunjangan bulan ' . $bulan->nama_bulan . ' ' . $bulan->tahun . ' (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();
        // ------------------------

        $details = TunjanganDetail::find()->where(['id_tunjangan_bulan' => $id])->with('pegawai')->all();

        return $this->render('detail', [
            'bulan' => $bulan,
            'details' => $details
        ]);
    }

    public function actionHitung($id)
    {
        $bulan = TunjanganBulan::findOne($id);
        if (!$bulan) {
            throw new \yii\web\NotFoundHttpException("Data tidak ditemukan.");
        }

        $setting = TunjanganSetting::find()->one();
        if (!$setting) {
            Yii::$app->session->setFlash('error', 'Setting tarif tunjangan belum diatur! Silakan atur di menu Pengaturan Tarif terlebih dahulu.');
            return $this->redirect(['index']);
        }

        $pegawais = Pegawai::find()->where(['status_kontrak' => 'PKWTT', 'status' => 'Aktif'])->all();

        $totalPenerima = 0;
        $totalTunjangan = 0;

        foreach ($pegawais as $pegawai) {
            $detail = TunjanganDetail::findOne(['id_tunjangan_bulan' => $id, 'id_pegawai' => $pegawai->id]);

            if (!$detail) {
                $detail = new TunjanganDetail();
                $detail->id_tunjangan_bulan = $id;
                $detail->id_pegawai = $pegawai->id;
                $detail->hari_masuk = rand(10, 25);
            }

            $jarakAsli = $pegawai->jarak_rumah_kantor ? (float)$pegawai->jarak_rumah_kantor : 0;
            $detail->km = $jarakAsli;

            $nominal = 0;

            $jarakDihitung = round($jarakAsli, 0, PHP_ROUND_HALF_UP);

            if ($jarakDihitung > $setting->min_km && $detail->hari_masuk >= 19) {
                if ($jarakDihitung > $setting->max_km) {
                    $jarakDihitung = $setting->max_km;
                }
                $nominal = $setting->base_fare * $jarakDihitung * $detail->hari_masuk;
            }

            $detail->nominal = $nominal;
            $detail->save(false);

            if ($nominal > 0) {
                $totalPenerima++;
                $totalTunjangan += $nominal;
            }
        }

        $bulan->total_penerima = $totalPenerima;
        $bulan->total_tunjangan = $totalTunjangan;
        $bulan->save(false);

        // --- KODE PEREKAM LOG ---
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Tunjangan Transport',
            'content' => 'Melakukan kalkulasi otomatis tunjangan untuk bulan ' . $bulan->nama_bulan . ' ' . $bulan->tahun . ' (Update)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();
        // ------------------------

        Yii::$app->session->setFlash('success', 'Kalkulasi tunjangan otomatis bulan ' . $bulan->nama_bulan . ' berhasil dijalankan dan disimpan permanen.');
        return $this->redirect(['detail', 'id' => $id]);
    }
}
