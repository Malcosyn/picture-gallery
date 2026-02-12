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
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
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
            background-color: rgba(0,0,0,0.3);
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
            box-shadow: 0 20px 35px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>

    <!-- ACCOUNT DETAIL VIEW -->
    <div class="account-card">
        <h2>Account details</h2>

        <div class="detail-row">
            <span class="label">Username</span>
            <span class="value" id="display-username"><?= $user['username'] ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Email</span>
            <span class="value" id="display-email"><?= $user['email'] ?></span>
        </div>
        <div class="detail-row">
            <span class="label">Password</span>
            <span class="value" id="display-password">••••••••</span>
        </div>

        <!-- single edit button -->
        <button class="edit-btn" id="openEditModalBtn">✎ Edit account</button>
    </div>

    <!-- MODAL POPUP (hidden by default) -->
    <div class="modal" id="editModal">
        <div class="modal-content">

            <span class="close-icon" id="closeModalX">&times;</span>
            <h3>Edit your info</h3>

            <form id="editForm">
                <!-- username -->
                <div class="form-group">
                    <label for="edit-username">Username</label>
                    <input type="text" id="edit-username" name="username" value="johndoe">
                </div>
                <!-- email -->
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input type="email" id="edit-email" name="email" value="john@example.com">
                </div>
                <!-- new password -->
                <div class="form-group">
                    <label for="edit-password">New password</label>
                    <input type="password" id="edit-password" name="password" placeholder="Leave blank to keep current">
                </div>
                <!-- current password (for editing) -->
                <div class="form-group">
                    <label for="current-password">Current password</label>
                    <input type="password" id="current-password" name="current_password" placeholder="Required to save changes">
                </div>

                <div class="modal-actions">
                    <!-- SAVED / SAVE BUTTON -->
                    <button type="button" class="btn btn-primary" id="saveBtn">Saved</button>
                    <!-- CANCEL BUTTON -->
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
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

            // ----- save button action (just demo) -----
            saveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // very simple: alert with dummy message, then close modal
                alert('Changes saved (demo).');
                closeModal();
                // (the account detail fields are not updated – this is just the view)
            });

            // optional: prevent form submission if enter pressed (since we have type="button")
            // but it's fine.
        })();
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