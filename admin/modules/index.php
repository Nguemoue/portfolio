<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Auth;

Auth::requireAuth();

$pageTitle = 'Modules';
$modules = [
    [
        'name' => 'Profil',
        'path' => '/admin/modules/profile/',
        'icon' => 'fas fa-user',
        'description' => 'Informations personnelles et liens sociaux.'
    ],
    [
        'name' => 'Formations',
        'path' => '/admin/modules/education/',
        'icon' => 'fas fa-graduation-cap',
        'description' => 'Parcours academique et formations.'
    ],
    [
        'name' => 'Experiences',
        'path' => '/admin/modules/experience/',
        'icon' => 'fas fa-briefcase',
        'description' => 'Postes et missions professionnelles.'
    ],
    [
        'name' => 'Projets',
        'path' => '/admin/modules/projects/',
        'icon' => 'fas fa-project-diagram',
        'description' => 'Projets personnels et entreprise.'
    ],
    [
        'name' => 'Competences',
        'path' => '/admin/modules/skills/',
        'icon' => 'fas fa-cogs',
        'description' => 'Technologies et niveaux de maitrise.'
    ],
    [
        'name' => 'Certifications',
        'path' => '/admin/modules/certifications/',
        'icon' => 'fas fa-certificate',
        'description' => 'Certificats, preuves et liens.'
    ],
    [
        'name' => 'CVs',
        'path' => '/admin/modules/cvs/',
        'icon' => 'fas fa-file-pdf',
        'description' => 'CVs PDF disponibles au telechargement.'
    ],
    [
        'name' => 'Parametres',
        'path' => '/admin/modules/settings/',
        'icon' => 'fas fa-cog',
        'description' => 'Configuration globale du site.'
    ],
    [
        'name' => 'Logs',
        'path' => '/admin/modules/logs/',
        'icon' => 'fas fa-history',
        'description' => 'Historique des actions admin.'
    ]
];

include __DIR__ . '/../components/header.php';
?>

<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                            <span class="mr-3">🧩</span>
                            Modules
                        </h1>
                        <p class="text-gray-600 mt-1">Liste complete des modules disponibles</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-6 flex items-center">
                    <i class="fas fa-list mr-2 text-primary"></i>
                    Modules de l'application
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($modules as $module): ?>
                        <a href="<?= $module['path'] ?>" class="card glass-card hover:scale-105 transition-transform">
                            <div class="card-body">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center">
                                        <i class="<?= $module['icon'] ?>"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($module['name']) ?></h3>
                                        <p class="text-sm text-gray-600"><?= htmlspecialchars($module['description']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="card glass-card">
                <div class="card-body">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-tasks mr-2 text-primary"></i>
                        Plan d'avancement
                    </h2>
                    <ol class="list-decimal list-inside text-gray-700 space-y-2">
                        <li>Finaliser la structure de chaque module (pages index/create/edit/delete).</li>
                        <li>Connecter les formulaires aux tables correspondantes.</li>
                        <li>Ajouter l'upload securise des images et fichiers.</li>
                        <li>Mettre en place des validations serveur et logs.</li>
                        <li>Tester chaque module et ajuster l'UX.</li>
                    </ol>
                    <div class="mt-4">
                        <a href="/admin/" class="btn btn-outline btn-primary btn-sm">Retour au dashboard</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
