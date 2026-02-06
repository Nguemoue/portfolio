<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Compétences';
$db = admin_db();

// Récupérer toutes les compétences groupées par catégorie
$skills = $db->query('SELECT * FROM skills ORDER BY category ASC, order_position ASC')->fetchAll(PDO::FETCH_ASSOC);

// Grouper par catégorie
$skillsByCategory = [];
foreach ($skills as $skill) {
    $category = $skill['category'] ?: 'Non catégorisé';
    $skillsByCategory[$category][] = $skill;
}

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-cogs mr-3 text-yellow-600"></i>
                        Compétences
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez vos compétences techniques</p>
                </div>
                <a href="/admin/modules/skills/create.php" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Nouvelle compétence
                </a>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <?php if (empty($skills)): ?>
                <div class="card glass-card">
                    <div class="card-body text-center py-12">
                        <i class="fas fa-cogs text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Aucune compétence</p>
                        <a href="/admin/modules/skills/create.php" class="btn btn-primary mt-4">
                            Ajouter une compétence
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($skillsByCategory as $category => $categorySkills): ?>
                    <div class="card glass-card mb-6">
                        <div class="card-body">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-folder mr-2 text-primary"></i>
                                <?= htmlspecialchars($category) ?>
                                <span class="badge badge-primary ml-2"><?= count($categorySkills) ?></span>
                            </h2>
                            <div class="overflow-x-auto">
                                <table class="table table-zebra w-full">
                                    <thead>
                                        <tr>
                                            <th>Compétence</th>
                                            <th>Niveau</th>
                                            <th>Icône</th>
                                            <th>Statut</th>
                                            <th>Ordre</th>
                                            <th class="table-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categorySkills as $skill): ?>
                                            <tr>
                                                <td class="font-medium"><?= htmlspecialchars($skill['name']) ?></td>
                                                <td>
                                                    <?php
                                                    $badgeClass = [
                                                        'débutant' => 'badge-info',
                                                        'intermédiaire' => 'badge-warning',
                                                        'avancé' => 'badge-success',
                                                        'expert' => 'badge-error'
                                                    ][$skill['proficiency']] ?? 'badge-ghost';
                                                    ?>
                                                    <span class="badge <?= $badgeClass ?>">
                                                        <?= htmlspecialchars($skill['proficiency']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($skill['icon']): ?>
                                                        <i class="<?= htmlspecialchars($skill['icon']) ?> text-xl"></i>
                                                    <?php else: ?>
                                                        <span class="text-gray-400">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($skill['is_active']): ?>
                                                        <span class="badge badge-success">Actif</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-ghost">Inactif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= (int) $skill['order_position'] ?></td>
                                                <td class="table-actions">
                                                    <div class="flex gap-2">
                                                        <a href="/admin/modules/skills/edit.php?id=<?= (int) $skill['id'] ?>" 
                                                           class="btn btn-xs btn-outline btn-info">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="/admin/modules/skills/delete.php?id=<?= (int) $skill['id'] ?>" 
                                                           class="btn btn-xs btn-outline btn-error"
                                                           onclick="return confirm('Supprimer cette compétence ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php include __DIR__ . '/../../components/footer.php'; ?>
