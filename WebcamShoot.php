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

//use yii\helpers\Html;

/**
 * @author Timur Melnikov <melnilovt@gmail.com>
 */
class WebcamShoot extends Widget {

    /**
     * Текст заголовка диалогового окна (с тегами)
     */
    public $headerText = '<h4>WEB камера</h4>';

    /**
     * Текст заголовка окна видео (с тегами)
     */
    public $videoText = 'Видео';

    /**
     * Текст заголовка окна видео (с тегами)
     */
    public $photoText = 'Фото';

    /**
     * Атрибут - цель, для закгрузки в него фотографии.
     */
    public $targetAttribute;

    /**
     * Ширина видео и фото в пикселях
     */
    public $width = 380;

    /**
     * Высота видео и фото в пикселях (рассчитывается автоматически)
     */
    private $height;

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

        $this->height = $this->width / 4 * 3;
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
                <div class="panel-heading"><span class="glyphicon glyphicon-facetime-video"></span> {$this->videoText}</div>
                <div class="panel-body ">
                    <video class="img-rounded center-block" id="video" width="{$this->width}" height="$this->height" autoplay></video>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-picture"> </span> {$this->photoText}</div>
                <div class="panel-body">
                    <canvas  id="canvas" width="{$this->width}" height="{$this->height}" style="display: none"></canvas>
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
            'header' => $this->headerText,
            'toggleButton' => ['label' => 'Сделать фото камерой'],
            'size' => 'modal-lg',
            'footer' => '<div class="form-group">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">ОК</button> 
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button> 
                         </div>',
        ]);

        echo $html;

        Modal::end();


    }

}
