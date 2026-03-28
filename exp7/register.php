<?php

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

requireGuest();

$errors = [];
$successMessage = '';
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }

    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors && findUserByEmail($email)) {
        $errors[] = 'An account with this email already exists.';
    }

    if (!$errors) {
        registerUser($name, $email, $password);
        $successMessage = 'Registration successful. You can log in now.';
        $name = '';
        $email = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create account</h1>
        <p class="muted">Register with your name, email, and password.</p>

        <?php if ($errors): ?>
            <div class="error"><?= htmlspecialchars(implode(' ', $errors)) ?></div>
        <?php endif; ?>

        <?php if ($successMessage !== ''): ?>
            <div class="success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="<?= htmlspecialchars($name) ?>" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($email) ?>" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" required>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>

