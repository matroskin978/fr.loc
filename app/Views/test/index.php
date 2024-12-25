<div class="container">

    <form action="<?= base_href('/test'); ?>" method="post" enctype="multipart/form-data">
        <?= get_csrf_field(); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name">
        </div>

        <div class="mb-3">
            <label for="my-file" class="form-label">Default file input example</label>
            <input name="my-file" class="form-control" type="file" id="my-file">
        </div>

        <div class="mb-3">
            <label for="my-files" class="form-label">Default file input example</label>
            <input name="my-files[]" class="form-control" type="file" id="my-files" multiple>
        </div>

        <button type="submit" class="btn btn-warning">Send</button>
    </form>

</div>

