<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/skills/');
    exit;
}

$db = admin_db();

try {
    $stmt = $db->prepare('DELETE FROM skills WHERE id = ?');
    $stmt->execute([$id]);
    
    App\Auth::logActivity('delete', 'skills', $id);
    
    header('Location: /admin/modules/skills/?deleted=1');
} catch (Exception $e) {
    error_log('Error deleting skill: ' . $e->getMessage());
    header('Location: /admin/modules/skills/?error=1');
}
exit;
