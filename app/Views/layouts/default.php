<!doctype html>
<html lang="en">
<head>
    <base href="<?= base_url('/'); ?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= get_csrf_meta(); ?>
    <title>PHPFramework :: <?= $title ?? ''; ?></title>
    <link rel="icon" href="<?= base_url('/favicon.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/iziModal/css/iziModal.min.css'); ?>">

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
        <a class="navbar-brand" href="<?= base_href(); ?>">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?= cache()->get('menu'); ?>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <?= app()->get('lang')['title']; ?>
                    </a>

                    <?php $request_uri = uri_without_lang(); ?>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach (LANGS as $k => $v): ?>
                            <?php if (app()->get('lang')['code'] == $k) continue; ?>
                            <?php if ($v['base'] == 1): ?>
                                <li><a class="dropdown-item" href="<?= base_url("{$request_uri}"); ?>"><?= $v['title']; ?></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= base_url("/{$k}{$request_uri}"); ?>"><?= $v['title']; ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<img src="favicon.png" alt="fav" width="100">

<?php get_alerts(); ?>
<?= /** @var string $content */
$content; ?>

<?php dump(app()->get('lang')); ?>


<script src="<?= base_url('/assets/js/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('/assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('/assets/iziModal/js/iziModal.min.js'); ?>"></script>

<?php if (!empty($footer_scripts)): ?>
    <?php foreach ($footer_scripts as $footer_script): ?>
        <script src="<?= $footer_script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script src="<?= base_url('/assets/js/main.js'); ?>"></script>

<div class="iziModal-alert-success"></div>
<div class="iziModal-alert-error"></div>

</body>
</html>
