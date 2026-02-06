<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Certifications';
$db = admin_db();

$certifications = $db->query('SELECT * FROM certifications ORDER BY order_position ASC, issue_date DESC')->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-certificate mr-3 text-red-600"></i>
                        Certifications
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez vos certifications professionnelles</p>
                </div>
                <a href="/admin/modules/certifications/create.php" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Nouvelle certification
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
                                <th>Organisme</th>
                                <th>Date d'émission</th>
                                <th>Expiration</th>
                                <th>Statut</th>
                                <th>Ordre</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($certifications)): ?>
                                <tr><td colspan="7" class="text-center text-gray-500 py-8">
                                    <i class="fas fa-certificate text-4xl mb-3 opacity-50"></i>
                                    <p>Aucune certification</p>
                                </td></tr>
                            <?php else: ?>
                                <?php foreach ($certifications as $cert): ?>
                                    <?php
                                    $isExpired = false;
                                    if ($cert['expiration_date']) {
                                        $isExpired = strtotime($cert['expiration_date']) < time();
                                    }
                                    ?>
                                    <tr class="<?= $isExpired ? 'opacity-50' : '' ?>">
                                        <td class="font-medium"><?= htmlspecialchars($cert['title']) ?></td>
                                        <td><?= htmlspecialchars($cert['issuing_organization']) ?></td>
                                        <td><?= $cert['issue_date'] ? date('m/Y', strtotime($cert['issue_date'])) : '-' ?></td>
                                        <td>
                                            <?php if ($cert['expiration_date']): ?>
                                                <?= date('m/Y', strtotime($cert['expiration_date'])) ?>
                                                <?php if ($isExpired): ?>
                                                    <span class="badge badge-error badge-sm ml-2">Expirée</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge badge-success badge-sm">Permanente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($cert['is_active']): ?>
                                                <span class="badge badge-success">Actif</span>
                                            <?php else: ?>
                                                <span class="badge badge-ghost">Inactif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= (int) $cert['order_position'] ?></td>
                                        <td class="table-actions">
                                            <div class="flex gap-2">
                                                <?php if ($cert['credential_url']): ?>
                                                    <a href="<?= htmlspecialchars($cert['credential_url']) ?>" 
                                                       target="_blank"
                                                       class="btn btn-xs btn-outline btn-success"
                                                       title="Voir la certification">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="/admin/modules/certifications/edit.php?id=<?= (int) $cert['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/admin/modules/certifications/delete.php?id=<?= (int) $cert['id'] ?>" 
                                                   class="btn btn-xs btn-outline btn-error"
                                                   onclick="return confirm('Supprimer cette certification ?')">
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
