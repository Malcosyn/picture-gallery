<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Welcome Back</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Modern Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            /* Background gradien lembut agar terlihat profesional */
            background: radial-gradient(circle at top left, #f8fafc, #e2e8f0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1.5rem;
            color: #1e293b;
        }

        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 24px;
            /* Soft shadow berlapis agar kartu terlihat "melayang" */
            box-shadow: 
                0 10px 25px -5px rgba(0, 0, 0, 0.04),
                0 20px 48px -12px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            animation: fadeIn 0.5s ease-out;
        }

        .header {
            margin-bottom: 2rem;
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 0.95rem;
            color: #64748b;
        }

        /* Styling Error Alert */
        .alert-error {
            background-color: #fff1f2;
            color: #e11d48;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border: 1px solid #ffe4e6;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-left: 0.2rem;
        }

        input {
            padding: 0.8rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            background: #f8fafc;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
        }

        input::placeholder {
            color: #cbd5e1;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        button {
            background: #0f172a;
            color: white;
            border: none;
            padding: 0.9rem;
            font-size: 1rem;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.2);
        }

        button:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.25);
        }

        .footer-link {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.925rem;
            color: #64748b;
        }
        
        .footer-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer-link a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="header">
            <h2>Welcome back</h2>
            <p class="subtitle">Please enter your details to sign in.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/login/verify" method="post">
            <?= csrf_field() ?>
            
            <div class="field">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="name@company.com" autocomplete="email" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="footer-link">
            Don't have an account? <a href="/register">Create an account</a>
        </div>
    </div>
</body>
</html>