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
    </style>

</head>

<body>
    <?php foreach ($this->contextList['contentList'] as $contentLoop) : ?>
        <?php echo $contentLoop->render(); ?>
    <?php endforeach; ?>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>