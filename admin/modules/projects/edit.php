<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_GET['id'] ?? 0);

$stmt = $db->prepare('SELECT * FROM projects WHERE id = ?');
$stmt->execute([$id]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    admin_flash('Projet introuvable.', 'error');
    admin_redirect('/admin/modules/projects/');
}

$pageTitle = 'Modifier projet';
include __DIR__ . '/../../components/header.php';
?>

<?php include __DIR__ . '/form.php'; ?>

<?php include __DIR__ . '/../../components/footer.php'; ?>
