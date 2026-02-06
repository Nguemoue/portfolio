<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Expériences';
$db = admin_db();

$experiences = $db->query('SELECT * FROM experiences ORDER BY order_position ASC, start_date DESC')->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase mr-3 text-purple-600"></i>
                        Expériences professionnelles
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez vos expériences professionnelles</p>
                </div>
                <a href="/admin/modules/experience/create.php" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Nouvelle expérience
                </a>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="card glass-card">
                <div class="card-body overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Poste</th>
                                <th>Entreprise</th>
                                <th>Période</th>
                                <th>Statut</th>
                                <th>Ordre</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($experiences)): ?>
                                <tr><td colspan="6" class="text-center text-gray-500 py-8">
                                    <i class="fas fa-briefcase text-4xl mb-3 opacity-50"></i>
                                    <p>Aucune expérience</p>
                                </td></tr>
                            <?php else: ?>
                                <?php foreach ($experiences as $exp): ?>
                                    <tr>
                                        <td class="font-medium"><?= htmlspecialchars($exp['job_title']) ?></td>
                                        <td><?= htmlspecialchars($exp['company']) ?></td>
                                        <td>
                                            <?= date('m/Y', strtotime($exp['start_date'])) ?>
                                            - <?= $exp['is_current'] ? '<span class="badge badge-success badge-sm">Actuel</span>' : date('m/Y', strtotime($exp['end_date'])) ?>
                                        </td>
                                        <td>
                                            <?php if ($exp['is_active']): ?>
                                                <span class="badge badge-success">Actif</span>
                                            <?php else: ?>
                                                <span class="badge badge-ghost">Inactif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= (int) $exp['order_position'] ?></td>
                                        <td class="table-actions">
                                            <div class="flex gap-2">
                                                <a href="/admin/modules/experience/edit.php?id=<?= (int) $exp['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/admin/modules/experience/delete.php?id=<?= (int) $exp['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-error"
                                                   onclick="return confirm('Supprimer cette expérience ?')">
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
