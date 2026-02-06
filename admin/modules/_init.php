<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Auth;
use App\Database\Database;

Auth::requireAuth();

function admin_db(): \PDO
{
    return Database::getInstance();
}

function admin_flash(string $message, string $type = 'success'): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function admin_redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}
