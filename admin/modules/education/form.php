<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($pageTitle ?? 'Formation') ?></h1>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <div class="card glass-card">
                <div class="card-body">
                    <form method="POST" action="/admin/modules/education/save.php" class="space-y-4" data-confirm-leave>
                        <input type="hidden" name="id" value="<?= (int) ($item['id'] ?? 0) ?>">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Diplome</span></label>
                            <input type="text" name="degree" class="input input-bordered" required value="<?= htmlspecialchars($item['degree'] ?? '') ?>">
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Etablissement</span></label>
                            <input type="text" name="institution" class="input input-bordered" required value="<?= htmlspecialchars($item['institution'] ?? '') ?>">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Ville</span></label>
                                <input type="text" name="location" class="input input-bordered" value="<?= htmlspecialchars($item['location'] ?? '') ?>">
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Image (URL)</span></label>
                                <input type="text" name="image" class="input input-bordered" value="<?= htmlspecialchars($item['image'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Date debut</span></label>
                                <input type="date" name="start_date" class="input input-bordered" value="<?= htmlspecialchars($item['start_date'] ?? '') ?>">
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Date fin</span></label>
                                <input type="date" name="end_date" class="input input-bordered" value="<?= htmlspecialchars($item['end_date'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Description</span></label>
                            <textarea name="description" class="textarea textarea-bordered" rows="4"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Actif</span></label>
                                <select name="is_active" class="select select-bordered">
                                    <option value="1" <?= (int) ($item['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                    <option value="0" <?= (int) ($item['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Ordre</span></label>
                                <input type="number" name="order_position" class="input input-bordered" value="<?= (int) ($item['order_position'] ?? 0) ?>">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <a href="/admin/modules/education/" class="btn btn-ghost">Annuler</a>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
