<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        .card { background: #fff; padding: 1.5rem 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 400px; }
        .card h2 { margin-top: 0; color: #4f46e5; }
        .label { font-weight: bold; color: #555; }
        a { color: #4f46e5; }
    </style>
</head>
<body>
    <div class="card">
        <h2><?= esc($category['name']) ?></h2>
        <p><span class="label">ID:</span> <?= esc($category['id']) ?></p>
        <p><span class="label">Slug:</span> <?= esc($category['slug']) ?></p>
    </div>
    <br>
    <a href="/categories">&larr; Back to list</a>
</body>
</html>