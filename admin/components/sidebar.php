<div class="sidebar bg-white w-64 min-h-screen shadow-lg sidebar-transition glass-card" id="sidebar">
    <!-- Header de la sidebar -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-primary to-accent rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">🚀</span>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-800">Admin Panel</h2>
                <p class="text-xs text-gray-600">Portfolio Management</p>
            </div>
        </div>
    </div>

    <!-- Profil utilisateur -->
    <div class="p-4 bg-gradient-to-r from-primary/10 to-accent/10 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="avatar placeholder">
                <div class="bg-primary text-white rounded-full w-10">
                    <span class="text-sm font-bold"><?= substr(strtoupper(App\Auth::user()['username'] ?? 'A'), 0, 2) ?></span>
                </div>
            </div>
            <div class="flex-1">
                <p class="font-semibold text-gray-800"><?= htmlspecialchars(App\Auth::user()['username'] ?? 'Admin') ?></p>
                <p class="text-xs text-gray-600"><?= htmlspecialchars(App\Auth::user()['role'] ?? 'admin') ?></p>
            </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle btn-xs">
                    <i class="fas fa-ellipsis-v"></i>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-36">
                    <li><a href="#" data-action="change-password"><i class="fas fa-key mr-2"></i>Mot de passe</a></li>
                    <li><a href="/admin/logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-4 px-2">
        <ul class="space-y-1">
            <li>
                <a href="/admin/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-tachometer-alt mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <li class="pt-4">
                <div class="px-4 pb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Contenu</p>
                </div>
            </li>

            <li>
                <a href="/admin/modules/profile/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-user mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Profil</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/education/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-graduation-cap mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Formations</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/experience/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-briefcase mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Expériences</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/projects/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-project-diagram mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Projets</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/skills/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-cogs mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Compétences</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/certifications/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-certificate mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Certifications</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/cvs/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-file-pdf mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">CVs</span>
                </a>
            </li>

            <li class="pt-4">
                <div class="px-4 pb-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Système</p>
                </div>
            </li>

            <li>
                <a href="/admin/modules/settings/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-cog mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Paramètres</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/logs/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-history mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Logs d'activité</span>
                </a>
            </li>

            <li>
                <a href="/admin/modules/"
                   class="sidebar-link flex items-center px-4 py-3 text-gray-700 hover:bg-primary hover:text-white transition-colors duration-200 rounded-lg mx-2 group">
                    <i class="fas fa-layer-group mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Modules</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Actions rapides -->
    <div class="mt-8 px-4">
        <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-lg p-4">
            <p class="text-sm font-semibold text-gray-700 mb-3">Actions rapides</p>
            <div class="space-y-2">
                <button onclick="location.href='/admin/modules/projects/create.php'" class="btn btn-sm btn-outline btn-primary w-full btn-action">
                    <i class="fas fa-plus mr-2"></i>Nouveau projet
                </button>
                <button type="button" data-action="backup-data" class="btn btn-sm btn-outline btn-info w-full btn-action">
                    <i class="fas fa-download mr-2"></i>Sauvegarde
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 p-4 border-t border-gray-200">
        <div class="text-center">
            <p class="text-xs text-gray-500">Portfolio Admin v1.0</p>
            <p class="text-xs text-gray-400">PHP 8.3 • TailwindCSS</p>
        </div>
    </div>
</div>

<!-- Bouton mobile pour afficher/cacher la sidebar -->
<button class="fixed top-4 left-4 z-50 md:hidden btn btn-primary btn-sm shadow-lg" data-action="toggle-sidebar">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay pour fermer la sidebar sur mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden" data-action="toggle-sidebar"></div>
