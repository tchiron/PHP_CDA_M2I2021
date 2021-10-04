<article>
    <h2><?= $article->getTitle() ?></h2>
    <span><?= $article->getCreatedAtFormat() ?></span>
    <p><?= nl2br($article->getContent()) ?></p>
    <a href="<?= sprintf('/article/%d/edit', $article->getId()) ?>">Editer l'article</a>
    <a href="<?= sprintf('/article/%d/delete', $article->getId()) ?>">Supprimer l'article</a>
</article>