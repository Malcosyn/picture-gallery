<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($album['title'] ?? 'Album') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #1e293b;
            padding: 2rem 1.5rem 3rem;
        }

        .page {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .subtitle {
            color: var(--secondary);
            margin-top: 0.35rem;
            font-size: 0.95rem;
        }

        .back-link {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.2rem;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 25px -15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px -18px rgba(0, 0, 0, 0.25);
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        .card-body {
            padding: 0.9rem 1rem 1.1rem;
        }

        .photo-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .photo-meta {
            font-size: 0.85rem;
            color: var(--secondary);
        }

        .empty {
            background: white;
            border: 1px dashed var(--border);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div>
                <div class="title"><?= esc($album['title'] ?? 'Album') ?></div>
                <?php if (!empty($album['description'])): ?>
                    <div class="subtitle"><?= esc($album['description']) ?></div>
                <?php endif; ?>
            </div>
            <a class="back-link" href="/profile">&larr; Back to profile</a>
        </div>

        <?php if (empty($photos)): ?>
            <div class="empty">No photos in this album yet.</div>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($photos as $photo): ?>
                    <div class="card">
                        <img src="/<?= esc($photo['image_path']) ?>" alt="<?= esc($photo['alt_text'] ?? $photo['title']) ?>">
                        <div class="card-body">
                            <div class="photo-title"><?= esc($photo['title'] ?? 'Untitled') ?></div>
                            <div class="photo-meta">
                                <?= esc($photo['category_name']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
