# 📋 INSTRUCTIONS ADMIN - Portfolio Dashboard

## 📊 Vue d'ensemble du projet

Ce système d'administration permet de gérer l'intégralité du portfolio de Luc Nguemoue via une interface web moderne et intuitive.

### 🎯 Objectifs principaux
- Gestion complète du contenu du portfolio (projets, formations, expériences, compétences)
- Interface utilisateur moderne avec TailwindCSS + DaisyUI
- Système d'authentification sécurisé
- Logs d'activité pour traçabilité
- Upload et gestion de fichiers (CVs, images)

## 🏗️ Architecture technique

### Stack technique
- **Backend**: PHP 8.3
- **Base de données**: MySQL 8.0+
- **Frontend**: TailwindCSS 3.x + DaisyUI 4.6
- **Icônes**: Font Awesome 6.4
- **Autoloading**: Composer PSR-4

### Structure des fichiers
```
admin/
├── components/          # Composants réutilisables (header, sidebar, footer)
├── assets/             # CSS et JS personnalisés
├── modules/            # Modules fonctionnels
│   ├── _init.php      # Initialisation commune
│   ├── index.php      # Liste des modules
│   ├── projects/      # Gestion des projets
│   ├── education/     # Gestion des formations
│   ├── profile/       # Gestion du profil
│   ├── experience/    # Gestion des expériences
│   ├── skills/        # Gestion des compétences
│   ├── certifications/ # Gestion des certifications
│   ├── cvs/           # Gestion des CVs
│   ├── settings/      # Paramètres système
│   └── logs/          # Logs d'activité
├── index.php          # Dashboard principal
├── login.php          # Authentification
└── logout.php         # Déconnexion
```

## 📦 Modules du système

### 1. Dashboard (index.php)
- **Fonction**: Page d'accueil avec statistiques et activités récentes
- **Fonctionnalités**:
  - Compteurs pour chaque section (projets, formations, expériences, etc.)
  - Liste des 10 dernières activités
  - Informations système (PHP version, base de données)
  - Liens rapides vers chaque module

### 2. Profile (modules/profile/)
- **Fonction**: Gestion des informations personnelles
- **Fichiers**:
  - `index.php`: Affichage et édition du profil
  - `update.php`: Traitement des modifications
- **Fonctionnalités**:
  - Modification nom, titre, description
  - Coordonnées (email, téléphone, WhatsApp)
  - Localisation (ville, pays)
  - Liens sociaux (LinkedIn, GitHub)
  - Upload photo de profil

### 3. Projects (modules/projects/)
- **Fonction**: Gestion des projets du portfolio
- **Fichiers**:
  - `index.php`: Liste paginée des projets
  - `create.php`: Formulaire de création
  - `edit.php`: Formulaire de modification
  - `form.php`: Formulaire réutilisable
  - `save.php`: Traitement CREATE/UPDATE
  - `delete.php`: Suppression
- **Fonctionnalités**:
  - CRUD complet
  - Upload d'images
  - Technologies (JSON array)
  - Catégories (entreprise/personnel)
  - Projets mis en avant (is_featured)
  - Ordonnancement (order_position)
  - Activation/désactivation

### 4. Education (modules/education/)
- **Fonction**: Gestion du parcours éducatif
- **Structure identique à Projects**
- **Champs spécifiques**:
  - Diplôme (degree)
  - Institution
  - Dates (début/fin)
  - Description
  - Image de l'institution

### 5. Experience (modules/experience/)
- **Fonction**: Gestion des expériences professionnelles
- **Fonctionnalités**:
  - Titre du poste
  - Entreprise + URL
  - Localisation
  - Dates (avec option "poste actuel")
  - Description
  - Technologies utilisées (JSON)
  - Ordonnancement

### 6. Skills (modules/skills/)
- **Fonction**: Gestion des compétences techniques
- **Fonctionnalités**:
  - Nom de la compétence
  - Catégorie (Backend, Frontend, DevOps, etc.)
  - Niveau (débutant, intermédiaire, avancé, expert)
  - Icône
  - Ordonnancement

### 7. Certifications (modules/certifications/)
- **Fonction**: Gestion des certifications et diplômes
- **Fonctionnalités**:
  - Titre de la certification
  - Organisme émetteur
  - ID de certification
  - URL de vérification
  - Dates (émission/expiration)
  - Description
  - Image/badge
  - Ordonnancement

### 8. CVs (modules/cvs/)
- **Fonction**: Gestion des CVs téléchargeables
- **Fonctionnalités**:
  - Upload de fichiers PDF
  - Titre et description
  - Langue (FR/EN)
  - CV principal (is_primary)
  - Compteur de téléchargements
  - Activation/désactivation

### 9. Settings (modules/settings/)
- **Fonction**: Paramètres système
- **Fonctionnalités**:
  - Gestion utilisateurs
  - Configuration email
  - Paramètres SEO
  - Maintenance mode
  - Sauvegardes automatiques

### 10. Logs (modules/logs/)
- **Fonction**: Journal d'activité
- **Fonctionnalités**:
  - Liste paginée des actions
  - Filtres (utilisateur, action, table, date)
  - Détails des modifications (old_values/new_values)
  - Export CSV
  - Nettoyage des logs anciens

## 🔐 Système d'authentification

### Classe Auth (app/Auth.php)
- Gestion des sessions sécurisées
- Vérification des permissions (admin/super_admin)
- Logging des connexions
- Protection CSRF
- Rate limiting

### Fonctions principales
```php
Auth::requireAuth();        // Vérifie l'authentification
Auth::user();              // Retourne l'utilisateur connecté
Auth::hasRole('super_admin'); // Vérifie le rôle
Auth::logActivity();       // Enregistre une activité
Auth::getActivityLogs(10); // Récupère les logs
```

## 💾 Base de données

### Tables principales
1. **users**: Utilisateurs admin
2. **personal_info**: Informations personnelles (1 ligne)
3. **education**: Formations
4. **experiences**: Expériences professionnelles
5. **projects**: Projets
6. **skills**: Compétences
7. **certifications**: Certifications
8. **cvs**: CVs téléchargeables
9. **activity_logs**: Journal d'activité

### Champs communs
- `id`: Clé primaire auto-incrémentée
- `is_active`: Activation/désactivation
- `order_position`: Ordre d'affichage
- `created_at`: Date de création
- `updated_at`: Date de modification

## 🎨 Design System

### Couleurs
- **Primary**: #12d640 (vert vif)
- **Secondary**: #1a1a2e (bleu foncé)
- **Accent**: #16213e (bleu nuit)

### Composants DaisyUI utilisés
- Cards
- Badges
- Buttons
- Forms (input, textarea, select)
- Modals
- Alerts
- Tables
- Dropdowns
- Avatars

### Classes personnalisées
- `.glass-card`: Effet glassmorphism
- `.stats-card`: Cartes de statistiques animées
- `.sidebar-link`: Liens de navigation
- `.btn-action`: Boutons d'action

## 📝 Conventions de code

### Nomenclature
- **Variables**: camelCase ou snake_case
- **Classes**: PascalCase
- **Fichiers**: snake_case.php
- **Base de données**: snake_case

### Structure des modules
Chaque module CRUD doit contenir:
1. `index.php`: Liste avec pagination
2. `create.php`: Page de création
3. `edit.php`: Page d'édition
4. `form.php`: Formulaire réutilisable
5. `save.php`: Traitement CREATE/UPDATE
6. `delete.php`: Suppression

### Pattern de formulaire
```php
<?php
require_once __DIR__ . '/../_init.php';
$pageTitle = 'Titre';
$isEdit = false;
$item = null;

if ($isEdit && isset($_GET['id'])) {
    // Charger l'élément
}

include __DIR__ . '/../../components/header.php';
?>
<div class="flex h-screen">
    <?php include __DIR__ . '/../../components/sidebar.php'; ?>
    <main class="flex-1 overflow-y-auto">
        <!-- Contenu -->
    </main>
</div>
<?php include __DIR__ . '/../../components/footer.php'; ?>
```

## 🔧 Fonctionnalités avancées

### Upload de fichiers
- Validation des types (images: jpg, png, webp / docs: pdf)
- Redimensionnement automatique des images
- Noms de fichiers sécurisés
- Stockage dans `/uploads/`

### Gestion d'images
- Upload avec prévisualisation
- Suppression de l'ancienne image
- Formats acceptés: JPEG, PNG, WebP
- Taille max: 5MB

### Pagination
- 10-20 éléments par page
- Navigation avec numéros de page
- Affichage du total

### Recherche et filtres
- Recherche par nom/titre
- Filtres par catégorie
- Tri par date, nom, position

### Ordonnancement drag-and-drop
- Réorganisation visuelle
- Mise à jour AJAX
- Sauvegarde automatique

## 🚀 Déploiement

### Prérequis
- PHP 8.3+
- MySQL 8.0+
- Composer
- Extensions: PDO, GD, mbstring, json

### Installation
1. Cloner le repository
2. Configurer `.env` avec les credentials DB
3. Importer `database/admin_schema.sql`
4. `composer install`
5. Configurer les permissions d'écriture sur `/uploads/`

### Sécurité
- Mots de passe hashés (bcrypt)
- Protection CSRF
- Validation des inputs
- Échappement XSS
- Rate limiting sur login
- Sessions sécurisées

## 📱 Responsive design
- Mobile-first approach
- Sidebar collapsible sur mobile
- Tables scrollables
- Formulaires adaptés

## 🔍 Debugging
- Error logging dans `error_log`
- Mode debug via `.env`
- Affichage des erreurs SQL en dev

## 📚 Ressources
- [TailwindCSS Docs](https://tailwindcss.com)
- [DaisyUI Components](https://daisyui.com)
- [Font Awesome Icons](https://fontawesome.com)
- [PHP 8.3 Manual](https://php.net)
