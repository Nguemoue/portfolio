<?php

namespace App;

use App\Database\Database;
use PDO;

class Auth
{
    private static ?string $sessionKey = 'admin_user';

    public static function login(string $username, string $password): bool
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND is_active = 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION[self::$sessionKey] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // Mettre à jour le dernier login
            $updateStmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$user['id']]);

            // Log de l'activité
            self::logActivityInternal($user['id'], 'login', 'users', $user['id']);

            return true;
        }

        return false;
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[self::$sessionKey])) {
            self::logActivityInternal($_SESSION[self::$sessionKey]['id'], 'logout', 'users', $_SESSION[self::$sessionKey]['id']);
            unset($_SESSION[self::$sessionKey]);
        }

        session_destroy();
    }

    public static function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION[self::$sessionKey]);
    }

    public static function user(): ?array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION[self::$sessionKey] ?? null;
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user['id'] ?? null;
    }

    public static function isSuperAdmin(): bool
    {
        $user = self::user();
        return $user && $user['role'] === 'super_admin';
    }

    public static function requireAuth(): void
    {
        if (!self::check()) {
            header('Location: /admin/login.php');
            exit;
        }
    }

    public static function requireSuperAdmin(): void
    {
        self::requireAuth();

        if (!self::isSuperAdmin()) {
            header('HTTP/1.1 403 Forbidden');
            exit('Accès refusé. Privilèges super administrateur requis.');
        }
    }

    /**
     * Log une activité dans le système
     * 
     * @param string $action Action effectuée (create, update, delete, login, etc.)
     * @param string $tableName Nom de la table concernée
     * @param int|null $recordId ID de l'enregistrement concerné
     * @param array $oldValues Anciennes valeurs (pour update)
     * @param array $newValues Nouvelles valeurs (pour create/update)
     */
    public static function logActivity(string $action, string $tableName, ?int $recordId = null, array $oldValues = [], array $newValues = []): void
    {
        $userId = self::id();
        
        if (!$userId) {
            return; // Pas d'utilisateur connecté, on ne log pas
        }
        
        try {
            $db = Database::getInstance();

            $stmt = $db->prepare("
                INSERT INTO activity_logs (user_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $userId,
                $action,
                $tableName,
                $recordId,
                $oldValues ? json_encode($oldValues) : null,
                $newValues ? json_encode($newValues) : null,
                $_SERVER['REMOTE_ADDR'] ?? null,
                $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
        } catch (\Exception $e) {
            error_log("Erreur lors de l'enregistrement de l'activité: " . $e->getMessage());
        }
    }
    
    /**
     * Méthode privée pour logger les activités internes (login, logout)
     */
    private static function logActivityInternal(int $userId, string $action, string $tableName, ?int $recordId = null): void
    {
        try {
            $db = Database::getInstance();

            $stmt = $db->prepare("
                INSERT INTO activity_logs (user_id, action, table_name, record_id, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $userId,
                $action,
                $tableName,
                $recordId,
                $_SERVER['REMOTE_ADDR'] ?? null,
                $_SERVER['HTTP_USER_AGENT'] ?? null
            ]);
        } catch (\Exception $e) {
            error_log("Erreur lors de l'enregistrement de l'activité: " . $e->getMessage());
        }
    }

    public static function getActivityLogs(int $limit = 50): array
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("
            SELECT al.*, u.username 
            FROM activity_logs al
            LEFT JOIN users u ON al.user_id = u.id
            ORDER BY al.created_at DESC
            LIMIT ?
        ");

        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function changePassword(int $userId, string $newPassword): bool
    {
        $db = Database::getInstance();

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $stmt = $db->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?");
            $result = $stmt->execute([$hashedPassword, $userId]);

            if ($result) {
                self::logActivity('change_password', 'users', $userId);
            }

            return $result;
        } catch (\Exception $e) {
            return false;
        }
    }
}
