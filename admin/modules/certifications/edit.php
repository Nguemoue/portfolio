<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/certifications/');
    exit;
}

$db = admin_db();
$certification = $db->query('SELECT * FROM certifications WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);

if (!$certification) {
    header('Location: /admin/modules/certifications/');
    exit;
}

$pageTitle = 'Modifier la certification';
$isEdit = true;

include __DIR__ . '/../../components/header.php';
include __DIR__ . '/form.php';
include __DIR__ . '/../../components/footer.php';
