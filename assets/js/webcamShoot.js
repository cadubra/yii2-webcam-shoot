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
    }, function (stream) {
        video.src = vendorUrl.createObjectURL(stream);
        video.play();
    }, function (error) {

        //Деактивация кнопки, при ошибке
        $('#capture').attr('disabled', 'disabled');
        //Активация алерта, при ошибке
        $('#webcam-error').show();

    });
    document.getElementById('capture').addEventListener('click', function () {
        context.drawImage(video, 0, 0, $("#video").width(), $("#video").height());
        photo.setAttribute('src', canvas.toDataURL('image/png'));
    });
})();

//Выравнивание высоты фото, по высоте видео
$(document).ready(function () {
    $("#photo").height($("#video").height());
});