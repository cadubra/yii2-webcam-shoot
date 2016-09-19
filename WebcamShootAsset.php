<?php

/**
 * @link https://github.com/timurmelnikov/yii2-webcam-shoot
 *
 * @copyright Copyright (c) 2016 Timur Melnikov
 * @license MIT
 */

namespace timurmelnikov\widgets;

use yii\web\AssetBundle;

/**
 * @author Timur Melnikov <melnilovt@gmail.com>
 */
class WebcamShootAsset extends AssetBundle {

    public $sourcePath = '@vendor/timurmelnikov/yii2-webcam-shoot/assets';
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init() {
        parent::init();
        $this->js[] = YII_DEBUG ? 'js/webcamShoot.js' : 'js/webcamShoot.min.js';
    }

}
