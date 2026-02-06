<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    admin_flash('Projet introuvable.', 'error');
    admin_redirect('/admin/modules/projects/');
}

$stmt = $db->prepare('DELETE FROM projects WHERE id = ?');
$stmt->execute([$id]);

admin_flash('Projet supprime.', 'success');
admin_redirect('/admin/modules/projects/');
