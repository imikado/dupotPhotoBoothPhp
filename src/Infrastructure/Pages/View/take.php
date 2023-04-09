<style>
    #capture {

        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 200;

    }

    #capture span {
        color: white;
        font-size: 200px;
    }
</style>


<p><span id="errorMsg"></span></p>

<!-- 10x15 -->
<!-- 910x1366  -->

<!-- Stream video via webcam -->
<div class="border d-flex align-items-center justify-content-center" style="height: 700px;">

    <div class="video-wrap">
        <video id="video" playsinline autoplay></video>
    </div>
</div>
<!-- Trigger canvas web API -->
<div id="capture">
    <button autofocus tabindex="1" class="btn btn-primary btn-lg" onclick="return delayTakePicture()">Prendre la photo ^_^</button>
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
            width: 1200,
            height: 800
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

    var countdown = 0;
    var maxCountdown = 5;

    function delayTakePicture() {
        countdown += 1;

        let captureDiv = document.getElementById('capture');
        if (captureDiv) {
            console.log('inner');
            captureDiv.innerHTML = '<span>' + (maxCountdown - countdown) + '</span>';
        }
        console.log(countdown);

        if (countdown >= maxCountdown) {
            return takePicture();
        }
        setTimeout(delayTakePicture, 1000);
    }


    function takePicture() {

        let canvas = document.createElement('canvas');

        canvas.width = 1200;
        canvas.height = 800;

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