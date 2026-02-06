<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/certifications/');
    exit;
}

$db = admin_db();

try {
    $stmt = $db->prepare('DELETE FROM certifications WHERE id = ?');
    $stmt->execute([$id]);
    
    App\Auth::logActivity('delete', 'certifications', $id);
    
    header('Location: /admin/modules/certifications/?deleted=1');
} catch (Exception $e) {
    error_log('Error deleting certification: ' . $e->getMessage());
    header('Location: /admin/modules/certifications/?error=1');
}
exit;
