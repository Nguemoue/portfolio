<?php
require_once __DIR__ . '/../_init.php';
$pageTitle = 'Nouvelle formation';
$item = [
    'degree' => '',
    'institution' => '',
    'location' => '',
    'start_date' => '',
    'end_date' => '',
    'description' => '',
    'image' => '',
    'is_active' => 1,
    'order_position' => 0
];
include __DIR__ . '/../../components/header.php';
?>

<?php include __DIR__ . '/form.php'; ?>

<?php include __DIR__ . '/../../components/footer.php'; ?>
