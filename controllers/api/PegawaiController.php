<?php
namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Pegawai;
use app\models\PegawaiPendidikan;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PegawaiController extends Controller
{
    public $enableCsrfValidation = false;

    // PERBAIKAN: Deklarasi properti penampung ID User
    public $apiUserId = null;

    // FUNGSI HELPER UNTUK MENCATAT LOG DARI API
    private function catatLogApi($aksi, $deskripsi)
    {
        // PERBAIKAN: Ambil ID dari properti class, bukan dari header lagi
        if ($this->apiUserId) {
            Yii::$app->db->createCommand()->insert('activities', [
                'title' => 'Modul Data Pegawai',
                'content' => "Melakukan aksi $aksi data pegawai: $deskripsi",
                'created_by' => $this->apiUserId,
                'created_at' => new \yii\db\Expression('NOW()'), // Waktu DB murni
                'ip' => Yii::$app->request->userIP,
                'url' => \yii\helpers\Url::current(),
            ])->execute();
        }
    }

    private function getPesanErrorSatuBaris($model)
    {
        $errors = $model->getFirstErrors();
        return !empty($errors) ? reset($errors) : 'Terjadi kesalahan validasi data.';
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isOptions) {
            return true;
        }

        $authHeader = Yii::$app->request->headers->get('Authorization');
        if ($authHeader && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
            try {
                $decoded = JWT::decode($token, new Key('RAHASIA_JMC_2026_SUPER_AMAN_32_KARAKTER_API', 'HS256'));

                // PERBAIKAN: Simpan langsung ke properti class
                $this->apiUserId = $decoded->uid;

                $userRole = $decoded->role;
                $actionId = $action->id;

                if ($userRole == 1) {
                    Yii::$app->response->statusCode = 403;
                    return ['status' => 'error', 'message' => 'Superadmin tidak diizinkan mengakses data pegawai.'];
                }

                if (in_array($actionId, ['create', 'update', 'delete']) && $userRole != 3) {
                    Yii::$app->response->statusCode = 403;
                    return ['status' => 'error', 'message' => 'Hanya Admin HRD yang memiliki hak akses untuk merubah data pegawai.'];
                }

                return parent::beforeAction($action);
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 401;
                return ['status' => 'error', 'message' => 'Token JWT tidak valid atau kedaluwarsa.'];
            }
        }

        Yii::$app->response->statusCode = 401;
        return ['status' => 'error', 'message' => 'Akses ditolak. Token JWT tidak ditemukan pada Header.'];
    }

    public function actionList()
    {
        $pegawais = Pegawai::find()->with(['jabatan', 'departemen', 'pendidikan', 'kecamatan'])->asArray()->all();
        return ['status' => 'success', 'data' => $pegawais];
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        $pegawai = new Pegawai();

        $pegawai->jenis_kelamin = $data['jenis_kelamin'] ?? 'Laki-laki';

        if ($pegawai->load($data, '') && $pegawai->save()) {

            if (!empty($data['pendidikan']) && is_array($data['pendidikan'])) {
                foreach ($data['pendidikan'] as $pend) {
                    if (empty($pend['tingkat']) && empty($pend['nama_sekolah']) && empty($pend['tahun_lulus'])) {
                        continue;
                    }
                    $pModel = new PegawaiPendidikan();
                    $pModel->id_pegawai = $pegawai->id;
                    $pModel->tingkat = $pend['tingkat'] ?? null;
                    $pModel->nama_sekolah = $pend['nama_sekolah'] ?? null;
                    $pModel->tahun_lulus = !empty($pend['tahun_lulus']) ? $pend['tahun_lulus'] : null;

                    if (!$pModel->save()) {
                        $pegawai->delete();
                        Yii::$app->response->statusCode = 400;
                        return ['status' => 'error', 'message' => 'Gagal validasi pendidikan: ' . $this->getPesanErrorSatuBaris($pModel)];
                    }
                }
            }

            if (!empty($data['foto_base64'])) {
                $imgData = $data['foto_base64'];
                if (preg_match('/^data:image\/(\w+);base64,/', $imgData, $type)) {
                    $imgData = substr($imgData, strpos($imgData, ',') + 1);
                    $type = strtolower($type[1]);

                    if (in_array($type, ['jpg', 'jpeg', 'png'])) {
                        $imgData = base64_decode($imgData);
                        $fileName = 'pegawai_' . time() . '_' . $pegawai->id . '.' . $type;

                        $filePath = Yii::getAlias('@webroot/uploads/pegawai/');
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        file_put_contents($filePath . $fileName, $imgData);
                        $pegawai->foto_pegawai = $fileName;
                        $pegawai->save(false);
                    }
                }
            }

            $this->catatLogApi('CREATE', 'Pegawai baru atas nama ' . $pegawai->nama_pegawai);
            return ['status' => 'success', 'message' => 'Data pegawai berhasil ditambahkan.'];
        }

        Yii::$app->response->statusCode = 400;
        return ['status' => 'error', 'message' => $this->getPesanErrorSatuBaris($pegawai)];
    }

    public function actionUpdate($id)
    {
        $pegawai = Pegawai::findOne($id);
        if (!$pegawai) {
            Yii::$app->response->statusCode = 404;
            return ['status' => 'error', 'message' => 'Data Pegawai tidak ditemukan.'];
        }

        $data = Yii::$app->request->getBodyParams();
        $pegawai->jenis_kelamin = $data['jenis_kelamin'] ?? $pegawai->jenis_kelamin ?? 'Laki-laki';

        if ($pegawai->load($data, '') && $pegawai->save()) {

            if (isset($data['pendidikan']) && is_array($data['pendidikan'])) {
                PegawaiPendidikan::deleteAll(['id_pegawai' => $pegawai->id]);
                foreach ($data['pendidikan'] as $pend) {
                    if (empty($pend['tingkat']) && empty($pend['nama_sekolah']) && empty($pend['tahun_lulus'])) {
                        continue;
                    }
                    $pModel = new PegawaiPendidikan();
                    $pModel->id_pegawai = $pegawai->id;
                    $pModel->tingkat = $pend['tingkat'] ?? null;
                    $pModel->nama_sekolah = $pend['nama_sekolah'] ?? null;
                    $pModel->tahun_lulus = !empty($pend['tahun_lulus']) ? $pend['tahun_lulus'] : null;

                    if (!$pModel->save()) {
                        Yii::$app->response->statusCode = 400;
                        return ['status' => 'error', 'message' => 'Gagal validasi pendidikan: ' . $this->getPesanErrorSatuBaris($pModel)];
                    }
                }
            }

            if (!empty($data['foto_base64'])) {
                $imgData = $data['foto_base64'];
                if (preg_match('/^data:image\/(\w+);base64,/', $imgData, $type)) {
                    $imgData = substr($imgData, strpos($imgData, ',') + 1);
                    $type = strtolower($type[1]);

                    if (in_array($type, ['jpg', 'jpeg', 'png'])) {
                        $imgData = base64_decode($imgData);
                        $fileName = 'pegawai_' . time() . '_' . $pegawai->id . '.' . $type;

                        $filePath = Yii::getAlias('@webroot/uploads/pegawai/');
                        if (!is_dir($filePath)) {
                            mkdir($filePath, 0777, true);
                        }

                        if ($pegawai->foto_pegawai && file_exists($filePath . $pegawai->foto_pegawai)) {
                            unlink($filePath . $pegawai->foto_pegawai);
                        }

                        file_put_contents($filePath . $fileName, $imgData);
                        $pegawai->foto_pegawai = $fileName;
                        $pegawai->save(false);
                    }
                }
            }

            $this->catatLogApi('UPDATE', 'Memperbarui data milik ' . $pegawai->nama_pegawai);
            return ['status' => 'success', 'message' => 'Data pegawai berhasil diubah.'];
        }

        Yii::$app->response->statusCode = 400;
        return ['status' => 'error', 'message' => $this->getPesanErrorSatuBaris($pegawai)];
    }

    public function actionDelete($id)
    {
        $pegawai = Pegawai::findOne($id);
        if ($pegawai) {
            $namaPegawai = $pegawai->nama_pegawai;

            if ($pegawai->foto_pegawai) {
                $filePath = Yii::getAlias('@webroot/uploads/pegawai/') . $pegawai->foto_pegawai;
                if (file_exists($filePath)) unlink($filePath);
            }

            if ($pegawai->delete()) {
                $this->catatLogApi('DELETE', 'Menghapus data pegawai ' . $namaPegawai);
                return ['status' => 'success', 'message' => 'Data pegawai berhasil dihapus.'];
            }
        }

        Yii::$app->response->statusCode = 400;
        return ['status' => 'error', 'message' => 'Gagal menghapus data pegawai.'];
    }
}
