<?php
require_once __DIR__ . '/../_init.php';

$id = (int) ($_GET['id'] ?? 0);
if (!$id) {
    header('Location: /admin/modules/experience/');
    exit;
}

$db = admin_db();
$experience = $db->query('SELECT * FROM experiences WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);

if (!$experience) {
    header('Location: /admin/modules/experience/');
    exit;
}

$pageTitle = 'Modifier l\'expérience';
$isEdit = true;

include __DIR__ . '/../../components/header.php';
include __DIR__ . '/form.php';
include __DIR__ . '/../../components/footer.php';
