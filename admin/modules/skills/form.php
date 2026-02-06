<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-cogs mr-3 text-yellow-600"></i>
                    <?= $isEdit ? 'Modifier la compétence' : 'Nouvelle compétence' ?>
                </h1>
                <p class="text-gray-600 mt-1">
                    <?= $isEdit ? 'Modifiez les informations de la compétence' : 'Ajoutez une nouvelle compétence technique' ?>
                </p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <form action="/admin/modules/skills/save.php" method="POST" class="card glass-card">
                <div class="card-body">
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= (int) $skill['id'] ?>">
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Nom de la compétence *</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($skill['name'] ?? '') ?>"
                                   placeholder="Ex: PHP, JavaScript, React..."
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Catégorie *</span>
                            </label>
                            <select name="category" class="select select-bordered" required>
                                <option value="">-- Sélectionnez --</option>
                                <option value="Backend" <?= ($skill['category'] ?? '') === 'Backend' ? 'selected' : '' ?>>Backend</option>
                                <option value="Frontend" <?= ($skill['category'] ?? '') === 'Frontend' ? 'selected' : '' ?>>Frontend</option>
                                <option value="Base de données" <?= ($skill['category'] ?? '') === 'Base de données' ? 'selected' : '' ?>>Base de données</option>
                                <option value="DevOps" <?= ($skill['category'] ?? '') === 'DevOps' ? 'selected' : '' ?>>DevOps</option>
                                <option value="Mobile" <?= ($skill['category'] ?? '') === 'Mobile' ? 'selected' : '' ?>>Mobile</option>
                                <option value="Outils" <?= ($skill['category'] ?? '') === 'Outils' ? 'selected' : '' ?>>Outils</option>
                                <option value="Frameworks" <?= ($skill['category'] ?? '') === 'Frameworks' ? 'selected' : '' ?>>Frameworks</option>
                                <option value="Langages" <?= ($skill['category'] ?? '') === 'Langages' ? 'selected' : '' ?>>Langages</option>
                                <option value="Autre" <?= ($skill['category'] ?? '') === 'Autre' ? 'selected' : '' ?>>Autre</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Niveau de maîtrise *</span>
                            </label>
                            <select name="proficiency" class="select select-bordered" required>
                                <option value="débutant" <?= ($skill['proficiency'] ?? '') === 'débutant' ? 'selected' : '' ?>>Débutant</option>
                                <option value="intermédiaire" <?= ($skill['proficiency'] ?? 'intermédiaire') === 'intermédiaire' ? 'selected' : '' ?>>Intermédiaire</option>
                                <option value="avancé" <?= ($skill['proficiency'] ?? '') === 'avancé' ? 'selected' : '' ?>>Avancé</option>
                                <option value="expert" <?= ($skill['proficiency'] ?? '') === 'expert' ? 'selected' : '' ?>>Expert</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Icône (Font Awesome)</span>
                            </label>
                            <input type="text" 
                                   name="icon" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($skill['icon'] ?? '') ?>"
                                   placeholder="Ex: fab fa-php, fas fa-code">
                            <label class="label">
                                <span class="label-text-alt text-gray-500">
                                    <a href="https://fontawesome.com/icons" target="_blank" class="link link-primary">
                                        Rechercher une icône
                                    </a>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Actif</span>
                            </label>
                            <select name="is_active" class="select select-bordered">
                                <option value="1" <?= (int) ($skill['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                <option value="0" <?= (int) ($skill['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Ordre d'affichage</span>
                            </label>
                            <input type="number" 
                                   name="order_position" 
                                   class="input input-bordered" 
                                   value="<?= (int) ($skill['order_position'] ?? 0) ?>"
                                   min="0">
                        </div>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="flex justify-end gap-3">
                        <a href="/admin/modules/skills/" class="btn btn-ghost">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Sauvegarder
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
