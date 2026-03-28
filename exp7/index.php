<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars((string) $_SESSION['user_name']) ?></h1>
        <p>You are logged in with <strong><?= htmlspecialchars((string) $_SESSION['user_email']) ?></strong>.</p>
        <p class="muted">This page is protected by a PHP session.</p>

        <div class="actions">
            <a class="button-link secondary" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

