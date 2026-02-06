<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Administration' ?> - Portfolio Luc Nguemoue</title>

    <!-- TailwindCSS + DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.0/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="/favicon.png"/>

    <!-- Admin styles/scripts -->
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
    <script defer src="/admin/assets/js/admin.js"></script>

    <!-- Meta SEO -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Panel d'administration pour le portfolio de Luc Nguemoue">

    <!-- Configuration Tailwind personnalisée -->
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
<body class="bg-gray-50">
    <!-- Loading overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="loader"></div>
            <span>Chargement...</span>
        </div>
    </div>
