<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photo booth 40 ans!!</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0d68abff url('/css/images/layoutBackground.png') top left no-repeat;

        }

        a.btn {
            font-size: 24px;
            font-weight: bold;
        }

        #pleinecran {
            position: absolute;
            top: 0px;
            right: 0px;
        }
    </style>

</head>

<body>
    <?php foreach ($this->contextList['contentList'] as $contentLoop) : ?>
        <?php echo $contentLoop->render(); ?>
    <?php endforeach; ?>

    <script src="/js/bootstrap.bundle.min.js"></script>


    <script>
        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                //return document.body.requestFullscreen()
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        document.onkeydown = logKey;
        window.onkeydown = logKey;
        window.oninput = logKey;

        function logKey(e) {
            console.log(e.code);
        }

        var myGamepad;
        window.addEventListener("gamepadconnected", function(e) {
            console.log("Manette connectée à l'indice %d : %s. %d boutons, %d axes.",
                e.gamepad.index, e.gamepad.id,
                e.gamepad.buttons.length, e.gamepad.axes.length);


            myGamepad = navigator.getGamepads()[e.gamepad.index];

            loopGamepad();
        });

        function buttonPressed(b) {
            if (typeof(b) == "object") {
                return b.pressed;
            }
            return false;
        }

        function loopGamepad() {

            let buttonA = false;
            let buttonB = false;




            console.log('----------');

            let gamepadList = navigator.getGamepads()
            myGamepad = gamepadList[0];

            if (myGamepad.buttons[2].pressed) {
                buttonA = true;
            }
            if (myGamepad.buttons[1].pressed) {
                buttonB = true;
            }

            if (buttonA) {
                console.log('button A');

                const event = new Event("buttonA");
                document.dispatchEvent(event);

            }
            if (buttonB) {
                console.log('button B');

                const event = new Event("buttonB");
                document.dispatchEvent(event);


            }





            setTimeout(loopGamepad, 500);
        }
    </script>

    <div id="pleinecran"><button onclick="toggleFullScreen()">Plein ecran</button></div>



</body>

</html>