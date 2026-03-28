<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

requireGuest();

$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (!$errors) {
        $user = findUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = 'Invalid email or password.';
        } else {
            loginUser($user);
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <p class="muted">Use your registered email and password.</p>

        <?php if ($errors): ?>
            <div class="error"><?= htmlspecialchars(implode(' ', $errors)) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($email) ?>" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Need an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>

