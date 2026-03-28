<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const DB_HOST = '127.0.0.1';
const DB_PORT = 3308;
const DB_NAME = 'auth_app';
const DB_USER = 'root';
const DB_PASS = '';
const DB_SOCKET = '/tmp/homebrew-mysql.sock';
