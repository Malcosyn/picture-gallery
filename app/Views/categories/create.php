<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 480px; }
        h1 { margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.3rem; font-weight: bold; color: #444; }
        input { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        input:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .error { color: #dc2626; font-size: 0.875rem; margin-bottom: 0.8rem; display: block; }
        .form-group { margin-bottom: 1.2rem; }
        button { background: #4f46e5; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #4338ca; }
        a { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= esc($title) ?></h1>

        <form action="/categories/store" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= old('name') ?>"
                    placeholder="e.g. Nature"
                >
                <?php if ($validation->hasError('name')): ?>
                    <span class="error"><?= $validation->getError('name') ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="<?= old('slug') ?>"
                    placeholder="e.g. nature"
                >
                <?php if ($validation->hasError('slug')): ?>
                    <span class="error"><?= $validation->getError('slug') ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Save Category</button>
        </form>

        <a href="/categories">&larr; Back to list</a>
    </div>

    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function () {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
</body>
</html>