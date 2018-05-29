<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 17/01/18
 * Time: 05:54
 */


namespace app\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Dosis|Roboto',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}