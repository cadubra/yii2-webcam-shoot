<?php

/**
 * @link https://github.com/timurmelnikov/yii2-webcam-shoot
 * @copyright Copyright (c) 2016 Timur Melnikov
 * @license MIT
 */

namespace timurmelnikov\widgets;

use yii\base\Widget;
use yii\bootstrap\Modal;

/**
 * @author Timur Melnikov <melnilovt@gmail.com>
 */
class WebcamShoot extends Widget {

    /**
     * Текст заголовка диалогового окна виджета (с тегами).
     */
    public $headerText = '<h4>WEB камера</h4>';

    /**
     * Текст заголовка окна видео (с тегами).
     */
    public $videoText = 'Видео';

    /**
     * Текст заголовка окна фото (с тегами).
     */
    public $photoText = 'Фото';

    /**
     * Текст кнопки вызова диалогового окна.
     */
    public $buttonModalText = 'Сделать снимок WEB камерой';

    /**
     * Текст кнопки захвата фото.
     */
    public $buttonCaptureText = 'Сделать снимок';

    /**
     * Текст кнопки ОК.
     */
    public $buttonOKText = 'OK';

    /**
     * Текст кнопки Отмена.
     */
    public $buttonCancelText = 'Отмена';

    /**
     * Текст заголовка сообщения об ошибке - недоступности камеры.
     */
    public $errorHeader = 'Ошибка!';

    /**
     * Текст сообщения об ошибке - недоступности камеры.
     */
    public $errorText = 'Камера недоступна или что-то пошло не так...';

    /**
     * ID атрибута - цели, для закгрузки в него фотографии (поле тег - input).
     */
    public $targetInputID = null;

    /**
     * ID атрибута - цели, для закгрузки в него фотографии (картинка тег - img).
     */
    public $targetImgID = null;

    /**
     * Ширина видео и фото в пикселях.
     */
    public $width = 380;

    /**
     * Высота видео и фото в пикселях (рассчитывается автоматически).
     */
    private $height;

    /*
     * Заставка для фото
     */
    private $imgPhoto;

    public function init() {
        $view = $this->getView();
        $bundle = WebcamShootAsset::register($view);

        $this->imgPhoto = $bundle->baseUrl . '/images/web-camera.png';

        //Рассчет и присвоение высоты фото
        $this->height = $this->width / 4 * 3;

        $script = <<<JS
$("#yii2-webcam-shoot-ok").on('click', function () {
    if ({$this->targetInputID} != null) {
        //Сохранение фото в текстовом формате, для передачи на сервер
        $("#{$this->targetInputID}").val($("#yii2-webcam-shoot-photo").attr('src'));
    }
    if ({$this->targetImgID} != null) {
        //Заполнение картинки
        $("#{$this->targetImgID}").attr('src', $("#yii2-webcam-shoot-photo").attr('src'));
    }
});
JS;
        $view->registerJs($script);
    }

    /**
     * Выполнение виджета.
     */
    public function run() {

        //Блок диалогового окна
        $html = <<<HTML
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div id="yii2-webcam-shoot-error" class="alert alert-danger" style="display: none">
                <strong>{$this->errorHeader}</strong> {$this->errorText}
            </div>
        </div>
    </div>
    <div class="row">
        <div  class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-facetime-video"></span> {$this->videoText}</div>
                <div class="panel-body ">
                    <video class="img-rounded center-block" id="yii2-webcam-shoot-video" width="{$this->width}" height="$this->height" autoplay></video>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-picture"> </span> {$this->photoText}</div>
                <div class="panel-body">
                    <canvas  id="yii2-webcam-shoot-canvas" width="{$this->width}" height="{$this->height}" style="display: none"></canvas>
                    <img class="img-rounded center-block" src="{$this->imgPhoto}"  id="yii2-webcam-shoot-photo">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
                <button id="yii2-webcam-shoot-capture" class="btn btn-warning btn-block">{$this->buttonCaptureText}</button>
        </div>
    </div>
HTML;
        //Подвал диалогового окна (кнопки)
        $footer = <<<FOOTER
        <button id = "yii2-webcam-shoot-ok" type = "button" class = "btn btn-primary" data-dismiss = "modal">{$this->buttonOKText}</button>
        <button id = "yii2-webcam-shoot-cancel" type = "button" class = "btn btn-default" data-dismiss = "modal">{$this->buttonCancelText}</button >
FOOTER;

        //Вызов модального окна
        Modal::begin([
            'header' => $this->headerText,
            'toggleButton' => ['label' => $this->buttonModalText, 'id' => 'yii2-webcam-shoot-show', 'class' => 'btn btn-primary'],
            'size' => 'modal-lg',
            'footer' => $footer,
        ]);
        echo $html;
        Modal::end();
    }

}
