<?php if (isset($error_messages)) : ?>
<div>
    <?php foreach ($error_messages as $m) : ?>
    <span><?= $m ?></span>
    <?php endforeach; ?>
</div>
<?php endif; ?>