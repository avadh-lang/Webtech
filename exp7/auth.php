<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function requireGuest(): void
{
    if (isLoggedIn()) {
        header('Location: index.php');
        exit;
    }
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function findUserByEmail(string $email): array|false
{
    $statement = getDb()->prepare('SELECT id, name, email, password FROM users WHERE email = :email LIMIT 1');
    $statement->execute(['email' => $email]);

    return $statement->fetch();
}

function registerUser(string $name, string $email, string $password): void
{
    $statement = getDb()->prepare(
        'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)'
    );

    $statement->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);
}

function loginUser(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
}

function logoutUser(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}

