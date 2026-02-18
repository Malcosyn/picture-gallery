<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        h1 { margin-bottom: 1rem; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .btn { background: #4f46e5; color: #fff; padding: 0.5rem 1.2rem; border-radius: 6px; text-decoration: none; font-size: 0.95rem; }
        .btn:hover { background: #4338ca; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.2rem; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
        .card img { width: 100%; height: 160px; object-fit: cover; display: block; }
        .card-body { padding: 0.8rem 1rem; }
        .card-body h3 { margin: 0 0 0.3rem; font-size: 1rem; }
        .card-body small { color: #888; font-size: 0.8rem; }
        .card-body a { display: inline-block; margin-top: 0.5rem; color: #4f46e5; font-size: 0.875rem; }
        .flash { background: #f0fdf4; color: #16a34a; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .empty { color: #888; }
    </style>
</head>
<body>
    <div class="toolbar">
        <h1><?= esc($title) ?></h1>
        <a href="/photos/create" class="btn">+ Upload Photo</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="flash"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <?php if (empty($photos)): ?>
        <p class="empty">No photos yet.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($photos as $photo): ?>
            <div class="card">
                <img src="/<?= esc($photo['image_path']) ?>" alt="<?= esc($photo['alt_text'] ?? $photo['title']) ?>">
                <div class="card-body">
                    <h3><?= esc($photo['title'] ?? 'Untitled') ?></h3>
                    <small><?= esc($photo['category_name']) ?> &bull; <?= esc($photo['album_title']) ?></small><br>
                    <a href="/photos/<?= esc($photo['id']) ?>">View &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>