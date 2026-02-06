<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Formations';
$db = admin_db();

$items = $db->query('SELECT * FROM education ORDER BY order_position ASC, start_date DESC')->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Formations</h1>
                    <p class="text-gray-600 mt-1">Gererez votre parcours academique</p>
                </div>
                <a href="/admin/modules/education/create.php" class="btn btn-primary">Nouvelle formation</a>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="card glass-card">
                <div class="card-body overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Diplome</th>
                                <th>Etablissement</th>
                                <th>Periode</th>
                                <th>Actif</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($items)): ?>
                                <tr><td colspan="5" class="text-center text-gray-500">Aucune formation</td></tr>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['degree']) ?></td>
                                        <td><?= htmlspecialchars($item['institution']) ?></td>
                                        <td><?= htmlspecialchars($item['start_date'] ?? '') ?> - <?= htmlspecialchars($item['end_date'] ?? '') ?></td>
                                        <td><?= $item['is_active'] ? 'Oui' : 'Non' ?></td>
                                        <td class="table-actions">
                                            <a href="/admin/modules/education/edit.php?id=<?= (int) $item['id'] ?>" class="btn btn-xs btn-outline">Modifier</a>
                                            <form method="POST" action="/admin/modules/education/delete.php" class="inline">
                                                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
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
