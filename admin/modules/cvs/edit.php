<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/cvs/');
    exit;
}

$db = admin_db();
$cv = $db->query('SELECT * FROM cvs WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);

if (!$cv) {
    header('Location: /admin/modules/cvs/');
    exit;
}

$pageTitle = 'Modifier le CV';
$isEdit = true;

include __DIR__ . '/../../components/header.php';
include __DIR__ . '/form.php';
include __DIR__ . '/../../components/footer.php';
