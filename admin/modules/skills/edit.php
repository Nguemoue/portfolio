<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/skills/');
    exit;
}

$db = admin_db();
$skill = $db->query('SELECT * FROM skills WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);

if (!$skill) {
    header('Location: /admin/modules/skills/');
    exit;
}

$pageTitle = 'Modifier la compétence';
$isEdit = true;

include __DIR__ . '/../../components/header.php';
include __DIR__ . '/form.php';
include __DIR__ . '/../../components/footer.php';
