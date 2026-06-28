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
        'ui-vendor/npm-asset/jquery/dist/jquery.min.js',
        'ui-vendor/npm-asset/tabler--core/dist/js/tabler.min.js',
        'ui-assets/scripts/backend.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
