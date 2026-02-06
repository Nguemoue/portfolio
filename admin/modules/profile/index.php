<?php
<?php include __DIR__ . '/../../components/footer.php'; ?>

</div>
    </main>
        </div>
            </div>
                </div>
                    </form>
                        </div>
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        <div class="flex justify-end">

                        </div>
                            </div>
                                <input type="url" name="github_url" class="input input-bordered" value="<?= htmlspecialchars($profile['github_url'] ?? '') ?>">
                                <label class="label"><span class="label-text">GitHub</span></label>
                            <div class="form-control">
                            </div>
                                <input type="url" name="linkedin_url" class="input input-bordered" value="<?= htmlspecialchars($profile['linkedin_url'] ?? '') ?>">
                                <label class="label"><span class="label-text">LinkedIn</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        </div>
                            </div>
                                <input type="text" name="profile_image" class="input input-bordered" value="<?= htmlspecialchars($profile['profile_image'] ?? '') ?>">
                                <label class="label"><span class="label-text">Image (URL)</span></label>
                            <div class="form-control">
                            </div>
                                <input type="text" name="country" class="input input-bordered" value="<?= htmlspecialchars($profile['country'] ?? '') ?>">
                                <label class="label"><span class="label-text">Pays</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        </div>
                            </div>
                                <input type="text" name="location" class="input input-bordered" value="<?= htmlspecialchars($profile['location'] ?? '') ?>">
                                <label class="label"><span class="label-text">Ville</span></label>
                            <div class="form-control">
                            </div>
                                <input type="text" name="whatsapp" class="input input-bordered" value="<?= htmlspecialchars($profile['whatsapp'] ?? '') ?>">
                                <label class="label"><span class="label-text">Whatsapp</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        </div>
                            </div>
                                <input type="text" name="phone" class="input input-bordered" value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
                                <label class="label"><span class="label-text">Telephone</span></label>
                            <div class="form-control">
                            </div>
                                <input type="email" name="email" class="input input-bordered" value="<?= htmlspecialchars($profile['email'] ?? '') ?>">
                                <label class="label"><span class="label-text">Email</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        </div>
                            <textarea name="description" class="textarea textarea-bordered" rows="4"><?= htmlspecialchars($profile['description'] ?? '') ?></textarea>
                            <label class="label"><span class="label-text">Description</span></label>
                        <div class="form-control">

                        </div>
                            </div>
                                <input type="text" name="title" class="input input-bordered" required value="<?= htmlspecialchars($profile['title'] ?? '') ?>">
                                <label class="label"><span class="label-text">Titre</span></label>
                            <div class="form-control">
                            </div>
                                <input type="text" name="name" class="input input-bordered" required value="<?= htmlspecialchars($profile['name'] ?? '') ?>">
                                <label class="label"><span class="label-text">Nom complet</span></label>
                            <div class="form-control">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <form method="POST" action="/admin/modules/profile/update.php" class="space-y-4" data-confirm-leave>
                <div class="card-body">
            <div class="card glass-card">
        <div class="container mx-auto px-6 py-8">

        </div>
            </div>
                <p class="text-gray-600 mt-1">Mettre a jour vos informations personnelles</p>
                <h1 class="text-2xl font-bold text-gray-800">Profil</h1>
            <div class="container mx-auto px-6 py-4">
        <div class="bg-white shadow-sm border-b border-gray-200">
    <main class="flex-1 overflow-x-hidden overflow-y-auto">

    <?php include __DIR__ . '/../../components/sidebar.php'; ?>
<div class="flex h-screen bg-gradient-to-br from-gray-100 to-blue-50">

?>
include __DIR__ . '/../../components/header.php';

$profile = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
$stmt = $db->query('SELECT * FROM personal_info ORDER BY id ASC LIMIT 1');

$db = admin_db();
$pageTitle = 'Profil';

require_once __DIR__ . '/../_init.php';
