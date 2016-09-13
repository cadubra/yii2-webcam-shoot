$(document).ready(function () {

    $("#rrrrrr").on('click', function () {

        //Очищаем окно видео
        $("#video").attr('src', '');

        (function () {
            var video = document.getElementById('video'),
                    canvas = document.getElementById('canvas'),
                    context = canvas.getContext('2d'),
                    photo = document.getElementById('photo'),
                    vendorUrl = window.URL || window.webkitURL;
            navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.
                    mozGetUserMedia || navigator.msGetUserMedia;
            navigator.getMedia({
                video: true,
                audio: false
            },
                    function (stream) {//Если все ОК
                        video.src = vendorUrl.createObjectURL(stream);
                        video.play();

                        //Активация кнопок, если все хорошо
                        $('#yii2-webcam-shoot-capture').removeAttr('disabled');
                        $('#yii2-webcam-shoot-ok').removeAttr('disabled');
                        //Деактивация алерта, если все хорошо
                        $('#webcam-error').hide();

                        //Клик по кнопке захвата видео
                        document.getElementById('yii2-webcam-shoot-capture').addEventListener('click', function () {
                            context.drawImage(video, 0, 0, $("#video").width(), $("#video").height());
                            photo.setAttribute('src', canvas.toDataURL('image/png'));
                        });

                    },
                    function (error) {//Если ошибка
                        //Деактивация кнопок, при ошибке
                        $('#yii2-webcam-shoot-capture').attr('disabled', 'disabled');
                        $('#yii2-webcam-shoot-ok').attr('disabled', 'disabled');
                        //Активация алерта, при ошибке
                        $('#webcam-error').show();

                    });

        })();

        //Выравнивание высоты фото, по высоте видео
        $("#photo").height($("#video").height());

        //Сохранение фото в текстовом формате, для передачи на сервер
        $("#yii2-webcam-shoot-ok").on('click', function () {
            $("#textImage").val($("#photo").attr('src'));
        });

    });

});