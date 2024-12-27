<div class="container">
    <h2>Contact page</h2>

    <form action="<?= base_href('/contact'); ?>" method="post" enctype="multipart/form-data">
        <?= get_csrf_field(); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="my-file" class="form-label">Default file input example</label>
            <input name="my-file" class="form-control" type="file" id="my-file">
        </div>

        <button type="submit" class="btn btn-warning">Send</button>
    </form>
</div>
