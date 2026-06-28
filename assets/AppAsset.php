<?php
namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'ui-vendor/npm-asset/bootstrap-icons/font/bootstrap-icons.min.css',
        'ui-vendor/npm-asset/tabler--core/dist/css/tabler.min.css',
        'ui-assets/styles/backend.css',
    ];

    public $js = [
        // Pemanggilan jQuery manual dihapus agar tidak bentrok dengan YiiAsset
        'ui-vendor/npm-asset/tabler--core/dist/js/tabler.min.js',
        'ui-assets/scripts/backend.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
