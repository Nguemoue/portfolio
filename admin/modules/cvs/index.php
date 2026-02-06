<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'CVs';
$db = admin_db();

$cvs = $db->query('SELECT * FROM cvs ORDER BY is_primary DESC, created_at DESC')->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-pdf mr-3 text-pink-600"></i>
                        CVs
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez vos CVs téléchargeables</p>
                </div>
                <a href="/admin/modules/cvs/create.php" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Ajouter un CV
                </a>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="card glass-card">
                <div class="card-body overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Langue</th>
                                <th>Taille</th>
                                <th>Téléchargements</th>
                                <th>Principal</th>
                                <th>Statut</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cvs)): ?>
                                <tr><td colspan="7" class="text-center text-gray-500 py-8">
                                    <i class="fas fa-file-pdf text-4xl mb-3 opacity-50"></i>
                                    <p>Aucun CV</p>
                                </td></tr>
                            <?php else: ?>
                                <?php foreach ($cvs as $cv): ?>
                                    <tr>
                                        <td class="font-medium">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-file-pdf text-red-500"></i>
                                                <?= htmlspecialchars($cv['title']) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-outline">
                                                <?= strtoupper($cv['language']) ?>
                                            </span>
                                        </td>
                                        <td><?= number_format($cv['file_size'] / 1024, 0) ?> KB</td>
                                        <td>
                                            <span class="badge badge-info">
                                                <?= (int) $cv['download_count'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($cv['is_primary']): ?>
                                                <span class="badge badge-success">
                                                    <i class="fas fa-star mr-1"></i>Principal
                                                </span>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($cv['is_active']): ?>
                                                <span class="badge badge-success">Actif</span>
                                            <?php else: ?>
                                                <span class="badge badge-ghost">Inactif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="table-actions">
                                            <div class="flex gap-2">
                                                <a href="<?= htmlspecialchars($cv['file_path']) ?>" 
                                                   target="_blank"
                                                   class="btn btn-xs btn-outline btn-success"
                                                   title="Télécharger">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <a href="/admin/modules/cvs/edit.php?id=<?= (int) $cv['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/admin/modules/cvs/delete.php?id=<?= (int) $cv['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-error"
                                                   onclick="return confirm('Supprimer ce CV ?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include __DIR__ . '/../../components/footer.php'; ?>
