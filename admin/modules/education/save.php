<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'degree' => trim($_POST['degree'] ?? ''),
    'institution' => trim($_POST['institution'] ?? ''),
    'location' => trim($_POST['location'] ?? ''),
    'start_date' => $_POST['start_date'] ?? null,
    'end_date' => $_POST['end_date'] ?? null,
    'description' => trim($_POST['description'] ?? ''),
    'image' => trim($_POST['image'] ?? ''),
    'is_active' => (int) ($_POST['is_active'] ?? 1),
    'order_position' => (int) ($_POST['order_position'] ?? 0)
];

if ($data['degree'] === '' || $data['institution'] === '') {
    admin_flash('Le diplome et l\'etablissement sont obligatoires.', 'error');
    admin_redirect('/admin/modules/education/' . ($id ? 'edit.php?id=' . $id : 'create.php'));
}

if ($id > 0) {
    $sql = "UPDATE education SET degree = :degree, institution = :institution, location = :location, start_date = :start_date, end_date = :end_date, description = :description, image = :image, is_active = :is_active, order_position = :order_position WHERE id = :id";
    $data['id'] = $id;
} else {
    $sql = "INSERT INTO education (degree, institution, location, start_date, end_date, description, image, is_active, order_position) VALUES (:degree, :institution, :location, :start_date, :end_date, :description, :image, :is_active, :order_position)";
}

$stmt = $db->prepare($sql);
$stmt->execute($data);

admin_flash('Formation enregistree.', 'success');
admin_redirect('/admin/modules/education/');
