<?php
require_once '../vendor/autoload.php';
use App\Auth;

// Rediriger si déjà connecté
if (Auth::check()) {
    header('Location: /admin/');
    exit;
}

$error = '';

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (Auth::login($username, $password)) {
        header('Location: /admin/');
        exit;
    } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Portfolio Luc Nguemoue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
    <script defer src="/admin/assets/js/admin.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#12d640',
                        secondary: '#1a1a2e',
                        accent: '#16213e'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-900 via-purple-900 to-purple-700 min-h-screen flex items-center justify-center" data-page="login">
    <div class="card w-96 bg-base-100 shadow-2xl admin-login-card">
        <div class="card-body">
            <h2 class="card-title justify-center text-2xl mb-6">
                <span class="text-primary">🔐</span> Administration
            </h2>
            <p class="text-center text-gray-600 mb-6">Portfolio Management System</p>

            <?php if ($error): ?>
                <div class="alert alert-error mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nom d'utilisateur</span>
                    </label>
                    <input
                        type="text"
                        name="username"
                        placeholder="admin"
                        class="input input-bordered w-full focus:input-primary"
                        required
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    />
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Mot de passe</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        class="input input-bordered w-full focus:input-primary"
                        required
                    />
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Se connecter
                    </button>
                </div>
            </form>

            <div class="divider"></div>

            <div class="text-center text-sm text-gray-500">
                <p>📊 Portfolio Administration Panel v1.0</p>
                <p class="mt-1">Powered by PHP 8.3 • TailwindCSS • DaisyUI</p>
            </div>
        </div>
    </div>
</body>
</html>
