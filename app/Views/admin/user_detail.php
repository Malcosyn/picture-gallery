<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail</title>
    <style>
        :root {
            --bg: #0f172a;
            --panel: #111827;
            --text: #e5e7eb;
            --muted: #94a3b8;
            --border: #1f2937;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top left, #0b1220 0%, #020617 60%);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem;
        }

        .page {
            max-width: 720px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.5rem;
        }

        .title {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text);
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 0.45rem 0.7rem;
            border-radius: 10px;
            background: #0b1220;
            font-size: 0.85rem;
            font-weight: 600;
            width: fit-content;
        }

        .action-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.55rem 0.9rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            color: var(--text);
            background: #0b1220;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
        }

        .action-btn:hover { border-color: #22c55e; }

        .row {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .row:last-child { border-bottom: none; }
        .label { color: var(--muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .value { font-size: 0.95rem; }

        .flash {
            padding: 0.75rem 0.9rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: #0b1220;
            font-size: 0.9rem;
        }

        .flash-success { color: #86efac; border-color: rgba(34, 197, 94, 0.5); }
        .flash-error { color: #fecaca; border-color: rgba(239, 68, 68, 0.5); }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .modal.show { display: flex; }

        .modal-content {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.5rem;
            width: 100%;
            max-width: 420px;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #0b1220;
            color: var(--text);
            font-size: 0.9rem;
        }

        .modal-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn-secondary {
            border: 1px solid var(--border);
            background: transparent;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <div class="page">
        <a class="back-link" href="/admin#users">&#8592; Back to Admin</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash flash-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash flash-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="flash flash-error">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <div><?= esc($err) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="title">User Detail</div>

            <div class="action-row" style="margin-top: 0.85rem;">
                <button class="action-btn" type="button" id="openEditUser">Edit User</button>
            </div>

            <div class="row">
                <div class="label">ID</div>
                <div class="value"><?= esc($user['id'] ?? '-') ?></div>
            </div>
            <div class="row">
                <div class="label">Username</div>
                <div class="value"><?= esc($user['username'] ?? '-') ?></div>
            </div>
            <div class="row">
                <div class="label">Email</div>
                <div class="value"><?= esc($user['email'] ?? '-') ?></div>
            </div>
            <div class="row">
                <div class="label">Created At</div>
                <div class="value"><?= esc($user['created_at'] ?? '-') ?></div>
            </div>
            <div class="row">
                <div class="label">Updated At</div>
                <div class="value"><?= esc($user['updated_at'] ?? '-') ?></div>
            </div>
        </div>
    </div>

    <div class="modal" id="editUserModal" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-title">Edit User</div>
            <form action="/admin/users/<?= esc($user['id']) ?>/update" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= esc($user['username'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current">
                </div>
                <div class="modal-actions">
                    <button class="action-btn btn-secondary" type="button" id="closeEditUser">Cancel</button>
                    <button class="action-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('editUserModal');
        const openBtn = document.getElementById('openEditUser');
        const closeBtn = document.getElementById('closeEditUser');

        if (openBtn) {
            openBtn.addEventListener('click', () => editModal.classList.add('show'));
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', () => editModal.classList.remove('show'));
        }
        window.addEventListener('click', (e) => {
            if (e.target === editModal) editModal.classList.remove('show');
        });
    </script>
</body>
</html>
