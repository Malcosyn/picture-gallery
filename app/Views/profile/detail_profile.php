<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Really Simple Account Detail</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        /* account card */
        .account-card {
            background: white;
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }

        .account-card h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #0a0a0a;
        }

        .detail-row {
            display: flex;
            align-items: baseline;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-of-type {
            border-bottom: none;
        }

        .label {
            width: 100px;
            font-weight: 500;
            color: #475569;
        }

        .value {
            color: #0f172a;
            font-family: monospace;
        }

        .edit-btn {
            background: #0f172a;
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 500;
            margin-top: 1.5rem;
            width: 100%;
            cursor: pointer;
            transition: background 0.15s;
        }

        .edit-btn:hover {
            background: #1e293b;
        }

        /* modal – hidden by default */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            max-width: 420px;
            width: 100%;
            padding: 2rem;
            border-radius: 28px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9eef3;
        }

        .modal-content h3 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.25rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            font-size: 0.95rem;
            background: #fafcfc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
        }

        .modal-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 0.7rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.1s;
        }

        .btn-primary {
            background: #0f172a;
            color: white;
        }

        .btn-primary:hover {
            background: #1e293b;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #1e293b;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        /* tiny close icon */
        .close-icon {
            float: right;
            font-size: 1.5rem;
            font-weight: 300;
            line-height: 1;
            cursor: pointer;
            color: #94a3b8;
        }

        .close-icon:hover {
            color: #475569;
        }

        /* The container for the bottom section */
        .danger-zone {
            margin-top: 20px;
            text-align: center;
            /* Centers the text below the button */
        }

        .card-separator {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #eee;
        }

        /* The Full Width Button */
        .btn-delete-full {
            width: 100%;
            /* Takes up full card width */
            display: block;
            padding: 12px;
            background-color: #fff;
            color: #dc3545;
            /* Red text */
            border: 1px solid #dc3545;
            /* Red border */
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        /* Hover Effect */
        .btn-delete-full:hover {
            background-color: #dc3545;
            color: white;
        }

        /* The Warning Text */
        .warning-text {
            margin-top: 10px;
            /* Space between button and text */
            font-size: 0.85rem;
            color: #6c757d;
            /* Muted gray color */
            margin-bottom: 0;
        }

        /* The Dark Background Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* Sit on top of everything */
        }

        /* The White Box */
        .modal-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);

            /* NEW: Align everything to the left by default */
            text-align: left;
        }

        /* Title Styling */
        .modal-title {
            color: #dc3545;
            /* Red color for danger */
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        /* Warning Text Styling */
        .modal-warning {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            /* Ensures padding doesn't break width */
        }

        /* Button Container */
        .modal-actions {
            display: flex;
            gap: 10px;

            /* NEW: Push buttons to the right side */
            justify-content: flex-end;

            margin-top: 10px;
        }

        /* Delete Button (Red) */
        .btn-confirm-delete {
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-confirm-delete:hover {
            background: #c82333;
        }

        /* Cancel Button (Gray) */
        .btn-cancel {
            padding: 10px 20px;
            background: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #e2e6ea;
        }
    </style>
</head>

<body>

    <!-- ACCOUNT DETAIL VIEW -->
    <div class="account-card">
        <h2>Account details</h2>

        <div class="detail-row">
            <span class="label">Username</span>
            <span class="value" id="display-username"><?= esc($user['username']) ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Email</span>
            <span class="value" id="display-email"><?= esc($user['email']) ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Password</span>
            <span class="value" id="display-password">••••••••</span>
        </div>

        <button class="edit-btn" id="openEditModalBtn">✎ Edit account</button>

        <hr class="card-separator">

        <div class="danger-zone">
            <button type="button" class="btn-delete-full" onclick="openDeleteModal()">Delete Account</button>
            <p class="warning-text">Once you delete your account, there is no going back.</p>
        </div>
    </div>


    <!-- MODAL POPUP (hidden by default) -->
    <div class="modal" id="editModal">
        <div class="modal-content">

            <span class="close-icon" id="closeModalX">&times;</span>
            <h3>Edit your info</h3>

            <form action="/profile/edit" method="post">
                <?= csrf_field() ?>
                <!-- username -->
                <div class="form-group">
                    <label for="edit-username">Username</label>
                    <input type="text" id="edit-username" name="username" value="<?= $user['username'] ?>">
                </div>
                <!-- email -->
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input type="email" id="edit-email" name="email" value="<?= $user['email'] ?>">
                </div>
                <!-- new password -->
                <div class="form-group">
                    <label for="edit-password">New password</label>
                    <input type="password" id="edit-password" name="password" placeholder="Leave blank to keep current">
                </div>
                <!-- current password (for editing) -->
                <div class="form-group">
                    <label for="current-password">Current password</label>
                    <input type="password" id="current-password" name="current_password" placeholder="Required to save changes" required>
                </div>

                <div class="modal-actions">
                    <!-- SAVED / SAVE BUTTON -->
                    <button type="submit" class="btn btn-primary" id="saveBtn">Saved</button>
                    <!-- CANCEL BUTTON -->
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <div id="deleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <h3 class="modal-title">Delete Account</h3>
            <p class="modal-warning">This action is <strong>permanent</strong>. All your photos and data will be wiped immediately.</p>

            <form action="/profile/delete" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">

                <div class="form-group">
                    <label for="confirm-password" style="display:block; text-align: left; margin-bottom: 5px;">Password:</label>
                    <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Enter password to confirm" required>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn-confirm-delete">Delete Account</button>
                    <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            "use strict";

            // ----- DOM elements -----
            const modal = document.getElementById('editModal');
            const openBtn = document.getElementById('openEditModalBtn');
            const closeX = document.getElementById('closeModalX');
            const cancelBtn = document.getElementById('cancelBtn');
            const saveBtn = document.getElementById('saveBtn');

            // display fields (just for visual, we are not implementing full update logic)
            // in a real demo we could update them, but the request is for the view + popup.
            // we keep them static.

            // ----- open modal -----
            function openModal() {
                modal.classList.add('show');
                // (optional) pre-fill form with current values – already done in HTML
            }

            // ----- close modal -----
            function closeModal() {
                modal.classList.remove('show');
            }

            // ----- event listeners -----
            openBtn.addEventListener('click', openModal);

            closeX.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);

            // click outside modal to close
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // optional: prevent form submission if enter pressed (since we have type="button")
            // but it's fine.
        })();
    </script>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Optional: Close if clicking outside the box
        window.onclick = function(event) {
            var modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeDeleteModal();
            }
        }
    </script>

    <!-- 
        Explanation: 
        - Account card shows username, email, password (masked).
        - One "Edit account" button opens the modal.
        - Modal contains form to edit username, email, password, and a field for current password.
        - Buttons: "Saved" (save) and "Cancel". 
        - Fully functional open/close, demo alert on save.
        - No backend, just the view as requested. 
    -->
</body>

</html>