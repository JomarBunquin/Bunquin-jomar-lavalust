<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Product Manager</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        }
        .card {
            background: #1e293b;
            padding: 2.5rem;
            border-radius: 12px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
        }
        h1 {
            color: #f8fafc;
            font-size: 1.4rem;
            margin: 0 0 1.5rem;
            text-align: center;
        }
        label {
            display: block;
            color: #cbd5e1;
            font-size: .85rem;
            margin-bottom: .3rem;
        }
        input {
            width: 100%;
            padding: .65rem .75rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            border: 1px solid #334155;
            background: #0f172a;
            color: #f1f5f9;
            font-size: .95rem;
        }
        button {
            width: 100%;
            padding: .7rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: .95rem;
            cursor: pointer;
        }
        button:hover { background: #2563eb; }
        .error {
            background: #7f1d1d;
            color: #fecaca;
            padding: .6rem .8rem;
            border-radius: 6px;
            font-size: .85rem;
            margin-bottom: 1rem;
        }
        .hint {
            color: #64748b;
            font-size: .75rem;
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Product Manager Login</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('login'); ?>" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Log In</button>
        </form>

        <p class="hint">Only authenticated users can manage products.</p>
    </div>
</body>
</html>
