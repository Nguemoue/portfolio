<?php
require_once __DIR__ . '/../_init.php';

$db = admin_db();

$data = [
    'name' => trim($_POST['name'] ?? ''),
    'title' => trim($_POST['title'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'whatsapp' => trim($_POST['whatsapp'] ?? ''),
    'location' => trim($_POST['location'] ?? ''),
    'country' => trim($_POST['country'] ?? ''),
    'profile_image' => trim($_POST['profile_image'] ?? ''),
    'linkedin_url' => trim($_POST['linkedin_url'] ?? ''),
    'github_url' => trim($_POST['github_url'] ?? '')
];

if ($data['name'] === '' || $data['title'] === '') {
    admin_flash('Le nom et le titre sont obligatoires.', 'error');
    admin_redirect('/admin/modules/profile/');
}

$stmt = $db->query('SELECT id FROM personal_info ORDER BY id ASC LIMIT 1');
$existingId = $stmt->fetchColumn();

if ($existingId) {
    $sql = "UPDATE personal_info SET name = :name, title = :title, description = :description, email = :email, phone = :phone, whatsapp = :whatsapp, location = :location, country = :country, profile_image = :profile_image, linkedin_url = :linkedin_url, github_url = :github_url WHERE id = :id";
    $data['id'] = $existingId;
} else {
    $sql = "INSERT INTO personal_info (name, title, description, email, phone, whatsapp, location, country, profile_image, linkedin_url, github_url) VALUES (:name, :title, :description, :email, :phone, :whatsapp, :location, :country, :profile_image, :linkedin_url, :github_url)";
}

$stmt = $db->prepare($sql);
$stmt->execute($data);

admin_flash('Profil mis a jour.', 'success');
admin_redirect('/admin/modules/profile/');
