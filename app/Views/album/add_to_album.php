<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 520px; }
        h1 { margin-top: 0; }
        .photo-preview { width: 100%; max-height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 1.2rem; }
        .album-list { list-style: none; padding: 0; margin: 0 0 1.2rem; }
        .album-list li { display: flex; justify-content: space-between; align-items: center; padding: 0.7rem 1rem; border: 1px solid #eee; border-radius: 6px; margin-bottom: 0.5rem; }
        .album-list li.saved { background: #f0fdf4; border-color: #86efac; }
        .badge { font-size: 0.75rem; background: #16a34a; color: #fff; padding: 0.2rem 0.5rem; border-radius: 4px; }
        .btn { background: #4f46e5; color: #fff; border: none; padding: 0.4rem 1rem; border-radius: 6px; font-size: 0.9rem; cursor: pointer; text-decoration: none; }
        .btn:hover { background: #4338ca; }
        .btn-remove { background: #6b7280; }
        .btn-remove:hover { background: #4b5563; }
        a.back { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
        .empty { color: #888; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= esc($title) ?></h1>

        <img src="/<?= esc($photo['image_path']) ?>" class="photo-preview" alt="">

        <?php if (empty($albums)): ?>
            <p class="empty">You have no albums yet. <a href="/profile">Create one first.</a></p>
        <?php else: ?>
            <ul class="album-list">
                <?php foreach ($albums as $album): ?>
                <li class="<?= $album['is_saved'] ? 'saved' : '' ?>">
                    <span><?= esc($album['title']) ?></span>
                    <div style="display:flex; gap:0.5rem; align-items:center;">
                        <?php if ($album['is_saved']): ?>
                            <span class="badge">✓ Added</span>
                            <form action="/photos/<?= esc($photo['id']) ?>/album/remove" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="album_id" value="<?= esc($album['id']) ?>">
                                <button type="submit" class="btn btn-remove">Remove</button>
                            </form>
                        <?php else: ?>
                            <form action="/photos/<?= esc($photo['id']) ?>/album" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="album_id" value="<?= esc($album['id']) ?>">
                                <button type="submit" class="btn">+ Add</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a class="back" href="/photos/<?= esc($photo['id']) ?>">&larr; Back to photo</a>
    </div>
</body>
</html>