<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'title' => trim($_POST['title'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'project_url' => trim($_POST['project_url'] ?? ''),
    'github_url' => trim($_POST['github_url'] ?? ''),
    'image' => trim($_POST['image'] ?? ''),
    'category' => $_POST['category'] ?? 'personnel',
    'is_active' => (int) ($_POST['is_active'] ?? 1),
    'order_position' => (int) ($_POST['order_position'] ?? 0)
];

if ($data['title'] === '') {
    admin_flash('Le titre du projet est obligatoire.', 'error');
    admin_redirect('/admin/modules/projects/' . ($id ? 'edit.php?id=' . $id : 'create.php'));
}

if ($id > 0) {
    $sql = "UPDATE projects SET title = :title, description = :description, project_url = :project_url, github_url = :github_url, image = :image, category = :category, is_active = :is_active, order_position = :order_position WHERE id = :id";
    $data['id'] = $id;
} else {
    $sql = "INSERT INTO projects (title, description, project_url, github_url, image, category, is_active, order_position) VALUES (:title, :description, :project_url, :github_url, :image, :category, :is_active, :order_position)";
}

$stmt = $db->prepare($sql);
$stmt->execute($data);

admin_flash('Projet enregistre.', 'success');
admin_redirect('/admin/modules/projects/');
