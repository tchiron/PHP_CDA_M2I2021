<?php
require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "header.html.php"]);
require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "error_message.html.php"]);
?>
<form action="" method="post">
    <label for="title">Titre</label><input type="text" name="title" id="title" value="<?= $article?->getTitle() ?? ""; ?>">
    <br>
    <label for="content">Contenu</label><textarea name="content" id="content" cols="30" rows="10"><?= $article?->getContent() ?? ""; ?></textarea>
    <input type="submit" value="Envoyer">
</form>
<?php require implode(DIRECTORY_SEPARATOR, [TEMPLATES, "footer.html.php"]); ?>