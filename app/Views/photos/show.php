<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f9f9f9; max-width: 760px; margin: 0 auto; }
        .photo-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 2rem; }
        .photo-card img { width: 100%; max-height: 460px; object-fit: cover; display: block; }
        .photo-info { padding: 1rem 1.5rem; }
        .photo-info h1 { margin: 0 0 0.3rem; }
        .photo-info small { color: #888; }
        .flash { background: #f0fdf4; color: #16a34a; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .comments { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; margin-bottom: 2rem; }
        .comments h2 { margin-top: 0; }
        .comment { border-bottom: 1px solid #eee; padding: 0.8rem 0; }
        .comment:last-child { border-bottom: none; }
        .comment strong { color: #333; }
        .comment p { margin: 0.3rem 0 0; color: #555; }
        .comment time { font-size: 0.78rem; color: #aaa; }
        .comment-form { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 1.5rem; }
        .comment-form h2 { margin-top: 0; }
        label { display: block; font-weight: bold; color: #444; margin-bottom: 0.3rem; }
        input, textarea { width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; box-sizing: border-box; margin-bottom: 0.3rem; }
        input:focus, textarea:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.15); }
        .form-group { margin-bottom: 1.1rem; }
        .error { color: #dc2626; font-size: 0.875rem; }
        button { background: #4f46e5; color: #fff; border: none; padding: 0.7rem 1.5rem; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        button:hover { background: #4338ca; }
        a { color: #4f46e5; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="flash"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>


    <div class="photo-card">
        <img src="/<?= esc($photo['image_path']) ?>" alt="<?= esc($photo['alt_text'] ?? $photo['title']) ?>">
       <div class="photo-info">
            <h1><?= esc($photo['title'] ?? 'Untitled') ?></h1>
            <small>
                By: <strong><?= esc($photo['photographer'] ?? 'Unknown') ?></strong> &bull;
                <?php if (!empty($photo['album_title'])): ?>
                    Album: <strong><?= esc($photo['album_title']) ?></strong> &bull;
                <?php endif; ?>
                Category: <strong><?= esc($photo['category_name']) ?></strong> &bull;
                <?= esc($photo['created_at']) ?>
            </small>
            <div style="margin-top: 0.8rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
                <?php if (session()->get('user_id') === $photo['photographer_id']): ?>
                    <a href="/photos/<?= esc($photo['id']) ?>/edit"
                    style="background:#4f46e5; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; text-decoration:none; font-size:0.9rem;">
                        Edit Photo
                    </a>
                <?php else: ?>
                    <a href="/photos/<?= esc($photo['id']) ?>/reports/create"
                    style="background:#dc2626; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; text-decoration:none; font-size:0.9rem;">
                        Report
                    </a>
                <?php endif; ?>

                <a href="/photos/<?= esc($photo['id']) ?>/album"
                style="background:#059669; color:#fff; padding:0.5rem 1.2rem; border-radius:6px; text-decoration:none; font-size:0.9rem;">
                    Add to Album
                </a>
            </div>
        </div>
    </div>

   
    <div class="comments">
        <h2>Comments (<?= count($comments) ?>)</h2>

        <?php if (empty($comments)): ?>
            <p style="color:#888;">No comments yet. Be the first!</p>
        <?php else: ?>
        <?php foreach ($comments as $c): ?>
        <div class="comment">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <strong><?= esc($c['author_name']) ?></strong>
                    <time>&nbsp;&bull; <?= esc($c['created_at']) ?></time>
                </div>
                <a href="/photos/<?= esc($photo['id']) ?>/comments/<?= esc($c['id']) ?>/delete"
                onclick="return confirm('Delete this comment?')"
                style="font-size:0.8rem; color:#dc2626; text-decoration:none;">
                    Delete
                </a>
            </div>
            <p><?= esc($c['comment']) ?></p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>


    <div class="comment-form">
        <h2>Leave a Comment</h2>

        <?php $errors = session()->getFlashdata('comment_errors') ?? []; ?>

        <form action="/photos/<?= esc($photo['id']) ?>/comments" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="author_name">Your Name</label>
                <input type="text" id="author_name" name="author_name" value="<?= old('author_name') ?>" placeholder="John Doe">
                <?php if (!empty($errors['author_name'])): ?>
                    <span class="error"><?= esc($errors['author_name']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" rows="4" placeholder="Write your comment..."><?= old('comment') ?></textarea>
                <?php if (!empty($errors['comment'])): ?>
                    <span class="error"><?= esc($errors['comment']) ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Post Comment</button>
        </form>
    </div>

    <br>
    <a href="/photos">&larr; Back to photos</a>
</body>
</html>