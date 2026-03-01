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
        label { display: block; font-weight: bold; color: #444; margin-bottom: 0.3rem; }
        select { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        select:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .form-group { margin-bottom: 1.2rem; }
        .btn { background: #4f46e5; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        .btn:hover { background: #4338ca; }
        a { color: #4f46e5; text-decoration: none; display: inline-block; margin-top: 1rem; }
        a:hover { text-decoration: underline; }
        .empty { color: #888; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= esc($title) ?></h1>

        <img src="/<?= esc($photo['image_path']) ?>" class="photo-preview" alt="<?= esc($photo['title'] ?? '') ?>">

        <?php if (empty($albums)): ?>
            <p class="empty">You have no albums yet. <a href="/profile">Create one first.</a></p>
        <?php else: ?>
            <form action="/photos/<?= esc($photo['id']) ?>/album" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="album_id">Select Album</label>
                    <select id="album_id" name="album_id">
                        <?php foreach ($albums as $album): ?>
                            <option value="<?= esc($album['id']) ?>" <?= $photo['album_id'] == $album['id'] ? 'selected' : '' ?>>
                                <?= esc($album['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn">Save to Album</button>
            </form>
        <?php endif; ?>

        <a href="/photos/<?= esc($photo['id']) ?>">&larr; Back to photo</a>
    </div>
</body>
</html>