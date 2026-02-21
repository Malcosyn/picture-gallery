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
        input, select { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        input:focus, select:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .form-group { margin-bottom: 1.2rem; }
        .error { color: #dc2626; font-size: 0.875rem; }
        .current-image { width: 100%; max-height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 0.5rem; }
        .preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 6px; margin-top: 0.5rem; display: none; }
        .btn { background: #4f46e5; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        .btn:hover { background: #4338ca; }
        .btn-danger { background: #dc2626; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; margin-left: 0.5rem; }
        .btn-danger:hover { background: #b91c1c; }
        a { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
        .actions { display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= esc($title) ?></h1>

        <!-- Current image preview -->
        <img src="/<?= esc($photo['image_path']) ?>" class="current-image" alt="Current photo">

        <form action="/photos/<?= esc($photo['id']) ?>/update" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="image">Replace Image <span style="font-weight:normal; color:#888;">(optional)</span></label>
                <input type="file" id="image" name="image" accept="image/*">
                <img id="preview" class="preview" src="" alt="New preview">
                <?php if ($validation->hasError('image')): ?>
                    <span class="error"><?= $validation->getError('image') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= old('title', $photo['title']) ?>" placeholder="Optional title">
                <?php if ($validation->hasError('title')): ?>
                    <span class="error"><?= $validation->getError('title') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="alt_text">Alt Text</label>
                <input type="text" id="alt_text" name="alt_text" value="<?= old('alt_text', $photo['alt_text']) ?>" placeholder="Describe the image">
                <?php if ($validation->hasError('alt_text')): ?>
                    <span class="error"><?= $validation->getError('alt_text') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= esc($cat['id']) ?>"
                            <?= old('category_id', $photo['category_id']) == $cat['id'] ? 'selected' : '' ?>>
                            <?= esc($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->hasError('category_id')): ?>
                    <span class="error"><?= $validation->getError('category_id') ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn">Save Changes</button>
        </form>

        <!-- Separate delete form -->
        <form action="/photos/<?= esc($photo['id']) ?>/delete" method="post" style="display:inline;">
            <?= csrf_field() ?>
            <div class="actions">
                <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this photo?')">
                    🗑 Delete Photo
                </button>
            </div>
        </form>

        <a href="/photos/<?= esc($photo['id']) ?>">&larr; Back to photo</a>
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