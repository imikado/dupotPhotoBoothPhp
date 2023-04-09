<style>
    #capture {

        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 200;

    }
</style>


<p><span id="errorMsg"></span></p>

<!-- 10x15 -->
<!-- 910x1366  -->

<!-- Stream video via webcam -->
<div class="video-wrap">
    <video id="video" playsinline autoplay></video>
</div>

<!-- Trigger canvas web API -->
<div id="capture">
    <button class="btn btn-primary btn-lg" onclick="return takePicture()">Capture</button>
</div>

<!-- Webcam video snapshot -->
<canvas id="canvas" width="1366" height="910"></canvas>


<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById("snap");
    const errorMsgElement = document.getElementById('errorMsg');

    const constraints = {
        audio: false,
        video: {
            width: 1366,
            height: 910
        }
    };

    // Access webcam
    async function init() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            handleSuccess(stream);
        } catch (e) {
            errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
        }
    }

    // Success
    function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;
    }

    // Load init
    init();

    // Draw image
    var context = canvas.getContext('2d');


    function takePicture() {

        let canvas = document.createElement('canvas');

        canvas.width = 1366;
        canvas.height = 910;

        let ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        let image = canvas.toDataURL('image/jpeg');

        convertPicture(image);

        //context.drawImage(video, 0, 0, 1366, 910);

    }

    async function convertPicture(image) {
        let transparent = <?php if (isset($_GET['without'])) : ?>0<?php else : ?>1<?php endif; ?>;

        const formData = new FormData();
        formData.append("image", image);
        formData.append("convert", transparent);

        const response = await fetch("apiConvert.html", {
            method: "POST",
            body: formData,
        });


        const jsonData = await response.json();

        redirectTo(jsonData.imagePath);

        console.log(jsonData);
    }

    function redirectTo(imagePath) {
        document.location.href = 'previewPicture.html?imagePath=' + imagePath;
    }
</script>