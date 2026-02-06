<?php
require_once __DIR__ . '/../_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/modules/skills/');
    exit;
}

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'name' => trim($_POST['name'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'proficiency' => trim($_POST['proficiency'] ?? 'intermédiaire'),
    'icon' => trim($_POST['icon'] ?? ''),
    'is_active' => (int) ($_POST['is_active'] ?? 1),
    'order_position' => (int) ($_POST['order_position'] ?? 0)
];

try {
    if ($id) {
        // UPDATE
        $stmt = $db->prepare("
            UPDATE skills 
            SET name = ?, category = ?, proficiency = ?, icon = ?, is_active = ?, order_position = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data['name'], $data['category'], $data['proficiency'], $data['icon'],
            $data['is_active'], $data['order_position'], $id
        ]);
        
        App\Auth::logActivity('update', 'skills', $id);
    } else {
        // INSERT
        $stmt = $db->prepare("
            INSERT INTO skills (name, category, proficiency, icon, is_active, order_position)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['name'], $data['category'], $data['proficiency'], $data['icon'],
            $data['is_active'], $data['order_position']
        ]);
        
        $id = (int) $db->lastInsertId();
        App\Auth::logActivity('create', 'skills', $id);
    }

    header('Location: /admin/modules/skills/?success=1');
} catch (Exception $e) {
    error_log('Error saving skill: ' . $e->getMessage());
    header('Location: /admin/modules/skills/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=1');
}
exit;
