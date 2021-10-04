<h1>Liste des articles</h1>
<?php if (!empty($articles)) :
foreach ($articles as $article) : ?>
    <article>
        <h2><?= $article->getTitle() ?></h2>
        <span><?= $article->getCreatedAtFormat() ?></span>
        <p><?= nl2br($article->getContent()) ?></p>
        <a href="<?= sprintf('/article/%d/show', $article->getId()) ?>">Voir l'article</a>
    </article>
<?php endforeach;
else : ?>
<div>
    <b>Nothing to see here !</b>
</div>
<?php endif; ?>
