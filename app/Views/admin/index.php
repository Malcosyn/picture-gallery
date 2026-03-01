<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --panel: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --accent: #2563eb;
            --danger: #ef4444;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            color: var(--text);
            min-height: 100vh;
            margin: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 2rem;
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .topbar-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: #111827;
        }

        .topbar-link {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.8rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #f8fafc;
            color: #1e293b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .topbar-link:hover {
            background: #eef2ff;
            border-color: #c7d2fe;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 2rem;
            align-items: start;
            padding: 2rem;
        }

        .sidebar {
            position: sticky;
            top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1rem;
            height: fit-content;
        }

        .nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.7rem 0.85rem;
            border-radius: 12px;
            color: var(--text);
            text-decoration: none;
            border: 1px solid transparent;
            background: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            border-color: var(--border);
            transform: translateY(-1px);
        }

        .nav-link.active {
            border-color: var(--accent);
            box-shadow: 0 0 0 1px rgba(34, 197, 94, 0.3);
        }

        .section[hidden] { display: none; }

        .section-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .search-input {
            background: #ffffff;
            border: 1px solid var(--border);
            color: var(--text);
            padding: 0.6rem 0.75rem;
            border-radius: 10px;
            font-size: 0.9rem;
            min-width: 220px;
        }

        .search-input::placeholder { color: var(--muted); }

        .row-hidden { display: none; }

        .content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .hero {
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            padding: 1.8rem 2rem;
            border-radius: 18px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .hero h1 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .hero p {
            color: var(--muted);
            margin-top: 0.35rem;
        }

        .stat-badges {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .badge {
            background: #ffffff;
            border: 1px solid var(--border);
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .section {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 1.5rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            text-align: left;
            padding: 0.85rem 0.7rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .table th {
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
        }

        .table a {
            color: var(--accent);
            text-decoration: none;
        }

        .table a:hover { text-decoration: underline; }

        .pill {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .pill-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #b91c1c;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .pill-muted {
            background: rgba(148, 163, 184, 0.12);
            color: #334155;
            border-color: rgba(148, 163, 184, 0.3);
        }

        .action-group {
            display: inline-flex;
            gap: 0.5rem;
            align-items: center;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            color: var(--text);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            background: #ffffff;
        }

        .action-link:hover { border-color: var(--accent); }

        .action-btn {
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.5);
            background: #fff5f5;
            color: #b91c1c;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }

        .action-btn:hover { background: rgba(239, 68, 68, 0.12); }

        .photo-thumb {
            width: 56px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .empty {
            color: var(--muted);
            padding: 1rem 0;
            font-size: 0.95rem;
        }

        @media (max-width: 900px) {
            .topbar { padding: 0.85rem 1rem; }
            .page { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .hero { flex-direction: column; align-items: flex-start; }
            .table th, .table td { padding: 0.7rem 0.5rem; }
        }
    </style>
</head>
<body>
    <nav class="topbar">
        <div class="topbar-title">Admin Panel</div>
        <a href="/profile" class="topbar-link">Go to Profile</a>
    </nav>

    <div class="page">
        <aside class="sidebar">
            <div class="nav-title">Navigation</div>
            <a class="nav-link active" href="#reported-photos" data-section="reported-photos">Reported Photos</a>
            <a class="nav-link" href="#users" data-section="users">Users</a>
        </aside>

        <div class="content">
            <section class="hero">
                <div>
                    <h1>Admin Panel</h1>
                    <p>Monitor reported photos and user accounts.</p>
                </div>
                <div class="stat-badges">
                    <div class="badge">Reported: <?= esc($reportedCount ?? (is_array($reportedPhotos ?? null) ? count($reportedPhotos) : 0)) ?></div>
                    <div class="badge">Users: <?= esc($userCount ?? (is_array($users ?? null) ? count($users) : 0)) ?></div>
                </div>
            </section>

        <section class="section" id="reported-photos" data-section>
            <div class="section-toolbar">
                <div class="section-title">Manage Reports</div>
                <input class="search-input" type="search" placeholder="Search reports..." data-search="reports">
            </div>

            <div class="empty" id="reports-empty" <?= empty($reportedPhotos) ? '' : 'hidden' ?>>No reported photos.</div>
            <table class="table" id="reports-table" <?= empty($reportedPhotos) ? 'hidden' : '' ?>>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Reason</th>
                        <th>Reported At</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody id="reports-body">
                    <?php foreach ($reportedPhotos as $report): ?>
                        <tr class="report-row">
                            <td>
                                <?php if (!empty($report['image_path'])): ?>
                                    <img class="photo-thumb" src="/<?= esc($report['image_path']) ?>" alt="<?= esc($report['title'] ?? 'Photo') ?>">
                                <?php else: ?>
                                    <span class="pill pill-muted">No image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($report['title'] ?? 'Untitled') ?></td>
                            <td><?= esc($report['reason'] ?? '-') ?></td>
                            <td><?= esc($report['created_at'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($report['photo_id'])): ?>
                                    <a href="/photos/<?= esc($report['photo_id']) ?>">View</a>
                                <?php else: ?>
                                    <span class="pill pill-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="section" id="users" data-section hidden>
            <div class="section-toolbar">
                <div class="section-title">Manage Users</div>
                <input class="search-input" type="search" placeholder="Search users..." data-search="users">
            </div>

            <div class="empty" id="users-empty" <?= empty($users) ? '' : 'hidden' ?>>No users found.</div>
            <table class="table" id="users-table" <?= empty($users) ? 'hidden' : '' ?>>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="users-body">
                    <?php foreach ($users as $user): ?>
                        <tr class="user-row">
                            <td><?= esc($user['username'] ?? '-') ?></td>
                            <td><?= esc($user['email'] ?? '-') ?></td>
                            <td><?= esc($user['created_at'] ?? '-') ?></td>
                            <td>
                                <div class="action-group">
                                    <a class="action-link" href="/admin/users/<?= esc($user['id']) ?>">Detail</a>
                                    <form action="/admin/users/<?= esc($user['id']) ?>/delete" method="post" onsubmit="return confirm('Delete this user?')">
                                        <?= csrf_field() ?>
                                        <button class="action-btn" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        </div>
    </div>

    <script>
        const navLinks = Array.from(document.querySelectorAll('.nav-link'));
        const sections = Array.from(document.querySelectorAll('[data-section]'));

        function showSection(id) {
            sections.forEach(section => {
                section.hidden = section.id !== id;
            });
            navLinks.forEach(link => {
                link.classList.toggle('active', link.dataset.section === id);
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                showSection(link.dataset.section);
                history.replaceState(null, '', `#${link.dataset.section}`);
            });
        });

        const reportsSearch = document.querySelector('[data-search="reports"]');
        const usersSearch = document.querySelector('[data-search="users"]');
        const reportsBody = document.getElementById('reports-body');
        const usersBody = document.getElementById('users-body');
        const reportsTable = document.getElementById('reports-table');
        const usersTable = document.getElementById('users-table');
        const reportsEmpty = document.getElementById('reports-empty');
        const usersEmpty = document.getElementById('users-empty');

        function toggleTable(hasRows, tableEl, emptyEl) {
            if (!tableEl || !emptyEl) return;
            tableEl.hidden = !hasRows;
            emptyEl.hidden = hasRows;
        }

        function renderReports(rows) {
            if (!reportsBody) return;
            reportsBody.innerHTML = rows.map(report => {
                const image = report.image_path
                    ? `<img class="photo-thumb" src="/${report.image_path}" alt="${(report.title || 'Photo').replace(/"/g, '&quot;')}">`
                    : `<span class="pill pill-muted">No image</span>`;
                const title = report.title || 'Untitled';
                const reason = report.reason || '-';
                const created = report.created_at || '-';
                const link = report.photo_id
                    ? `<a href="/photos/${report.photo_id}">View</a>`
                    : `<span class="pill pill-muted">N/A</span>`;
                return `
                    <tr class="report-row">
                        <td>${image}</td>
                        <td>${title}</td>
                        <td>${reason}</td>
                        <td>${created}</td>
                        <td>${link}</td>
                    </tr>
                `;
            }).join('');
            toggleTable(rows.length > 0, reportsTable, reportsEmpty);
        }

        function renderUsers(rows) {
            if (!usersBody) return;
            usersBody.innerHTML = rows.map(user => {
                const id = user.id || '';
                const username = user.username || '-';
                const email = user.email || '-';
                const created = user.created_at || '-';
                return `
                    <tr class="user-row">
                        <td>${username}</td>
                        <td>${email}</td>
                        <td>${created}</td>
                        <td>
                            <div class="action-group">
                                <a class="action-link" href="/admin/users/${id}">Detail</a>
                                <form action="/admin/users/${id}/delete" method="post" onsubmit="return confirm('Delete this user?')">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                    <button class="action-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
            toggleTable(rows.length > 0, usersTable, usersEmpty);
        }

        async function fetchSearch(section, query) {
            const url = new URL('/admin/search', window.location.origin);
            url.searchParams.set('section', section);
            url.searchParams.set('q', query);
            const response = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
            if (!response.ok) return null;
            return response.json();
        }

        let reportTimer = null;
        let userTimer = null;

        if (reportsSearch) {
            reportsSearch.addEventListener('input', () => {
                clearTimeout(reportTimer);
                reportTimer = setTimeout(async () => {
                    const data = await fetchSearch('reports', reportsSearch.value.trim());
                    if (data && data.section === 'reports') renderReports(data.data || []);
                }, 200);
            });
        }

        if (usersSearch) {
            usersSearch.addEventListener('input', () => {
                clearTimeout(userTimer);
                userTimer = setTimeout(async () => {
                    const data = await fetchSearch('users', usersSearch.value.trim());
                    if (data && data.section === 'users') renderUsers(data.data || []);
                }, 200);
            });
        }

        const initialHash = window.location.hash.replace('#', '');
        if (initialHash && document.getElementById(initialHash)) {
            showSection(initialHash);
        }
    </script>
</body>
</html>
