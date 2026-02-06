<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-pdf mr-3 text-pink-600"></i>
                    <?= $isEdit ? 'Modifier le CV' : 'Ajouter un CV' ?>
                </h1>
                <p class="text-gray-600 mt-1">
                    <?= $isEdit ? 'Modifiez les informations du CV' : 'Ajoutez un nouveau CV téléchargeable' ?>
                </p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <form action="/admin/modules/cvs/save.php" method="POST" enctype="multipart/form-data" class="card glass-card">
                <div class="card-body">
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= (int) $cv['id'] ?>">
                        <input type="hidden" name="existing_file" value="<?= htmlspecialchars($cv['file_path']) ?>">
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Titre *</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($cv['title'] ?? '') ?>"
                                   placeholder="Ex: CV - Développeur Full Stack"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Langue *</span>
                            </label>
                            <select name="language" class="select select-bordered" required>
                                <option value="fr" <?= ($cv['language'] ?? 'fr') === 'fr' ? 'selected' : '' ?>>Français (FR)</option>
                                <option value="en" <?= ($cv['language'] ?? '') === 'en' ? 'selected' : '' ?>>Anglais (EN)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea name="description" 
                                  class="textarea textarea-bordered h-24" 
                                  placeholder="Courte description du CV..."><?= htmlspecialchars($cv['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">
                                Fichier PDF <?= $isEdit ? '(laisser vide pour garder l\'actuel)' : '*' ?>
                            </span>
                        </label>
                        <input type="file" 
                               name="cv_file" 
                               class="file-input file-input-bordered w-full" 
                               accept=".pdf"
                               <?= $isEdit ? '' : 'required' ?>>
                        <label class="label">
                            <span class="label-text-alt text-gray-500">Format: PDF uniquement. Taille max: 10 MB</span>
                        </label>
                        <?php if ($isEdit && $cv['file_path']): ?>
                            <div class="alert alert-info mt-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Fichier actuel: <?= basename($cv['file_path']) ?> (<?= number_format($cv['file_size'] / 1024, 0) ?> KB)</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-3">
                                <input type="checkbox" 
                                       name="is_primary" 
                                       value="1" 
                                       class="checkbox checkbox-primary"
                                       <?= !empty($cv['is_primary']) ? 'checked' : '' ?>>
                                <span class="label-text font-medium">
                                    <i class="fas fa-star text-yellow-500 mr-1"></i>
                                    CV principal (recommandé par défaut)
                                </span>
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Actif</span>
                            </label>
                            <select name="is_active" class="select select-bordered">
                                <option value="1" <?= (int) ($cv['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                <option value="0" <?= (int) ($cv['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                            </select>
                        </div>
                    </div>

                    <?php if ($isEdit): ?>
                        <div class="form-control mt-4">
                            <div class="stats shadow">
                                <div class="stat">
                                    <div class="stat-title">Téléchargements</div>
                                    <div class="stat-value text-primary"><?= (int) $cv['download_count'] ?></div>
                                    <div class="stat-desc">fois téléchargé</div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="divider mt-6"></div>

                    <div class="flex justify-end gap-3">
                        <a href="/admin/modules/cvs/" class="btn btn-ghost">
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
