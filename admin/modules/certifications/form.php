<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>

    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-certificate mr-3 text-red-600"></i>
                    <?= $isEdit ? 'Modifier la certification' : 'Nouvelle certification' ?>
                </h1>
                <p class="text-gray-600 mt-1">
                    <?= $isEdit ? 'Modifiez les informations de la certification' : 'Ajoutez une nouvelle certification professionnelle' ?>
                </p>
            </div>
        </div>

        <div class="container mx-auto px-6 py-8">
            <form action="/admin/modules/certifications/save.php" method="POST" class="card glass-card">
                <div class="card-body">
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= (int) $certification['id'] ?>">
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">Titre de la certification *</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['title'] ?? '') ?>"
                                   placeholder="Ex: AWS Certified Developer"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Organisme émetteur *</span>
                            </label>
                            <input type="text" 
                                   name="issuing_organization" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['issuing_organization'] ?? '') ?>"
                                   placeholder="Ex: Amazon Web Services"
                                   required>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">ID de certification</span>
                            </label>
                            <input type="text" 
                                   name="credential_id" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['credential_id'] ?? '') ?>"
                                   placeholder="Ex: ABC123XYZ">
                        </div>

                        <div class="form-control md:col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">URL de vérification</span>
                            </label>
                            <input type="url" 
                                   name="credential_url" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['credential_url'] ?? '') ?>"
                                   placeholder="https://exemple.com/verify">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date d'émission</span>
                            </label>
                            <input type="date" 
                                   name="issue_date" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['issue_date'] ?? '') ?>">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Date d'expiration</span>
                            </label>
                            <input type="date" 
                                   name="expiration_date" 
                                   class="input input-bordered" 
                                   value="<?= htmlspecialchars($certification['expiration_date'] ?? '') ?>">
                            <label class="label">
                                <span class="label-text-alt text-gray-500">Laissez vide si la certification est permanente</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">Description</span>
                        </label>
                        <textarea name="description" 
                                  class="textarea textarea-bordered h-24" 
                                  placeholder="Description de la certification..."><?= htmlspecialchars($certification['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text font-medium">Image / Badge (URL)</span>
                        </label>
                        <input type="text" 
                               name="image" 
                               class="input input-bordered" 
                               value="<?= htmlspecialchars($certification['image'] ?? '') ?>"
                               placeholder="https://exemple.com/badge.png">
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Actif</span>
                            </label>
                            <select name="is_active" class="select select-bordered">
                                <option value="1" <?= (int) ($certification['is_active'] ?? 1) === 1 ? 'selected' : '' ?>>Oui</option>
                                <option value="0" <?= (int) ($certification['is_active'] ?? 1) === 0 ? 'selected' : '' ?>>Non</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Ordre d'affichage</span>
                            </label>
                            <input type="number" 
                                   name="order_position" 
                                   class="input input-bordered" 
                                   value="<?= (int) ($certification['order_position'] ?? 0) ?>"
                                   min="0">
                        </div>
                    </div>

                    <div class="divider mt-6"></div>

                    <div class="flex justify-end gap-3">
                        <a href="/admin/modules/certifications/" class="btn btn-ghost">
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
