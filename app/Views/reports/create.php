<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 520px; }
        h1 { margin-top: 0; color: #dc2626; }
        .photo-preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 1.2rem; }
        .photo-title { font-weight: bold; margin-bottom: 1.2rem; color: #444; }
        label { display: block; font-weight: bold; color: #444; margin-bottom: 0.3rem; }
        select, textarea { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        select:focus, textarea:focus { outline: none; border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.15); }
        .form-group { margin-bottom: 1.2rem; }
        .error { color: #dc2626; font-size: 0.875rem; }
        .btn-danger { background: #dc2626; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        .btn-danger:hover { background: #b91c1c; }
        .quick-links { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-top: 1rem; }
        .quick-links a { margin-top: 0; padding: 0.5rem 0.9rem; border-radius: 6px; text-decoration: none; font-size: 0.92rem; }
        .btn-link { background: #eef2ff; color: #3730a3; }
        .btn-link:hover { background: #e0e7ff; text-decoration: none; }
        .btn-success { background: #ecfdf5; color: #065f46; }
        .btn-success:hover { background: #d1fae5; text-decoration: none; }
        a { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h1> <?= esc($title) ?></h1>

        <!-- Photo being reported -->
        <img src="/<?= esc($photo['image_path']) ?>" class="photo-preview" alt="Reported photo">
        <p class="photo-title"><?= esc($photo['title'] ?? 'Untitled') ?></p>

        <form action="/photos/<?= esc($photo['id']) ?>/reports" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="reason">Reason for reporting</label>
                <select id="reason" name="reason">
                    <option value="">-- Select a reason --</option>
                    <option value="Inappropriate content"     <?= old('reason') === 'Inappropriate content'     ? 'selected' : '' ?>>Inappropriate content</option>
                    <option value="Spam"                      <?= old('reason') === 'Spam'                      ? 'selected' : '' ?>>Spam</option>
                    <option value="Copyright violation"       <?= old('reason') === 'Copyright violation'       ? 'selected' : '' ?>>Copyright violation</option>
                    <option value="Harassment"                <?= old('reason') === 'Harassment'                ? 'selected' : '' ?>>Harassment</option>
                    <option value="Other"                     <?= old('reason') === 'Other'                     ? 'selected' : '' ?>>Other</option>
                </select>
                <?php if ($validation->hasError('reason')): ?>
                    <span class="error"><?= $validation->getError('reason') ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-danger">Submit Report</button>
        </form>

        <div class="quick-links">
            <a href="/photos/<?= esc($photo['id']) ?>" class="btn-link">&larr; Photo Detail</a>
            <a href="/photos/<?= esc($photo['id']) ?>/album" class="btn-success">Add to Album</a>
            <?php if ((int) session()->get('user_id') === (int) ($photo['photographer_id'] ?? 0)): ?>
                <a href="/photos/<?= esc($photo['id']) ?>/edit" class="btn-link">Edit Photo</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
