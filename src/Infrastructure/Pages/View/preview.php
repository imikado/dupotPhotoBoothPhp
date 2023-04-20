<style>
    #capture {

        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 200;

    }

    #controls {}
</style>

<div class="border d-flex align-items-center justify-content-center" style="height: 700px;">

    <img style="width:80%" src="/<?php echo $_GET['imagePath'] ?>" />

</div>


<div id="capture">
    <a autofocus tabindex="1" class="btn btn-primary btn-lg" href="/">Merci ^_^, Retour au Menu</button>
</div>


<script>
    document.addEventListener(
        "buttonA",
        (e) => {
            document.location.href = '/';
        },
        false
    );

    document.addEventListener(
        "buttonB",
        (e) => {
            document.location.href = '/';
        },
        false
    )
</script>

<div style="font-size:80px;color:white;position:absolute;bottom:0px;left:0px">A/B: Retour menu</div>