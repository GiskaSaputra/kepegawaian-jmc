<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->beginPage();

// Mengambil data user yang sedang login secara dinamis
if (!Yii::$app->user->isGuest) {
    $user = Yii::$app->user->identity;
    $userName = $user->nama ?: $user->username;

    // Ambil nama Role dari database
    $roleModel = \app\models\UserRole::findOne($user->id_role);
    $userRole = $roleModel ? $roleModel->nama_role : 'Administrator';

    $userInitials = strtoupper(substr($userName, 0, 2));
} else {
    $userName = 'Guest';
    $userRole = '-';
    $userInitials = 'GU';
}

// LOGIKA DETEKSI MENU AKTIF
$route = Yii::$app->controller->route;
$isDashboard = $route === 'site/index';
$isPegawai = strpos($route, 'pegawai/') === 0;
$isTunjangan = strpos($route, 'tunjangan/') === 0;
$isManajemenUser = strpos($route, 'role/') === 0 || strpos($route, 'user/') === 0;
$isLog = strpos($route, 'log/') === 0;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | Aplikasi Kepegawaian JMC</title>
    <link rel="shortcut icon" href="<?= Url::to('@web/assets/images/favicon.png') ?>">
    <?php $this->head() ?>

    <style>

        .navbar-vertical .navbar-nav .nav-item.active::after {
            display: none !important;
        }

        .navbar-dark .nav-item.active>.nav-link {
            background-color: #ffaa00 !important;
            color: #ffffff !important;
            border-radius: 4px;
            box-shadow: none !important;
        }

        .navbar-dark .nav-item.active>.nav-link::after {
            filter: brightness(0) invert(1);
        }

        .navbar-dark .dropdown-menu {
            background: transparent !important;
            box-shadow: none !important;
        }

        .navbar-dark .dropdown-item {
            color: #9aa5b1 !important;
        }

        .navbar-dark .dropdown-item:hover,
        .navbar-dark .dropdown-item.active {
            background: transparent !important;
            color: #ffffff !important;
            font-weight: 700 !important;
        }
    </style>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="page">
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark sidebar" data-bs-theme="dark">
            <div class="container-fluid px-0 justify-content-start">
                <h1 class="navbar-brand text-white ms-3 ms-lg-0 gap-3">
                    <div class="logo">
                        <img src="<?= Url::to('@web/ui-assets/images/logo_jmc.png') ?>" alt="" height="15">
                    </div>
                    <a href="<?= Url::home() ?>" class="fw-bold hstack gap-3 text-decoration-none">
                        <div style="font-size: .9rem;">Aplikasi Kepegawaian</div>
                    </a>
                </h1>
                <div class="offcanvas offcanvas-start px-lg-3" id="sidebar-menu">
                    <div class="offcanvas-header">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="image">
                                <img src="<?= Url::to('@web/assets/images/logo_jmc.png') ?>" alt="" height="15">
                            </div>
                            <div class="logo-text flex-grow-1">
                                <div class="fs-4 fw-bold">Aplikasi Kepegawaian</div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-3 p-lg-0 flex-column flex-grow-1 overflow-auto">
                        <ul class="navbar-nav align-items-start mt-lg-3">
                            <li class="nav-item <?= $isDashboard ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">
                                    <i class="bi bi-grid-1x2-fill fs-3 me-3"></i> <span>Dashboard</span>
                                </a>
                            </li>

                            <?php if (in_array(Yii::$app->user->identity->id_role, [2, 3])): ?>
                                <li class="nav-item <?= $isPegawai ? 'active' : '' ?>">
                                    <a class="nav-link" href="<?= Url::to(['/pegawai/index']) ?>">
                                        <i class="bi bi-person-fill fs-3 me-3"></i> <span>Data Pegawai</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (in_array(Yii::$app->user->identity->id_role, [2, 3])): ?>
                                <li class="nav-item dropdown <?= $isTunjangan ? 'active' : '' ?>">
                                    <a class="nav-link dropdown-toggle <?= $isTunjangan ? 'show' : '' ?>" href="#"
                                        data-bs-toggle="dropdown">
                                        <i class="bi bi-database-fill fs-3 me-3"></i><span>Tunjangan</span>
                                    </a>
                                    <div class="dropdown-menu <?= $isTunjangan ? 'show' : '' ?>">
                                        <?php if (Yii::$app->user->identity->id_role == 3): ?>
                                            <a href="<?= Url::to(['/tunjangan/setting']) ?>"
                                                class="dropdown-item <?= strpos($route, 'tunjangan/setting') === 0 ? 'active' : '' ?>">Setting
                                                Tunjangan</a>
                                        <?php endif; ?>

                                        <a href="<?= Url::to(['/tunjangan/index']) ?>"
                                            class="dropdown-item <?= strpos($route, 'tunjangan/index') === 0 || strpos($route, 'tunjangan/detail') === 0 ? 'active' : '' ?>">Tunjangan
                                            Transport</a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if (Yii::$app->user->identity->id_role == 1): ?>
                                <li class="nav-item dropdown <?= $isManajemenUser ? 'active' : '' ?>">
                                    <a class="nav-link dropdown-toggle <?= $isManajemenUser ? 'show' : '' ?>" href="#"
                                        data-bs-toggle="dropdown">
                                        <i class="bi bi-people-fill fs-3 me-3"></i><span>Manajemen User</span>
                                    </a>
                                    <div class="dropdown-menu <?= $isManajemenUser ? 'show' : '' ?>">
                                        <a href="<?= Url::to(['/role/index']) ?>"
                                            class="dropdown-item <?= strpos($route, 'role/') === 0 ? 'active' : '' ?>">Manajemen
                                            Role</a>
                                        <a href="<?= Url::to(['/user/index']) ?>"
                                            class="dropdown-item <?= strpos($route, 'user/') === 0 ? 'active' : '' ?>">Manajemen
                                            User</a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if (Yii::$app->user->identity->id_role == 1): ?>
                                <li class="nav-item <?= $isLog ? 'active' : '' ?>">
                                    <a class="nav-link" href="<?= Url::to(['/log/index']) ?>">
                                        <i class="bi bi-clock-history fs-3 me-3"></i> <span>Log Aktifitas</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <header class="navbar navbar-expand-lg d-print-none sticky-top" id="navbar">
            <div class="container-xl justify-content-between">
                <button class="sidebar-toggler d-none d-lg-block" type="button">
                    <span class="sidebar-icon"></span>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-nav flex-row order-md-last ms-md-auto">
                    <button class="nav-link px-0 btn-toggle-theme hide-theme-dark me-3" title="Enable dark mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </button>
                    <button class="nav-link px-0 btn-toggle-theme hide-theme-light me-3" title="Enable light mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7">
                            </path>
                        </svg>
                    </button>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0 dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <span class="bg-primary text-white avatar rounded-circle">
                                <?= $userInitials; ?>
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div class="fw-bold"><?= Html::encode(ucfirst($userName)); ?></div>
                                <div class="mt-1 small text-primary"><?= Html::encode($userRole); ?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="<?= Url::to(['/site/profile']) ?>" class="dropdown-item"><i
                                    class="bi bi-person me-2"></i> My Profile</a>
                            <a href="<?= Url::to(['/site/change-password']) ?>" class="dropdown-item"><i
                                    class="bi bi-key me-2"></i> Change Password</a>

                            <div class="dropdown-divider"></div>
                            <?= Html::a('<i class="bi bi-box-arrow-right me-2"></i> Logout', ['/site/logout'], [
                                'class' => 'dropdown-item text-danger',
                                'data' => ['method' => 'post']
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title"><?= Html::encode($this->title) ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->session->has('jwt_token_sync')): ?>
        <script>
            // Pindahkan token secara otomatis ke penyimpanan browser saat halaman dimuat
            localStorage.setItem('jwt_token', '<?= Yii::$app->session->get('jwt_token_sync') ?>');
        </script>
        <?php
        // Hapus session setelah token disalin agar tidak memberatkan browser
        Yii::$app->session->remove('jwt_token_sync');
        ?>
    <?php endif; ?>

    <?php $this->endBody() ?>

    <script>
    let inactivityTime = function () {
        let time;

        const maxInactivity = 180000;


        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onclick = resetTimer;
        document.onscroll = resetTimer;

        function logout() {
            alert("Sesi Anda telah habis karena tidak ada aktivitas selama 3 menit. Anda akan di-logout secara otomatis.");

            localStorage.removeItem('jwt_token');

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= \yii\helpers\Url::to(['/site/logout']) ?>';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '<?= Yii::$app->request->csrfParam ?>';
            csrfInput.value = '<?= Yii::$app->request->csrfToken ?>';
            form.appendChild(csrfInput);

            document.body.appendChild(form);
            form.submit();
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, maxInactivity);
        }
    };

    inactivityTime();
</script>
</body>

</html>
<?php $this->endPage() ?>
