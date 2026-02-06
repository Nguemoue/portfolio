<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Auth;
use App\Database\Database;

Auth::requireAuth();

$pageTitle = 'Dashboard';
$stats = [
    'projects' => 0,
    'education' => 0,
    'experiences' => 0,
    'skills' => 0,
    'certifications' => 0
];
$recentActivities = [];

try {
    $db = Database::getInstance();
    $stats['projects'] = (int) ($db->query("SELECT COUNT(*) FROM projects WHERE is_active = 1")->fetchColumn() ?? 0);
    $stats['education'] = (int) ($db->query("SELECT COUNT(*) FROM education WHERE is_active = 1")->fetchColumn() ?? 0);
    $stats['experiences'] = (int) ($db->query("SELECT COUNT(*) FROM experiences WHERE is_active = 1")->fetchColumn() ?? 0);
    $stats['skills'] = (int) ($db->query("SELECT COUNT(*) FROM skills WHERE is_active = 1")->fetchColumn() ?? 0);
    $stats['certifications'] = (int) ($db->query("SELECT COUNT(*) FROM certifications WHERE is_active = 1")->fetchColumn() ?? 0);
    $recentActivities = Auth::getActivityLogs(10);
} catch (Throwable $e) {
    error_log('Admin dashboard error: ' . $e->getMessage());
}

include __DIR__ . '/components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                            <span class="mr-3">📊</span>
                            Dashboard
                        </h1>
                        <p class="text-gray-600 mt-1">Vue d'ensemble de votre portfolio</p>
                    </div>
                    <div class="badge badge-primary badge-lg">
                        <?= htmlspecialchars(Auth::user()['username'] ?? 'Admin') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-6 flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-primary"></i>
                    Statistiques
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white stats-card">
                        <div class="card-body p-6">
                            <p class="text-blue-100 text-sm font-medium">Projets</p>
                            <p class="text-3xl font-bold mt-2"><?= $stats['projects'] ?></p>
                            <a href="/admin/modules/projects/" class="btn btn-sm bg-white bg-opacity-20 border-none text-white hover:bg-opacity-30 mt-4">
                                Voir tout
                            </a>
                        </div>
                    </div>
                    <div class="card bg-gradient-to-r from-green-500 to-green-600 text-white stats-card">
                        <div class="card-body p-6">
                            <p class="text-green-100 text-sm font-medium">Formations</p>
                            <p class="text-3xl font-bold mt-2"><?= $stats['education'] ?></p>
                            <a href="/admin/modules/education/" class="btn btn-sm bg-white bg-opacity-20 border-none text-white hover:bg-opacity-30 mt-4">
                                Voir tout
                            </a>
                        </div>
                    </div>
                    <div class="card bg-gradient-to-r from-purple-500 to-purple-600 text-white stats-card">
                        <div class="card-body p-6">
                            <p class="text-purple-100 text-sm font-medium">Expériences</p>
                            <p class="text-3xl font-bold mt-2"><?= $stats['experiences'] ?></p>
                            <a href="/admin/modules/experience/" class="btn btn-sm bg-white bg-opacity-20 border-none text-white hover:bg-opacity-30 mt-4">
                                Voir tout
                            </a>
                        </div>
                    </div>
                    <div class="card bg-gradient-to-r from-yellow-500 to-orange-500 text-white stats-card">
                        <div class="card-body p-6">
                            <p class="text-yellow-100 text-sm font-medium">Compétences</p>
                            <p class="text-3xl font-bold mt-2"><?= $stats['skills'] ?></p>
                            <a href="/admin/modules/skills/" class="btn btn-sm bg-white bg-opacity-20 border-none text-white hover:bg-opacity-30 mt-4">
                                Voir tout
                            </a>
                        </div>
                    </div>
                    <div class="card bg-gradient-to-r from-red-500 to-pink-500 text-white stats-card">
                        <div class="card-body p-6">
                            <p class="text-red-100 text-sm font-medium">Certifications</p>
                            <p class="text-3xl font-bold mt-2"><?= $stats['certifications'] ?></p>
                            <a href="/admin/modules/certifications/" class="btn btn-sm bg-white bg-opacity-20 border-none text-white hover:bg-opacity-30 mt-4">
                                Voir tout
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="card glass-card">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-history mr-2 text-primary"></i>
                                Activités récentes
                            </h3>
                            <a href="/admin/modules/logs/" class="btn btn-sm btn-outline btn-primary">Voir tout</a>
                        </div>
                        <?php if (empty($recentActivities)): ?>
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-clock text-4xl mb-3 opacity-50"></i>
                                <p>Aucune activité récente</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($recentActivities as $activity): ?>
                                    <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                        <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm">
                                            <?= substr(strtoupper($activity['username'] ?? 'S'), 0, 1) ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($activity['username'] ?? 'Système') ?>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <?= ucfirst(htmlspecialchars($activity['action'])) ?>
                                                dans <?= htmlspecialchars($activity['table_name']) ?>
                                            </p>
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            <?= date('d/m H:i', strtotime($activity['created_at'])) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card glass-card">
                    <div class="card-body">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-primary"></i>
                            Informations système
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Version PHP</span>
                                <span class="text-sm text-gray-900 bg-green-100 px-2 py-1 rounded">
                                    <?= PHP_VERSION ?>
                                </span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Base de données</span>
                                <span class="text-sm text-gray-900 bg-blue-100 px-2 py-1 rounded">MySQL</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Framework CSS</span>
                                <span class="text-sm text-gray-900 bg-purple-100 px-2 py-1 rounded">TailwindCSS + DaisyUI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include __DIR__ . '/components/footer.php'; ?>
