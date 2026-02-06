<?php
require_once __DIR__ . '/../_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/modules/experience/');
    exit;
}

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'job_title' => trim($_POST['job_title'] ?? ''),
    'company' => trim($_POST['company'] ?? ''),
    'company_url' => trim($_POST['company_url'] ?? ''),
    'location' => trim($_POST['location'] ?? ''),
    'start_date' => $_POST['start_date'] ?? null,
    'end_date' => $_POST['end_date'] ?? null,
    'is_current' => isset($_POST['is_current']) ? 1 : 0,
    'description' => trim($_POST['description'] ?? ''),
    'technologies' => trim($_POST['technologies'] ?? ''),
    'is_active' => (int) ($_POST['is_active'] ?? 1),
    'order_position' => (int) ($_POST['order_position'] ?? 0)
];

// Si poste actuel, pas de date de fin
if ($data['is_current']) {
    $data['end_date'] = null;
}

// Convertir technologies en JSON array
if (!empty($data['technologies'])) {
    $techs = array_map('trim', explode(',', $data['technologies']));
    $data['technologies'] = json_encode($techs);
} else {
    $data['technologies'] = json_encode([]);
}

try {
    if ($id) {
        // UPDATE
        $stmt = $db->prepare("
            UPDATE experiences 
            SET job_title = ?, company = ?, company_url = ?, location = ?, 
                start_date = ?, end_date = ?, is_current = ?, description = ?, 
                technologies = ?, is_active = ?, order_position = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $data['job_title'], $data['company'], $data['company_url'], $data['location'],
            $data['start_date'], $data['end_date'], $data['is_current'], $data['description'],
            $data['technologies'], $data['is_active'], $data['order_position'], $id
        ]);
        
        App\Auth::logActivity('update', 'experiences', $id);
    } else {
        // INSERT
        $stmt = $db->prepare("
            INSERT INTO experiences (job_title, company, company_url, location, start_date, end_date, 
                                    is_current, description, technologies, is_active, order_position)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['job_title'], $data['company'], $data['company_url'], $data['location'],
            $data['start_date'], $data['end_date'], $data['is_current'], $data['description'],
            $data['technologies'], $data['is_active'], $data['order_position']
        ]);
        
        $id = (int) $db->lastInsertId();
        App\Auth::logActivity('create', 'experiences', $id);
    }

    header('Location: /admin/modules/experience/?success=1');
} catch (Exception $e) {
    error_log('Error saving experience: ' . $e->getMessage());
    header('Location: /admin/modules/experience/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=1');
}
exit;
