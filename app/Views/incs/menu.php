<ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-menu">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_href('/'); ?>">Home</a>
    </li>

    <?php if (check_auth()): ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_href('/dashboard'); ?>">Dashboard</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_href('/register'); ?>">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_href('/login'); ?>">Login</a>
        </li>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_href('/users'); ?>">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_href('/posts'); ?>">Posts</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_href('/contact'); ?>">Contact</a>
    </li>
</ul>

