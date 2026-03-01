<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 0; background: #f9f9f9; margin: 0; }
        .page { padding: 2rem; }
        .navbar { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; background: #ffffff; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 10; }
        .brand { font-weight: 700; font-size: 1.1rem; color: #111827; text-decoration: none; }
        .profile-link {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.8rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #1e293b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .profile-link:hover { background: #eef2ff; border-color: #c7d2fe; }
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
        .search-bar { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 1.5rem; align-items: center; }
        .search-bar input, .search-bar select { padding: 0.5rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 0.95rem; }
        .search-bar input[type="text"] { flex: 1; min-width: 180px; }
        .search-bar input:focus, .search-bar select:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .btn-clear { background: #6b7280; }
        .btn-clear:hover { background: #4b5563; }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="brand"><?= esc($title) ?></a>
        <a href="/profile" class="profile-link" aria-label="Go to profile">Go to Profile</a>
    </nav>

    <div class="page">
        <div class="toolbar">
            <h1><?= esc($title) ?></h1>
            <a href="/photos/create" class="btn">+ Upload Photo</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <p class="flash"><?= session()->getFlashdata('success') ?></p>
        <?php endif; ?>

        <!-- Search & Filter -->
        <form method="get" action="/photos" class="search-bar">
            <input
                type="text"
                name="title"
                placeholder="Search by title..."
                value="<?= esc($filters['title'] ?? '') ?>"
            >

            <select name="category_id">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat['id']) ?>" <?= ($filters['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                        <?= esc($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input
                type="date"
                name="date_from"
                value="<?= esc($filters['date_from'] ?? '') ?>"
                title="From date"
            >

            <input
                type="date"
                name="date_to"
                value="<?= esc($filters['date_to'] ?? '') ?>"
                title="To date"
            >

            <button type="submit" class="btn">Search</button>

            <?php if (array_filter($filters)): ?>
                <a href="/photos" class="btn btn-clear">✕ Clear</a>
            <?php endif; ?>
        </form>

    <?php if (empty($photos)): ?>
        <p class="empty">No photos yet.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($photos as $photo): ?>
            <div class="card">
                <img src="/<?= esc($photo['image_path']) ?>" alt="<?= esc($photo['alt_text'] ?? $photo['title']) ?>">
                <div class="card-body">
                    <h3><?= esc($photo['title'] ?? 'Untitled') ?></h3>
                    <small><?= esc($photo['category_name']) ?></small><br>
                    <a href="/photos/<?= esc($photo['id']) ?>">View &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
</body>
</html>
