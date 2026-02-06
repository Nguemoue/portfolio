<?php
require_once __DIR__ . '/../_init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/modules/cvs/');
    exit;
}

$db = admin_db();
$id = (int) ($_POST['id'] ?? 0);

$data = [
    'title' => trim($_POST['title'] ?? ''),
    'description' => trim($_POST['description'] ?? ''),
    'language' => $_POST['language'] ?? 'fr',
    'is_primary' => isset($_POST['is_primary']) ? 1 : 0,
    'is_active' => (int) ($_POST['is_active'] ?? 1)
];

// Gestion de l'upload de fichier
$filePath = $_POST['existing_file'] ?? '';
$fileSize = 0;

if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['cv_file'];
    
    // Vérifier que c'est un PDF
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if ($mimeType !== 'application/pdf') {
        header('Location: /admin/modules/cvs/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=invalid_type');
        exit;
    }
    
    // Vérifier la taille (max 10MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        header('Location: /admin/modules/cvs/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=file_too_large');
        exit;
    }
    
    // Créer le dossier d'upload si nécessaire
    $uploadDir = __DIR__ . '/../../../uploads/cvs/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Générer un nom de fichier unique
    $extension = 'pdf';
    $fileName = 'cv_' . uniqid() . '_' . time() . '.' . $extension;
    $destination = $uploadDir . $fileName;
    
    // Déplacer le fichier
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        // Supprimer l'ancien fichier si modification
        if ($id && $filePath && file_exists($filePath)) {
            unlink($filePath);
        }
        
        $filePath = '/uploads/cvs/' . $fileName;
        $fileSize = $file['size'];
    } else {
        header('Location: /admin/modules/cvs/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=upload_failed');
        exit;
    }
}

// Si modification et pas de nouveau fichier, garder l'existant
if ($id && !$fileSize) {
    $existing = $db->query('SELECT file_size FROM cvs WHERE id = ?', [$id])->fetch(PDO::FETCH_ASSOC);
    $fileSize = $existing['file_size'] ?? 0;
}

try {
    // Si is_primary est coché, désactiver les autres
    if ($data['is_primary']) {
        $db->query("UPDATE cvs SET is_primary = 0 WHERE language = ?", [$data['language']]);
    }
    
    if ($id) {
        // UPDATE
        $stmt = $db->prepare("
            UPDATE cvs 
            SET title = ?, description = ?, language = ?, is_primary = ?, is_active = ?
            " . ($filePath && $fileSize ? ", file_path = ?, file_size = ?" : "") . "
            WHERE id = ?
        ");
        
        $params = [$data['title'], $data['description'], $data['language'], $data['is_primary'], $data['is_active']];
        if ($filePath && $fileSize) {
            $params[] = $filePath;
            $params[] = $fileSize;
        }
        $params[] = $id;
        
        $stmt->execute($params);
        App\Auth::logActivity('update', 'cvs', $id);
    } else {
        // INSERT
        if (!$filePath) {
            header('Location: /admin/modules/cvs/create.php?error=no_file');
            exit;
        }
        
        $stmt = $db->prepare("
            INSERT INTO cvs (title, description, file_path, file_size, language, is_primary, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['title'], $data['description'], $filePath, $fileSize,
            $data['language'], $data['is_primary'], $data['is_active']
        ]);
        
        $id = (int) $db->lastInsertId();
        App\Auth::logActivity('create', 'cvs', $id);
    }

    header('Location: /admin/modules/cvs/?success=1');
} catch (Exception $e) {
    error_log('Error saving CV: ' . $e->getMessage());
    header('Location: /admin/modules/cvs/' . ($id ? "edit.php?id=$id" : 'create.php') . '&error=1');
}
exit;
