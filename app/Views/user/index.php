<div class="container">

    <?= $pagination; ?>

    <?php foreach ($users as $user): ?>
        <?= $user['name']; ?><br>
    <?php endforeach; ?>

    <br>
    <?= $pagination; ?>

</div>

