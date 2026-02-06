<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-briefcase mr-3 text-purple-600"></i>
                    <?= $isEdit ? 'Modifier l\'expérience' : 'Nouvelle expérience' ?>
                </h1>
                <p class="text-gray-600 mt-1">
                    <?= $isEdit ? 'Modifiez les informations de l\'expérience' : 'Ajoutez une nouvelle expérience professionnelle' ?>
                </p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <form action="/admin/modules/experience/save.php" method="POST" class="card glass-card">
                <div class="card-body">
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= (int) $experience['id'] ?>">
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Titre du poste *</span>
                            </label>
                            <input type="text" 
                                   name="job_title" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['job_title'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Entreprise *</span>
                            </label>
                            <input type="text" 
                                   name="company" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['company'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">URL de l'entreprise</span>
                            </label>
                            <input type="url" 
                                   name="company_url" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['company_url'] ?? '') ?>"
                                   placeholder="https://example.com">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Localisation</span>
                            </label>
                            <input type="text" 
                                   name="location" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['location'] ?? '') ?>"
                                   placeholder="Ville, Pays">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date de début *</span>
                            </label>
                            <input type="date" 
                                   name="start_date" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['start_date'] ?? '') ?>"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date de fin</span>
                            </label>
                            <input type="date" 
                                   name="end_date" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($experience['end_date'] ?? '') ?>"
                                   id="end_date">
                            <label class="label cursor-pointer justify-start gap-2 mt-2">
                                <input type="checkbox" 
                                       name="is_current" 
                                       value="1" 
                                       class="checkbox checkbox-primary checkbox-sm"
                                       id="is_current"
                                       <?= !empty($experience['is_current']) ? 'checked' : '' ?>>
                                <span class="label-text">Poste actuel</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea name="description" 
                                  class="textarea textarea-bordered h-32" 
                                  placeholder="Décrivez vos responsabilités et réalisations..."><?= htmlspecialchars($experience['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">Technologies utilisées</span>
                        </label>
                        <input type="text" 
                               name="technologies" 
                               class="input input-bordered" 
                               value="<?= htmlspecialchars($experience['technologies'] ?? '') ?>"
                               placeholder="PHP, JavaScript, MySQL (séparées par des virgules)">
                        <label class="label">
                            <span class="label-text-alt text-gray-500">Séparez les technologies par des virgules</span>
                        </label>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Actif</span>
                            </label>
                            <select name="is_active" class="select select-bordered">
                                <option value="1" <?= (int) ($experience['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                <option value="0" <?= (int) ($experience['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Ordre d'affichage</span>
                            </label>
                            <input type="number" 
                                   name="order_position" 
                                   class="input input-bordered" 
                                   value="<?= (int) ($experience['order_position'] ?? 0) ?>"
                                   min="0">
                        </div>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="flex justify-end gap-3">
                        <a href="/admin/modules/experience/" class="btn btn-ghost">
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

<script>
document.getElementById('is_current').addEventListener('change', function() {
    const endDateInput = document.getElementById('end_date');
    if (this.checked) {
        endDateInput.value = '';
        endDateInput.disabled = true;
    } else {
        endDateInput.disabled = false;
    }
});

// Au chargement
if (document.getElementById('is_current').checked) {
    document.getElementById('end_date').disabled = true;
}
</script>
