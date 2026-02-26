<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #64748b;
            --danger: #ef4444;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1.5rem;
            min-height: 100vh;
            padding: 1.5rem;
            color: #1e293b;
        }

        /* Container Card */
        .account-card {
            background: white;
            max-width: 440px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border);
            animation: fadeIn 0.4s ease-out;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--primary);
            letter-spacing: -0.025em;
        }

        /* Detail List */
        .detail-container {
            background: #f8fafc;
            border-radius: 16px;
            padding: 0.5rem 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid #f1f5f9;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #edf2f7;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--secondary);
        }

        .value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Album Grid */
        .album-section {
            max-width: 960px;
            width: 100%;
        }

        .album-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.85rem;
        }

        .album-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.85rem;
        }

        .album-add-btn {
            border: none;
            background: var(--primary);
            color: white;
            padding: 0.55rem 0.9rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .album-add-btn:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .album-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
        }

        .album-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.25rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 8px 20px -10px rgba(0, 0, 0, 0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .album-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -12px rgba(0, 0, 0, 0.18);
        }

        .album-icon {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #f1f5f9;
            color: #0f172a;
        }

        .album-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
            text-align: center;
        }

        .album-empty {
            padding: 0.85rem 1.25rem;
            font-size: 0.85rem;
            color: var(--secondary);
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .edit-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .edit-btn:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .logout-link {
            text-align: center;
            margin-top: 1rem;
            color: var(--secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .logout-link:hover {
            color: var(--danger);
        }

        /* Separator */
        .card-separator {
            margin: 2rem 0;
            border: 0;
            border-top: 1px solid #eee;
        }

        /* Danger Zone */
        .danger-zone {
            padding: 1.25rem;
            background: #fff1f2;
            border-radius: 16px;
            border: 1px dashed #fecaca;
        }

        .btn-delete-full {
            width: 100%;
            padding: 0.75rem;
            background-color: transparent;
            color: var(--danger);
            border: 1.5px solid var(--danger);
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete-full:hover {
            background-color: var(--danger);
            color: white;
        }

        .warning-text {
            margin-top: 0.75rem;
            font-size: 0.75rem;
            color: #991b1b;
            text-align: center;
            line-height: 1.4;
        }

        /* Modals & Overlays */
        .modal, .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            z-index: 1000;
        }

        .modal.show { display: flex; }

        .modal-content, .modal-box {
            background: white;
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
        }

        .modal-content h3, .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.4rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            background: #f8fafc;
            transition: all 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .switch-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: #e2e8f0;
            border-radius: 999px;
            transition: background-color 0.2s ease;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            top: 3px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .switch input:checked + .slider {
            background-color: #22c55e;
        }

        .switch input:checked + .slider:before {
            transform: translateX(20px);
        }

        .modal-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 0.8rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: #1e293b; }
        .btn-secondary { background: #f1f5f9; color: #475569; }
        .btn-secondary:hover { background: #e2e8f0; }
        .btn-confirm-delete { background: var(--danger); color: white; }
        .btn-confirm-delete:hover { background: #dc2626; }

        .close-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--secondary);
            transition: color 0.2s;
        }

        .close-icon:hover { color: var(--danger); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

    <div class="account-card">
        <h2>Account details</h2>

        <div class="detail-container">
            <div class="detail-row">
                <span class="label">Username</span>
                <span class="value"><?= esc($user['username']) ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Email</span>
                <span class="value"><?= esc($user['email']) ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Password</span>
                <span class="value">••••••••</span>
            </div>
        </div>

        <div class="btn-group">
            <button class="edit-btn" id="openEditModalBtn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Profile
            </button>
            <a href="/logout" class="logout-link">Logout from account</a>
        </div>

        <hr class="card-separator">

        <div class="danger-zone">
            <button type="button" class="btn-delete-full" onclick="openDeleteModal()">Delete Account</button>
            <p class="warning-text">Be careful. This action is permanent and cannot be undone.</p>
        </div>
    </div>

    <div class="album-section">
        <div class="album-header">
            <div class="album-title">Albums</div>
            <button class="album-add-btn" id="openAddAlbumModalBtn" type="button">Add Album</button>
        </div>
        <?php if (!empty($albums)): ?>
            <div class="album-grid">
                <?php foreach ($albums as $album): ?>
                    <a class="album-card" href="/albums/<?= esc($album['id']) ?>">
                        <div class="album-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                        </div>
                        <div class="album-name"><?= esc($album['title']) ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="album-empty">No albums found.</div>
        <?php endif; ?>
    </div>

    <div class="modal" id="addAlbumModal">
        <div class="modal-content">
            <span class="close-icon" id="closeAddAlbumModalX">&times;</span>
            <h3>Add Album</h3>

            <form action="/albums/create" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description">
                </div>
                <div class="form-group">
                    <div class="switch-row">
                        <label for="album-public">Public</label>
                        <label class="switch">
                            <input id="album-public" type="checkbox" name="is_public" value="1">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" id="cancelAddAlbumBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close-icon" id="closeModalX">&times;</span>
            <h3>Edit Account</h3>

            <form action="/profile/edit" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $user['username'] ?>">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep">
                </div>
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" placeholder="Required to save" required>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <h3 class="modal-title" style="color: var(--danger)">Delete Account?</h3>
            <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.5;">
                This will permanently delete all your data. Please enter your password to confirm.
            </p>

            <form action="/profile/delete" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="btn btn-confirm-delete">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Logika Modal Edit
        const modal = document.getElementById('editModal');
        const openBtn = document.getElementById('openEditModalBtn');
        const closeX = document.getElementById('closeModalX');
        const cancelBtn = document.getElementById('cancelBtn');
        const addAlbumModal = document.getElementById('addAlbumModal');
        const openAddAlbumBtn = document.getElementById('openAddAlbumModalBtn');
        const closeAddAlbumX = document.getElementById('closeAddAlbumModalX');
        const cancelAddAlbumBtn = document.getElementById('cancelAddAlbumBtn');

        openBtn.onclick = () => modal.classList.add('show');
        closeX.onclick = cancelBtn.onclick = () => modal.classList.remove('show');
        if (openAddAlbumBtn) openAddAlbumBtn.onclick = () => addAlbumModal.classList.add('show');
        if (closeAddAlbumX) closeAddAlbumX.onclick = () => addAlbumModal.classList.remove('show');
        if (cancelAddAlbumBtn) cancelAddAlbumBtn.onclick = () => addAlbumModal.classList.remove('show');
        window.onclick = (e) => {
            if (e.target === modal) modal.classList.remove('show');
            if (e.target === addAlbumModal) addAlbumModal.classList.remove('show');
            if (e.target === document.getElementById('deleteModal')) closeDeleteModal();
        }

        // Logika Modal Delete
        function openDeleteModal() { document.getElementById('deleteModal').style.display = 'flex'; }
        function closeDeleteModal() { document.getElementById('deleteModal').style.display = 'none'; }
    </script>
</body>
</html>
