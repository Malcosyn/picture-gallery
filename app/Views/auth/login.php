<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Really Simple Login</title>
    <style>
        /* minimal reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        /* Renamed to login-card for clarity */
        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            width: 100%;
            max-width: 360px;
            border: 1px solid #e2e8f0;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }

        /* Added error style just in case */
        .alert-error {
            background-color: #fee2e2;
            color: #ef4444;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            border: 1px solid #fecaca;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #334155;
        }

        input {
            padding: 0.6rem 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 1rem;
            background: #fafcfc;
            transition: border 0.1s;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
        }

        button {
            background: #0f172a;
            color: white;
            border: none;
            padding: 0.7rem;
            font-size: 1rem;
            border-radius: 40px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background 0.15s;
        }

        button:hover {
            background: #1e293b;
        }

        .footer-link {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }
        
        .footer-link a {
            color: #3b82f6;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Welcome back</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/login/verify" method="post">
            <?= csrf_field() ?>
            
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="hello@example.com" autocomplete="email" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="footer-link">
            Don't have an account? <a href="/register">Create one</a>
        </div>
    </div>
</body>
</html>