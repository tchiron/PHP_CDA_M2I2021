<?php
require TEMPLATES . DIRECTORY_SEPARATOR . "header.html.php";
?>
<h1>Liste des articles</h1>
<?php foreach ($articles as $article) : ?>
    <article>
        <h2><?= $article->getTitle() ?></h2>
        <span><?= $article->getCreatedAt() ?></span>
        <p><?= nl2br($article->getContent()) ?></p>
        <a href="<?= sprintf('/article/%d/show', $article->getId()) ?>">Voir l'article</a>
    </article>
<?php
endforeach;

require TEMPLATES . DIRECTORY_SEPARATOR . "footer.html.php";
?>