<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 520px; }
        h1 { margin-top: 0; }
        label { display: block; font-weight: bold; color: #444; margin-bottom: 0.3rem; }
        input, select, textarea { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .form-group { margin-bottom: 1.2rem; }
        .error { color: #dc2626; font-size: 0.875rem; }
        .preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 6px; margin-top: 0.5rem; display: none; }
        button { background: #4f46e5; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #4338ca; }
        a { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= esc($title) ?></h1>

        <form action="/photos/store" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <img id="preview" class="preview" src="" alt="Preview">
                <?php if ($validation->hasError('image')): ?>
                    <span class="error"><?= $validation->getError('image') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= old('title') ?>" placeholder="Optional title">
                <?php if ($validation->hasError('title')): ?>
                    <span class="error"><?= $validation->getError('title') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="alt_text">Alt Text</label>
                <input type="text" id="alt_text" name="alt_text" value="<?= old('alt_text') ?>" placeholder="Describe the image">
                <?php if ($validation->hasError('alt_text')): ?>
                    <span class="error"><?= $validation->getError('alt_text') ?></span>
                <?php endif; ?>
            </div>
<!-- 
mark for later -->

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= esc($cat['id']) ?>" <?= old('category_id') == $cat['id'] ? 'selected' : '' ?>>
                            <?= esc($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('category_id')): ?>
                    <span class="error"><?= $validation->getError('category_id') ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Upload Photo</button>
        </form>

        <a href="/photos">&larr; Back to photos</a>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function () {
            const preview = document.getElementById('preview');
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>
</body>
</html>