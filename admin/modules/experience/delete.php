<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/experience/');
    exit;
}

$db = admin_db();

try {
    $stmt = $db->prepare('DELETE FROM experiences WHERE id = ?');
    $stmt->execute([$id]);
    
    App\Auth::logActivity('delete', 'experiences', $id);
    
    header('Location: /admin/modules/experience/?deleted=1');
} catch (Exception $e) {
    error_log('Error deleting experience: ' . $e->getMessage());
    header('Location: /admin/modules/experience/?error=1');
}
exit;
