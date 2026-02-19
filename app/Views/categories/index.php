<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; }
        h1 { margin-bottom: 1rem; }
        table { border-collapse: collapse; width: 100%; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th { background: #4f46e5; color: #fff; padding: 0.75rem 1rem; text-align: left; }
        td { padding: 0.7rem 1rem; border-bottom: 1px solid #eee; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f0f0ff; }
        a { color: #4f46e5; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .empty { color: #888; }
    </style>
</head>
<body>
    <h1><?= esc($title) ?></h1>
    <?php if (session()->getFlashdata('success')): ?>
    <p style="color: #16a34a; background: #f0fdf4; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem;">
        <?= session()->getFlashdata('success') ?>
    </p>
<?php endif; ?>

<a href="/categories/create" style="display:inline-block; margin-bottom:1rem; background:#4f46e5; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; text-decoration:none;">
    + Add Category
</a>

    <?php if (empty($categories)): ?>
        <p class="empty">No categories found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= esc($cat['id']) ?></td>
                    <td><?= esc($cat['name']) ?></td>
                    <td><?= esc($cat['slug']) ?></td>
                    <td><a href="/categories/<?= esc($cat['id']) ?>">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>