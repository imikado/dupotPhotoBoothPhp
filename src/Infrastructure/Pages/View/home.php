<div class="border d-flex align-items-center justify-content-center" style="height: 700px;">


    <p>
        <a id="buttonTakePictureTransparent" tabindex="1" href="/takePicture.html" class="btn btn-success btn-lg">



            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill " viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
            </svg><br />

            Prendre une photo<br />
            (fond vert)
        </a>

    </p>

    <p>

        <a id="buttonTakePicture" tabindex="2" href="/takePicture.html?without=1" class="btn btn-primary btn-lg" role="button">



            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill " viewBox="0 0 16 16">
                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
            </svg><br />

            Prendre une photo
            <br />
            (normal)
        </a>
    </p>
    <div style="color:white;position:absolute;top:0px;left:0px;"><?php

                                                                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

                                                                    echo $ip; ?></div>
</div>

<script>
    var buttonTakePictureTransparent = document.getElementById('buttonTakePictureTransparent');
    var buttonTakePicture = document.getElementById('buttonTakePicture');

    var buttonsList = [
        buttonTakePictureTransparent,
        buttonTakePicture
    ]

    var buttonSelected = 0;

    switchButton();

    function switchButton() {
        buttonsList[buttonSelected].style.height = '120px';
        buttonsList[buttonSelected].style.width = '350px';
        buttonsList[buttonSelected].style.opacity = '60%';


        if (buttonSelected === 0) {
            buttonSelected = 1;
        } else {
            buttonSelected = 0;
        }
        buttonsList[buttonSelected].style.height = '180px';
        buttonsList[buttonSelected].style.width = '360px';
        buttonsList[buttonSelected].style.opacity = '100%';


    }

    function gotoSelected() {
        buttonsList[buttonSelected].click();
    }


    document.addEventListener(
        "buttonA",
        (e) => {
            switchButton();
        },
        false
    );

    document.addEventListener(
        "buttonB",
        (e) => {
            gotoSelected();
        },
        false
    )
</script>
<div style="font-size:80px;color:white;position:absolute;bottom:0px;left:0px">A: choix, B: valider</div>