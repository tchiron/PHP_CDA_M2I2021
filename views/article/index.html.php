<!-- Afficher la donnée récupérer de la bdd -->
<?php

// les instructions qui afficheront les données récupérées dans la bdd

foreach ($articles as $article):
?>
<article>
    <h2><?= $article->getTitle() ?></h2>
    <span><?= $article->getCreatedAt() ?></span>
    <p><?= nl2br($article->getContent()) ?></p>
    <a href="<?= sprintf('/article/%d/show', $article->getId()) ?>">Voir l'article</a>
</article>
<?php endforeach; ?>