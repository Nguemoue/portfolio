<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/cvs/');
    exit;
}

$db = admin_db();

try {
    // Récupérer le chemin du fichier
    $cv = $db->query('SELECT file_path FROM cvs WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);
    
    if ($cv && $cv['file_path']) {
        $filePath = __DIR__ . '/../../..' . $cv['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    // Supprimer de la base
    $stmt = $db->prepare('DELETE FROM cvs WHERE id = ?');
    $stmt->execute([$id]);
    
    App\Auth::logActivity('delete', 'cvs', $id);
    
    header('Location: /admin/modules/cvs/?deleted=1');
} catch (Exception $e) {
    error_log('Error deleting CV: ' . $e->getMessage());
    header('Location: /admin/modules/cvs/?error=1');
}
exit;
