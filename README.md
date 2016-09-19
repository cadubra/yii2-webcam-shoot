Yii2 виджет для работы с WEB камерой
================================

##Виджет на стадии разработки и не готов к использованию!!!


##Назначение виджета


##Системные требования
Yii2 с установленным расширением "yiisoft/yii2-bootstrap" (входит в пакет установки Yii2 по умолчанию yiisoft/yii2-app-basic и yii2-app-advanced)
Виджет, тестировался в браузерах:
- Google Chrome v. 53.0.2785.116
- Firefox v. 48.0.2


## Установка
Добавить в секцию "require" файла composer.json:
``` json
{
    "require": {
        "timurmelnikov/yii2-webcam-shoot": "dev-master"
    }
}
```
После редактирования файла выполнить команду `composer update`

##Использование
В представлении, где будет использоваться yii2-webcam-shoot, подключить:
``` php
use timurmelnikov\widgets\WebcamShoot;
```
Вывести виджет:
``` php
echo WebcamShoot::widget([
    //'targetInputID' => 'textimg',
    //'targetImgID' => 'textphoto',
]);
```

## Скриншоты
![alt tag](https://goo.gl/photos/s3Dew9FRMhvKN8tDA)