<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= get_csrf_meta(); ?>
    <title>PHPFramework :: <?= $title ?? ''; ?></title>
    <link rel="icon" href="<?= base_url('/favicon.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css'); ?>">

    <?php if (!empty($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= $style; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($header_scripts)): ?>
        <?php foreach ($header_scripts as $header_script): ?>
            <script src="<?= $header_script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?= cache()->get('menu'); ?>

        </div>
    </div>
</nav>

<?php get_alerts(); ?>
<?= /** @var string $content */
$content; ?>


<script src="<?= base_url('/assets/js/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('/assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<?php if (!empty($footer_scripts)): ?>
    <?php foreach ($footer_scripts as $footer_script): ?>
        <script src="<?= $footer_script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script src="<?= base_url('/assets/js/main.js'); ?>"></script>
</body>
</html>
