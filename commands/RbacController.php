<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class RbacController extends Controller
{
    /**
     * Seed role dan permission default
     *
     * Hak akses per role (berdasarkan tabel hak akses):
     * - Superadmin:  kelola_role=R, kelola_user=CRUD(!del self), my_profile=RO,UO, dashboard=R, modul_pegawai=-, modul_tunjangan_transport=-, setting_tunjangan_transport=-, modul_log=R
     * - Manager HRD: kelola_role=-,  kelola_user=-,      my_profile=RO,UO, dashboard=R, modul_pegawai=R,  modul_tunjangan_transport=RO, setting_tunjangan_transport=-, modul_log=-
     * - Admin HRD:   kelola_role=-,  kelola_user=-,      my_profile=RO,UO, dashboard=R, modul_pegawai=CRUD(!del superadmin), modul_tunjangan_transport=RO, setting_tunjangan_transport=CRUD, modul_log=-
     */
    public function actionSeed()
    {
        $auth = Yii::$app->authManager;

        // Roles
        $superadmin = $auth->createRole('superadmin');
        $superadmin->description = 'Superadmin';
        $auth->add($superadmin);

        $managerHrd = $auth->createRole('manager_hrd');
        $managerHrd->description = 'Manager HRD';
        $auth->add($managerHrd);

        $adminHrd = $auth->createRole('admin_hrd');
        $adminHrd->description = 'Admin HRD';
        $auth->add($adminHrd);

        // assign superadmin -> manager_hrd -> admin_hrd
        $auth->addChild($superadmin, $managerHrd);
        $auth->addChild($managerHrd, $adminHrd);

        // Permissions
        $permissions = [
            // Kelola Role
            'kelola_role-index',
            'kelola_role-view',
            // Kelola User
            'kelola_user-index',
            'kelola_user-view',
            'kelola_user-create',
            'kelola_user-update',
            'kelola_user-delete',
            // My Profile
            'my_profile-index',
            'my_profile-view',
            'my_profile-update',
            // Dashboard
            'dashboard-index',
            'dashboard-view',
            // Modul Data Pegawai
            'modul_pegawai-index',
            'modul_pegawai-view',
            'modul_pegawai-create',
            'modul_pegawai-update',
            'modul_pegawai-delete',
            // Modul Tunjangan Transport
            'modul_tunjangan_transport-index',
            'modul_tunjangan_transport-view',
            // Setting Tunjangan Transport
            'setting_tunjangan_transport-index',
            'setting_tunjangan_transport-view',
            'setting_tunjangan_transport-create',
            'setting_tunjangan_transport-update',
            'setting_tunjangan_transport-delete',
            // Modul Log
            'modul_log-index',
            'modul_log-view',
        ];

        foreach ($permissions as $name) {
            $perm = $auth->createPermission($name);
            $perm->description = ucfirst(str_replace('-', ' ', $name));
            $auth->add($perm);
            $auth->addChild($superadmin, $perm);
        }

        echo "RBAC seeded successfully!\n";
        return ExitCode::OK;
    }
}
