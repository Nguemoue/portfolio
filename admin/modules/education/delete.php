<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    admin_flash('Formation introuvable.', 'error');
    admin_redirect('/admin/modules/education/');
}

$stmt = $db->prepare('DELETE FROM education WHERE id = ?');
$stmt->execute([$id]);

admin_flash('Formation supprimee.', 'success');
admin_redirect('/admin/modules/education/');
