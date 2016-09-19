Yii2 виджет для работы с WEB камерой
================================
[Идея, взята здесь](https://myrusakov.ru/javascript-take-photos.html){:target="_blank"}

##Виджет на стадии разработки и не готов к использованию!!!

##Назначение виджета
Захват изображения с WEB камеры, сохраниение снимка в формате base64, для последующей передачи через input формы на сервер. 
Далее, на сервере, изображение можно либо преобразовать в файл с последуюшим сохранением в файловой системе,
либо непосредственно записать в базу данных в формате base64.


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
    'targetInputID' => 'textimg',
    'targetImgID' => 'textphoto',
]);
```

Важную роль, играют свойства 'targetInputID' и 'targetImgID'...

На сервере, изображение в формате base64, можно обратотать, например так:
``` php
define('UPLOAD_DIR', 'img/');
$img = $_POST['textimage']; //Атрибут инпута с name = textimage
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR .  uniqid() . '.png';
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
```

## Скриншоты

Ошибка:
![alt tag](https://lh3.googleusercontent.com/B_czT9ySo4OlpcC_YDrCL3mjNJoVb86zdFK1nFp_Jj5pz-YBINoW5U6N3h5hZSjPFgKp6Rxek7_D_phAqomeZYpUpCd-oUM)

Изображение с камеры:
![alt tag](https://lh3.googleusercontent.com/GbFFhQn9MecZeBsMQl0TLTBuKNWkT9Y1aRkkz10lwhqoHUKjmdfauN0zIckL-T1K8h2XIuXBbFHvWZgdJhcuBaAYJAKz0Qw)

Фото с камеры:
![alt tag](https://lh3.googleusercontent.com/sGJWUSHG5-Vk2QWj9KBWKutbSiqol8OLiArhJZeTqdp0J1cfMQlpAs181k8rvJr9FO986JIK-mgJUJ9rYSvWdw6bPTdQ2eo)