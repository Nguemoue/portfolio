<?php
require_once __DIR__ . '/../_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/modules/certifications/');
    exit;
}

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'title' => trim($_POST['title'] ?? ''),
    'issuing_organization' => trim($_POST['issuing_organization'] ?? ''),
    'credential_id' => trim($_POST['credential_id'] ?? ''),
    'credential_url' => trim($_POST['credential_url'] ?? ''),
    'issue_date' => $_POST['issue_date'] ?: null,
    'expiration_date' => $_POST['expiration_date'] ?: null,
    'description' => trim($_POST['description'] ?? ''),
    'image' => trim($_POST['image'] ?? ''),
    'is_active' => (int) ($_POST['is_active'] ?? 1),
    'order_position' => (int) ($_POST['order_position'] ?? 0)
];

try {
    if ($id) {
        // UPDATE
        $stmt = $db->prepare("
            UPDATE certifications 
            SET title = ?, issuing_organization = ?, credential_id = ?, credential_url = ?,
                issue_date = ?, expiration_date = ?, description = ?, image = ?,
                is_active = ?, order_position = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data['title'], $data['issuing_organization'], $data['credential_id'], $data['credential_url'],
            $data['issue_date'], $data['expiration_date'], $data['description'], $data['image'],
            $data['is_active'], $data['order_position'], $id
        ]);
        
        App\Auth::logActivity('update', 'certifications', $id);
    } else {
        // INSERT
        $stmt = $db->prepare("
            INSERT INTO certifications (title, issuing_organization, credential_id, credential_url,
                                       issue_date, expiration_date, description, image, is_active, order_position)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['title'], $data['issuing_organization'], $data['credential_id'], $data['credential_url'],
            $data['issue_date'], $data['expiration_date'], $data['description'], $data['image'],
            $data['is_active'], $data['order_position']
        ]);
        
        $id = (int) $db->lastInsertId();
        App\Auth::logActivity('create', 'certifications', $id);
    }

    header('Location: /admin/modules/certifications/?success=1');
} catch (Exception $e) {
    error_log('Error saving certification: ' . $e->getMessage());
    header('Location: /admin/modules/certifications/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=1');
}
exit;
