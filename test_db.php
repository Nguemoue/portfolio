<?php
// Test de connexion à la base de données et vérification du système
require_once 'vendor/autoload.php';

use App\Database\Database;
use App\Auth;

echo "<h1>🧪 Test du système d'administration Portfolio</h1>";
echo "<style>body{font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5;} .success{color: #10B981; background: #ECFDF5; padding: 10px; border-radius: 5px; margin: 10px 0;} .error{color: #EF4444; background: #FEF2F2; padding: 10px; border-radius: 5px; margin: 10px 0;} .info{color: #3B82F6; background: #EFF6FF; padding: 10px; border-radius: 5px; margin: 10px 0;} .test{background: white; padding: 15px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);}</style>";

// Test 1: Vérification des variables d'environnement
echo "<div class='test'>";
echo "<h3>📋 Test 1: Variables d'environnement</h3>";
try {
    $dbHost = env('DB_HOST');
    $dbName = env('DB_DATABASE');
    $dbUser = env('DB_USER');
    $dbPassword = env('DB_PASSWORD');

    echo "<div class='info'>";
    echo "DB_HOST: " . ($dbHost ?? 'NON DÉFINI') . "<br>";
    echo "DB_DATABASE: " . ($dbName ?? 'NON DÉFINI') . "<br>";
    echo "DB_USER: " . ($dbUser ?? 'NON DÉFINI') . "<br>";
    echo "DB_PASSWORD: " . (isset($dbPassword) ? '[DÉFINI]' : 'NON DÉFINI') . "<br>";
    echo "</div>";

    if ($dbHost && $dbName && $dbUser !== null) {
        echo "<div class='success'>✅ Variables d'environnement configurées</div>";
    } else {
        echo "<div class='error'>❌ Variables d'environnement manquantes</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>❌ Erreur lors de la lecture des variables: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 2: Connexion à la base de données
echo "<div class='test'>";
echo "<h3>🗄️ Test 2: Connexion base de données</h3>";
try {
    $db = Database::getInstance();
    echo "<div class='success'>✅ Connexion à la base de données réussie</div>";

    // Vérifier la version de MySQL
    $version = $db->query("SELECT VERSION()")->fetchColumn();
    echo "<div class='info'>Version MySQL: " . $version . "</div>";

} catch (Exception $e) {
    echo "<div class='error'>❌ Erreur de connexion: " . $e->getMessage() . "</div>";
    echo "<div class='info'><strong>Solutions possibles:</strong><br>";
    echo "1. Démarrer Laragon<br>";
    echo "2. Vérifier les paramètres dans le fichier .env<br>";
    echo "3. Créer la base de données 'portfolio' si elle n'existe pas</div>";
}
echo "</div>";

// Test 3: Vérification des tables
echo "<div class='test'>";
echo "<h3>📊 Test 3: Vérification des tables</h3>";
try {
    $db = Database::getInstance();
    $tables = [
        'users' => 'Table des utilisateurs',
        'personal_info' => 'Informations personnelles',
        'education' => 'Parcours éducatif',
        'experiences' => 'Expériences professionnelles',
        'projects' => 'Projets',
        'skills' => 'Compétences',
        'certifications' => 'Certifications',
        'cvs' => 'CVs',
        'activity_logs' => 'Logs d\'activité'
    ];

    echo "<div class='info'>";
    foreach ($tables as $table => $description) {
        try {
            $result = $db->query("DESCRIBE $table");
            if ($result) {
                echo "✅ $table ($description)<br>";
            }
        } catch (Exception $e) {
            echo "❌ $table ($description) - MANQUANTE<br>";
        }
    }
    echo "</div>";

} catch (Exception $e) {
    echo "<div class='error'>❌ Impossible de vérifier les tables: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 4: Vérification de l'utilisateur admin
echo "<div class='test'>";
echo "<h3>👤 Test 4: Utilisateur administrateur</h3>";
try {
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT username, email, role, is_active FROM users WHERE role = 'super_admin'");
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        echo "<div class='success'>✅ Utilisateur admin trouvé</div>";
        echo "<div class='info'>";
        echo "Username: " . $admin['username'] . "<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "Rôle: " . $admin['role'] . "<br>";
        echo "Actif: " . ($admin['is_active'] ? 'Oui' : 'Non') . "<br>";
        echo "</div>";
    } else {
        echo "<div class='error'>❌ Aucun utilisateur admin trouvé</div>";
        echo "<div class='info'>Exécutez le script SQL admin_schema.sql pour créer l'utilisateur admin</div>";
    }

} catch (Exception $e) {
    echo "<div class='error'>❌ Erreur lors de la vérification de l'admin: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 5: Test de la classe Auth
echo "<div class='test'>";
echo "<h3>🔐 Test 5: Classe Auth</h3>";
try {
    // Vérifier que la classe existe
    if (class_exists('App\Auth')) {
        echo "<div class='success'>✅ Classe Auth chargée correctement</div>";

        // Test des méthodes sans session
        echo "<div class='info'>";
        echo "Auth::check() sans session: " . (Auth::check() ? 'true' : 'false') . "<br>";
        echo "Auth::user() sans session: " . (Auth::user() ? 'user trouvé' : 'null') . "<br>";
        echo "</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>❌ Erreur avec la classe Auth: " . $e->getMessage() . "</div>";
}
echo "</div>";

// Test 6: Structure des fichiers admin
echo "<div class='test'>";
echo "<h3>📁 Test 6: Fichiers d'administration</h3>";
$adminFiles = [
    'admin/login.php' => 'Page de connexion',
    'admin/index.php' => 'Dashboard principal',
    'admin/logout.php' => 'Page de déconnexion',
    'admin/components/header.php' => 'Header',
    'admin/components/sidebar.php' => 'Sidebar',
    'admin/components/footer.php' => 'Footer',
    'database/admin_schema.sql' => 'Script SQL'
];

echo "<div class='info'>";
foreach ($adminFiles as $file => $description) {
    if (file_exists($file)) {
        echo "✅ $file ($description)<br>";
    } else {
        echo "❌ $file ($description) - MANQUANT<br>";
    }
}
echo "</div>";
echo "</div>";

// Instructions finales
echo "<div class='test'>";
echo "<h3>🚀 Instructions de test</h3>";
echo "<div class='info'>";
echo "<strong>Pour tester le système d'administration:</strong><br>";
echo "1. Assurez-vous que Laragon est démarré<br>";
echo "2. Exécutez le script SQL: <code>database/admin_schema.sql</code><br>";
echo "3. Accédez à: <a href='/admin/login.php' target='_blank'>http://localhost/portfolio/admin/login.php</a><br>";
echo "4. Connectez-vous avec: <strong>admin</strong> / <strong>admin123</strong><br><br>";

echo "<strong>Liens de test:</strong><br>";
echo "• <a href='/admin/login.php' target='_blank'>Page de connexion</a><br>";
echo "• <a href='/index.php' target='_blank'>Portfolio public</a><br>";
echo "• <a href='/test_db.php' target='_blank'>Rafraîchir ce test</a><br>";
echo "</div>";
echo "</div>";

echo "<br><small>Test effectué le " . date('d/m/Y à H:i:s') . "</small>";
?>
