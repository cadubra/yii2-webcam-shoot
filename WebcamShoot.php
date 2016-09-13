<?php

/**
 * @link https://github.com/timurmelnikov/yii2-webcam-shoot
 * @copyright Copyright (c) 2016 Timur Melnikov
 * @license MIT
 */

namespace timurmelnikov\widgets;

use Yii;
use yii\base\Widget;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/**
 * @author Timur Melnikov <melnilovt@gmail.com>
 */
class WebcamShoot extends Widget {

    /**
     * model name for active field
     */
    public $model;

    /**
     * attribut of model
     */
    public $attribute;

    /**
     * width of photo canvas : in pixel
     */
    public $width = 300;

    /**
     * height of photo canvas : in pixel
     */
    public $height = 350;

    /**
     * ID of canvas element
     */
    public $canvasID = 'webcam-shoot-canvas';

    /**
     * ID of video element
     */
    public $videoID = 'webcam-shoot-video';

    /**
     * ID of photo element
     */
    public $photoID = 'webcam-shoot-photo';
    public $htmlOptions = array();

    /*
     * Тизер фото
     */
    private $imgPhoto;

    public function init() {
        $view = $this->getView();
        $bundle = WebcamShootAsset::register($view);
        $this->imgPhoto = $bundle->baseUrl . '/images/web-camera.png';
    }

    /**
     * Выполнение виджета
     * @return string строка, содержащая HTML виджета
     */
    public function run() {

        $html = <<<HTML
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div id="webcam-error" class="alert alert-danger" style="display: none">
                <strong>Ошибка!</strong> Камера недоступна или что-то пошло не так...
            </div>
        </div>

    </div>

    <div class="row">

        <div  class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-facetime-video"></span> Видео</div>
                <div class="panel-body ">
                    <video class="img-rounded center-block" id="video" width="320" height="240" autoplay></video>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-picture"></span> Фото</div>
                <div class="panel-body">
                    <canvas  id="canvas" width="320" height="240" style="display: none"></canvas>
                    <img class="img-rounded center-block" src="{$this->imgPhoto}"  id="photo">
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <div class="col-md-12 col-lg-12">

                <a class="btn btn-warning center-block" href="#" id="capture" class="booth-capture-button">Сделать снимок</a>

        </div>

    </div>
HTML;




        Modal::begin([
            'header' => '<h4>WEB камера</h4>',
            'toggleButton' => ['label' => 'Сделать фото камерой'],
            'size' => 'modal-lg',
            'footer' => '<div class="form-group">
                            <button type="submit" class="btn btn-primary">ОК</button> 
                            <button type="button" class="btn btn-default">Отмена</button> 
                         </div>',
        ]);

        echo $html;

        Modal::end();






        //return ;
    }

}
