<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * @var array $users  List of user records returned by UserModel::all()
 */
$users = $users ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users · Mindoro State University</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/user.css'); ?>">
</head>
<body class="users-body">

    <div class="grid-overlay" aria-hidden="true"></div>

    <main class="terminal">

        <div class="terminal-bar">
            <div class="terminal-dots">
                <span></span><span></span><span></span>
            </div>
            <span class="terminal-path">minsu-net // registry / users</span>
            <span class="terminal-status"><span class="status-dot"></span>ONLINE</span>
        </div>

        <div class="terminal-body">

            <header class="users-header">
                <a href="<?= site_url('/'); ?>" class="users-back-link">&lt; return_home</a>
                <h1><span class="prompt"></span>USERS TABLE RECORDS</h1>
                <p class="users-subtitle">Mindoro State University &mdash; Calapan City Campus network</p>
            </header>

            <?php if (!empty($users)): ?>
                <div class="table-wrap">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>first_name</th>
                                <th>last_name</th>
                                <th>email</th>
                                <th>username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $user): ?>
                            <tr style="--row: <?= $i; ?>">
                                <td class="users-id">#<?= str_pad($user['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td><?= $user['firstname']; ?></td>
                                <td><?= $user['lastname']; ?></td>
                                <td class="users-email"><?= $user['email']; ?></td>
                                <td class="users-username">@<?= $user['username']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <p class="users-count"><span class="prompt">&gt;</span> <?= count($users); ?> record<?= count($users) === 1 ? '' : 's'; ?> returned</p>
            <?php else: ?>
                <div class="users-empty">
                    <p><span class="prompt">&gt;</span> query returned 0 rows.</p>
                </div>
            <?php endif; ?>

        </div>

    </main>

</body>
</html>