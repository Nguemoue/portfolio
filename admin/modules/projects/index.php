<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Projets';
$db = admin_db();

$projects = $db->query('SELECT * FROM projects ORDER BY order_position ASC, created_at DESC')->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Projets</h1>
                    <p class="text-gray-600 mt-1">Gererez vos projets</p>
                </div>
                <a href="/admin/modules/projects/create.php" class="btn btn-primary">Nouveau projet</a>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="card glass-card">
                <div class="card-body overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Type</th>
                                <th>Ordre</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($projects)): ?>
                                <tr><td colspan="5" class="text-center text-gray-500">Aucun projet</td></tr>
                            <?php else: ?>
                                <?php foreach ($projects as $project): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($project['title']) ?></td>
                                        <td><?= $project['is_active'] ? 'Actif' : 'Inactif' ?></td>
                                        <td><?= htmlspecialchars($project['category']) ?></td>
                                        <td><?= (int) $project['order_position'] ?></td>
                                        <td class="table-actions">
                                            <a href="/admin/modules/projects/edit.php?id=<?= (int) $project['id'] ?>" class="btn btn-xs btn-outline">Modifier</a>
                                            <form method="POST" action="/admin/modules/projects/delete.php" class="inline">
                                                <input type="hidden" name="id" value="<?= (int) $project['id'] ?>">
                                                <button type="submit" class="btn btn-xs btn-outline btn-error">Supprimer</button>
                                            </form>
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
