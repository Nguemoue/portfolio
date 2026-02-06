<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Logs d\'activité';
$db = admin_db();

// Pagination
$page = (int) ($_GET['page'] ?? 1);
$perPage = 50;
$offset = ($page - 1) * $perPage;

// Filtres
$filters = [];
$where = [];
$params = [];

if (!empty($_GET['user_id'])) {
    $where[] = 'user_id = ?';
    $params[] = (int) $_GET['user_id'];
    $filters['user_id'] = (int) $_GET['user_id'];
}

if (!empty($_GET['action'])) {
    $where[] = 'action = ?';
    $params[] = $_GET['action'];
    $filters['action'] = $_GET['action'];
}

if (!empty($_GET['table_name'])) {
    $where[] = 'table_name = ?';
    $params[] = $_GET['table_name'];
    $filters['table_name'] = $_GET['table_name'];
}

$whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Compter le total
$total = (int) $db->query("SELECT COUNT(*) FROM activity_logs $whereClause", $params)->fetchColumn();
$totalPages = ceil($total / $perPage);

// Récupérer les logs
$sql = "
    SELECT al.*, u.username 
    FROM activity_logs al
    LEFT JOIN users u ON al.user_id = u.id
    $whereClause
    ORDER BY al.created_at DESC
    LIMIT $perPage OFFSET $offset
";
$logs = $db->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les utilisateurs pour le filtre
$users = $db->query('SELECT id, username FROM users ORDER BY username')->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les actions uniques
$actions = $db->query('SELECT DISTINCT action FROM activity_logs ORDER BY action')->fetchAll(PDO::FETCH_COLUMN);

// Récupérer les tables uniques
$tables = $db->query('SELECT DISTINCT table_name FROM activity_logs ORDER BY table_name')->fetchAll(PDO::FETCH_COLUMN);

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-history mr-3 text-blue-600"></i>
                    Logs d'activité
                </h1>
                <p class="text-gray-600 mt-1">Historique des actions effectuées</p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <!-- Filtres -->
            <div class="card glass-card mb-6">
                <div class="card-body">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-filter mr-2"></i>Filtres
                    </h3>
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Utilisateur</span></label>
                            <select name="user_id" class="select select-bordered select-sm">
                                <option value="">Tous</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id'] ?>" <?= ($filters['user_id'] ?? '') == $user['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($user['username']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Action</span></label>
                            <select name="action" class="select select-bordered select-sm">
                                <option value="">Toutes</option>
                                <?php foreach ($actions as $action): ?>
                                    <option value="<?= htmlspecialchars($action) ?>" <?= ($filters['action'] ?? '') === $action ? 'selected' : '' ?>>
                                        <?= ucfirst(htmlspecialchars($action)) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Table</span></label>
                            <select name="table_name" class="select select-bordered select-sm">
                                <option value="">Toutes</option>
                                <?php foreach ($tables as $table): ?>
                                    <option value="<?= htmlspecialchars($table) ?>" <?= ($filters['table_name'] ?? '') === $table ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($table) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">&nbsp;</span></label>
                            <div class="flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm flex-1">
                                    <i class="fas fa-search mr-2"></i>Filtrer
                                </button>
                                <a href="/admin/modules/logs/" class="btn btn-ghost btn-sm">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Logs -->
            <div class="card glass-card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-gray-600">
                            <?= number_format($total) ?> entrée(s) trouvée(s)
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full table-sm">
                            <thead>
                                <tr>
                                    <th>Date/Heure</th>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Table</th>
                                    <th>ID</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($logs)): ?>
                                    <tr><td colspan="6" class="text-center text-gray-500 py-8">
                                        <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                                        <p>Aucun log trouvé</p>
                                    </td></tr>
                                <?php else: ?>
                                    <?php foreach ($logs as $log): ?>
                                        <?php
                                        $actionClass = [
                                            'create' => 'badge-success',
                                            'update' => 'badge-info',
                                            'delete' => 'badge-error',
                                            'login' => 'badge-primary'
                                        ][$log['action']] ?? 'badge-ghost';
                                        
                                        $actionIcon = [
                                            'create' => 'fa-plus',
                                            'update' => 'fa-edit',
                                            'delete' => 'fa-trash',
                                            'login' => 'fa-sign-in-alt'
                                        ][$log['action']] ?? 'fa-circle';
                                        ?>
                                        <tr>
                                            <td class="whitespace-nowrap text-xs">
                                                <?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-outline badge-sm">
                                                    <?= htmlspecialchars($log['username'] ?? 'Système') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge <?= $actionClass ?> badge-sm">
                                                    <i class="fas <?= $actionIcon ?> mr-1"></i>
                                                    <?= ucfirst(htmlspecialchars($log['action'])) ?>
                                                </span>
                                            </td>
                                            <td class="font-mono text-xs"><?= htmlspecialchars($log['table_name']) ?></td>
                                            <td class="text-xs">#<?= (int) $log['record_id'] ?></td>
                                            <td class="text-xs text-gray-500"><?= htmlspecialchars($log['ip_address']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div class="flex justify-center mt-6">
                            <div class="btn-group">
                                <?php if ($page > 1): ?>
                                    <a href="?page=<?= $page - 1 ?><?= http_build_query($filters, '', '&', PHP_QUERY_RFC3986) ? '&' . http_build_query($filters) : '' ?>" 
                                       class="btn btn-sm">«</a>
                                <?php endif; ?>
                                
                                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                                    <a href="?page=<?= $i ?><?= http_build_query($filters) ? '&' . http_build_query($filters) : '' ?>" 
                                       class="btn btn-sm <?= $i === $page ? 'btn-active' : '' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                                
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?= $page + 1 ?><?= http_build_query($filters) ? '&' . http_build_query($filters) : '' ?>" 
                                       class="btn btn-sm">»</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include __DIR__ . '/../../components/footer.php'; ?>
