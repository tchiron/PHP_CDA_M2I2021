<!--
    mon corps html, head, body
    header, nav, footer
    
    Afficher le contenu (index.html.php)
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title ?></title>
</head>
<body>
    <?php require TEMPLATES . DIRECTORY_SEPARATOR . "nav.html.php"; ?>
    <?= $content; ?>
</body>
</html>