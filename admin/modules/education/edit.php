<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_GET['id'] ?? 0);

$stmt = $db->prepare('SELECT * FROM education WHERE id = ?');
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    admin_flash('Formation introuvable.', 'error');
    admin_redirect('/admin/modules/education/');
}

$pageTitle = 'Modifier formation';
include __DIR__ . '/../../components/header.php';
?>

<?php include __DIR__ . '/form.php'; ?>

<?php include __DIR__ . '/../../components/footer.php'; ?>
