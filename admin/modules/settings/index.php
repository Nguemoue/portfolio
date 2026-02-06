<?php
require_once __DIR__ . '/../_init.php';

$pageTitle = 'Paramètres';
$db = admin_db();

// Vérifier que l'utilisateur est super_admin
if (!App\Auth::isSuperAdmin()) {
    header('Location: /admin/');
    exit;
}

// Récupérer les infos système
$phpVersion = PHP_VERSION;
$mysqlVersion = $db->query('SELECT VERSION()')->fetchColumn();

// Statistiques DB
$dbStats = [
    'users' => (int) $db->query('SELECT COUNT(*) FROM users')->fetchColumn(),
    'projects' => (int) $db->query('SELECT COUNT(*) FROM projects')->fetchColumn(),
    'education' => (int) $db->query('SELECT COUNT(*) FROM education')->fetchColumn(),
    'experiences' => (int) $db->query('SELECT COUNT(*) FROM experiences')->fetchColumn(),
    'skills' => (int) $db->query('SELECT COUNT(*) FROM skills')->fetchColumn(),
    'certifications' => (int) $db->query('SELECT COUNT(*) FROM certifications')->fetchColumn(),
    'cvs' => (int) $db->query('SELECT COUNT(*) FROM cvs')->fetchColumn(),
    'logs' => (int) $db->query('SELECT COUNT(*) FROM activity_logs')->fetchColumn()
];

include __DIR__ . '/../../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-cog mr-3 text-gray-600"></i>
                    Paramètres système
                </h1>
                <p class="text-gray-600 mt-1">Configuration et maintenance</p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <!-- Informations système -->
            <div class="card glass-card mb-6">
                <div class="card-body">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-server mr-2 text-primary"></i>
                        Informations système
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="stat bg-base-100 rounded-lg shadow">
                            <div class="stat-title">Version PHP</div>
                            <div class="stat-value text-2xl text-primary"><?= $phpVersion ?></div>
                            <div class="stat-desc">Runtime</div>
                        </div>
                        
                        <div class="stat bg-base-100 rounded-lg shadow">
                            <div class="stat-title">MySQL</div>
                            <div class="stat-value text-2xl text-success"><?= explode('-', $mysqlVersion)[0] ?></div>
                            <div class="stat-desc">Base de données</div>
                        </div>
                        
                        <div class="stat bg-base-100 rounded-lg shadow">
                            <div class="stat-title">Serveur</div>
                            <div class="stat-value text-2xl text-info"><?= $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' ?></div>
                            <div class="stat-desc">Web server</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques base de données -->
            <div class="card glass-card mb-6">
                <div class="card-body">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-database mr-2 text-primary"></i>
                        Statistiques de la base de données
                    </h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="stat bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
                            <div class="stat-title text-blue-700">Utilisateurs</div>
                            <div class="stat-value text-blue-600"><?= $dbStats['users'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-green-50 to-green-100 rounded-lg">
                            <div class="stat-title text-green-700">Projets</div>
                            <div class="stat-value text-green-600"><?= $dbStats['projects'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg">
                            <div class="stat-title text-purple-700">Expériences</div>
                            <div class="stat-value text-purple-600"><?= $dbStats['experiences'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg">
                            <div class="stat-title text-yellow-700">Compétences</div>
                            <div class="stat-value text-yellow-600"><?= $dbStats['skills'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-pink-50 to-pink-100 rounded-lg">
                            <div class="stat-title text-pink-700">Formations</div>
                            <div class="stat-value text-pink-600"><?= $dbStats['education'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-red-50 to-red-100 rounded-lg">
                            <div class="stat-title text-red-700">Certifications</div>
                            <div class="stat-value text-red-600"><?= $dbStats['certifications'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg">
                            <div class="stat-title text-indigo-700">CVs</div>
                            <div class="stat-value text-indigo-600"><?= $dbStats['cvs'] ?></div>
                        </div>
                        
                        <div class="stat bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg">
                            <div class="stat-title text-gray-700">Logs</div>
                            <div class="stat-value text-gray-600"><?= number_format($dbStats['logs']) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions système -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Maintenance -->
                <div class="card glass-card">
                    <div class="card-body">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-tools mr-2 text-warning"></i>
                            Maintenance
                        </h2>
                        
                        <div class="space-y-3">
                            <button onclick="cleanOldLogs()" class="btn btn-outline btn-warning w-full justify-start">
                                <i class="fas fa-broom mr-2"></i>
                                Nettoyer les logs anciens (>90 jours)
                            </button>
                            
                            <button onclick="optimizeDatabase()" class="btn btn-outline btn-info w-full justify-start">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Optimiser la base de données
                            </button>
                            
                            <button onclick="clearCache()" class="btn btn-outline btn-secondary w-full justify-start">
                                <i class="fas fa-eraser mr-2"></i>
                                Vider le cache
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sauvegardes -->
                <div class="card glass-card">
                    <div class="card-body">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-download mr-2 text-success"></i>
                            Sauvegardes
                        </h2>
                        
                        <div class="space-y-3">
                            <button onclick="backupDatabase()" class="btn btn-outline btn-success w-full justify-start">
                                <i class="fas fa-database mr-2"></i>
                                Sauvegarder la base de données
                            </button>
                            
                            <button onclick="backupFiles()" class="btn btn-outline btn-primary w-full justify-start">
                                <i class="fas fa-folder mr-2"></i>
                                Sauvegarder les fichiers uploadés
                            </button>
                            
                            <button onclick="fullBackup()" class="btn btn-outline btn-accent w-full justify-start">
                                <i class="fas fa-archive mr-2"></i>
                                Sauvegarde complète
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gestion des utilisateurs -->
            <div class="card glass-card mt-6">
                <div class="card-body">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-users mr-2 text-primary"></i>
                        Utilisateurs administrateurs
                    </h2>
                    
                    <?php $users = $db->query('SELECT * FROM users ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC); ?>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Dernière connexion</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td class="font-medium"><?= htmlspecialchars($user['username']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <span class="badge <?= $user['role'] === 'super_admin' ? 'badge-error' : 'badge-info' ?>">
                                                <?= htmlspecialchars($user['role']) ?>
                                            </span>
                                        </td>
                                        <td class="text-sm">
                                            <?= $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Jamais' ?>
                                        </td>
                                        <td>
                                            <?php if ($user['is_active']): ?>
                                                <span class="badge badge-success">Actif</span>
                                            <?php else: ?>
                                                <span class="badge badge-ghost">Inactif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($user['id'] !== App\Auth::user()['id']): ?>
                                                <button onclick="toggleUserStatus(<?= $user['id'] ?>, <?= $user['is_active'] ?>)" 
                                                        class="btn btn-xs btn-outline">
                                                    <?= $user['is_active'] ? 'Désactiver' : 'Activer' ?>
                                                </button>
                                            <?php else: ?>
                                                <span class="text-gray-400 text-xs">Vous</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function cleanOldLogs() {
    if (confirm('Supprimer tous les logs de plus de 90 jours ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function optimizeDatabase() {
    if (confirm('Optimiser toutes les tables de la base de données ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function clearCache() {
    if (confirm('Vider le cache de l\'application ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function backupDatabase() {
    if (confirm('Créer une sauvegarde de la base de données ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function backupFiles() {
    if (confirm('Créer une sauvegarde des fichiers uploadés ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function fullBackup() {
    if (confirm('Créer une sauvegarde complète (DB + fichiers) ?')) {
        alert('Fonctionnalité à implémenter');
    }
}

function toggleUserStatus(userId, currentStatus) {
    const action = currentStatus ? 'désactiver' : 'activer';
    if (confirm(`Voulez-vous vraiment ${action} cet utilisateur ?`)) {
        alert('Fonctionnalité à implémenter');
    }
}
</script>

<?php include __DIR__ . '/../../components/footer.php'; ?>
