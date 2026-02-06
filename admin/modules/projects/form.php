<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
</div>
    </main>
        </div>
            </div>
                </div>
                    </form>
                        </div>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <a href="/admin/modules/projects/" class="btn btn-ghost">Annuler</a>
                        <div class="flex justify-end">
                        </div>
                            </div>
                                <input type="number" name="order_position" class="input input-bordered" value="<?= (int) ($project['order_position'] ?? 0) ?>">
                                <label class="label"><span class="label-text">Ordre</span></label>
                            <div class="form-control">
                            </div>
                                </select>
                                    <option value="0" <?= (int) ($project['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                                    <option value="1" <?= (int) ($project['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                <select name="is_active" class="select select-bordered">
                                <label class="label"><span class="label-text">Actif</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        </div>
                            </div>
                                </select>
                                    <option value="entreprise" <?= ($project['category'] ?? '') === 'entreprise' ? 'selected' : '' ?>>Entreprise</option>
                                    <option value="personnel" <?= ($project['category'] ?? '') === 'personnel' ? 'selected' : '' ?>>Personnel</option>
                                <select name="category" class="select select-bordered">
                                <label class="label"><span class="label-text">Categorie</span></label>
                            <div class="form-control">
                            </div>
                                <input type="text" name="image" class="input input-bordered" value="<?= htmlspecialchars($project['image'] ?? '') ?>">
                                <label class="label"><span class="label-text">Image (URL)</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        </div>
                            </div>
                                <input type="url" name="github_url" class="input input-bordered" value="<?= htmlspecialchars($project['github_url'] ?? '') ?>">
                                <label class="label"><span class="label-text">GitHub</span></label>
                            <div class="form-control">
                            </div>
                                <input type="url" name="project_url" class="input input-bordered" value="<?= htmlspecialchars($project['project_url'] ?? '') ?>">
                                <label class="label"><span class="label-text">URL Projet</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        </div>
                            <textarea name="description" class="textarea textarea-bordered" rows="4"><?= htmlspecialchars($project['description'] ?? '') ?></textarea>
                            <label class="label"><span class="label-text">Description</span></label>
                        <div class="form-control">
                        </div>
                            <input type="text" name="title" class="input input-bordered" required value="<?= htmlspecialchars($project['title'] ?? '') ?>">
                            <label class="label"><span class="label-text">Titre</span></label>
                        <div class="form-control">
                        <input type="hidden" name="id" value="<?= (int) ($project['id'] ?? 0) ?>">
                    <form method="POST" action="/admin/modules/projects/save.php" class="space-y-4" data-confirm-leave>
                <div class="card-body">
            <div class="card glass-card">
        <div class="container mx-auto px-6 py-8">

        </div>
            </div>
                <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($pageTitle ?? 'Projet') ?></h1>
            <div class="container mx-auto px-6 py-4">
        <div class="bg-white shadow-sm border-b border-gray-200">
    <main class="flex-1 overflow-x-hidden overflow-y-auto">

    <?php include __DIR__ . '/../../components/sidebar.php'; ?>
