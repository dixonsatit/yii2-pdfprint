<?php
namespace dixonstarter\pdfprint;

use yii\web\AssetBundle;

class NprogressAsset extends AssetBundle
{
    public $sourcePath = '@bower/nprogress';
    public $css = [
        'nprogress.css',
    ];
    public $js = [
        'nprogress.js',
    ];
}
