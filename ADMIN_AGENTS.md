# 🤖 AGENTS ADMIN - Système de gestion du portfolio

## 📋 Définition des agents

Les agents sont des composants autonomes qui gèrent des fonctionnalités spécifiques du dashboard admin. Chaque agent a un rôle précis et peut interagir avec d'autres agents.

---

## 🎯 Agent: Dashboard Manager

### Responsabilités
- Agrégation des statistiques en temps réel
- Affichage des activités récentes
- Génération des graphiques et métriques
- Monitoring de l'état du système

### Fonctions principales
```php
class DashboardAgent {
    public function getStats(): array;
    public function getRecentActivities(int $limit = 10): array;
    public function getSystemInfo(): array;
    public function getQuickActions(): array;
}
```

### Interactions
- Lit depuis: tous les modules (projects, education, etc.)
- Écrit vers: activity_logs
- Dépend de: AuthAgent, DatabaseAgent

---

## 👤 Agent: Authentication Manager

### Responsabilités
- Gestion des sessions utilisateurs
- Vérification des permissions
- Rate limiting des tentatives de connexion
- Logging des connexions/déconnexions
- Gestion des tokens CSRF

### Fonctions principales
```php
class AuthAgent {
    public static function login(string $username, string $password): bool;
    public static function logout(): void;
    public static function requireAuth(): void;
    public static function user(): ?array;
    public static function hasRole(string $role): bool;
    public static function checkPermission(string $action): bool;
}
```

### Interactions
- Lit/écrit: users, activity_logs
- Protège: tous les modules
- Dépend de: DatabaseAgent

---

## 💾 Agent: Database Manager

### Responsabilités
- Connexion à la base de données (Singleton)
- Exécution des requêtes préparées
- Gestion des transactions
- Logging des erreurs SQL
- Optimisation des requêtes

### Fonctions principales
```php
class DatabaseAgent {
    public static function getInstance(): PDO;
    public function query(string $sql, array $params = []): PDOStatement;
    public function insert(string $table, array $data): int;
    public function update(string $table, array $data, array $where): bool;
    public function delete(string $table, array $where): bool;
    public function beginTransaction(): bool;
    public function commit(): bool;
    public function rollback(): bool;
}
```

### Interactions
- Utilisé par: tous les autres agents
- Dépend de: fichier de config

---

## 📁 Agent: File Manager

### Responsabilités
- Upload de fichiers (images, PDFs)
- Validation des types et tailles
- Redimensionnement d'images
- Génération de noms uniques
- Suppression de fichiers
- Gestion des dossiers d'upload

### Fonctions principales
```php
class FileAgent {
    public function uploadImage(array $file, string $folder = 'images'): string;
    public function uploadPDF(array $file, string $folder = 'cvs'): string;
    public function deleteFile(string $path): bool;
    public function resizeImage(string $path, int $maxWidth, int $maxHeight): bool;
    public function generateUniqueFileName(string $originalName): string;
    public function validateFileType(array $file, array $allowedTypes): bool;
}
```

### Interactions
- Utilisé par: Projects, Education, Profile, CVs
- Écrit dans: `/uploads/` + sous-dossiers
- Dépend de: extension GD

---

## 📝 Agent: Activity Logger

### Responsabilités
- Enregistrement de toutes les actions admin
- Capture des modifications (before/after)
- Logging des informations de requête (IP, user-agent)
- Nettoyage des logs anciens
- Export des logs

### Fonctions principales
```php
class ActivityLoggerAgent {
    public static function log(string $action, string $table, int $recordId, array $oldValues = null, array $newValues = null): void;
    public static function getLogs(array $filters = [], int $page = 1, int $perPage = 50): array;
    public static function cleanOldLogs(int $daysToKeep = 90): int;
    public static function exportLogs(array $filters = []): string;
}
```

### Interactions
- Écrit vers: activity_logs
- Appelé par: tous les agents CRUD
- Dépend de: AuthAgent, DatabaseAgent

---

## 🗂️ Agent: CRUD Manager (abstrait)

### Responsabilités
- Base commune pour tous les modules CRUD
- Opérations standardisées (list, create, read, update, delete)
- Pagination
- Recherche et filtres
- Ordonnancement

### Fonctions principales
```php
abstract class CRUDAgent {
    protected string $table;
    protected string $primaryKey = 'id';
    
    public function getAll(int $page = 1, int $perPage = 20, array $filters = []): array;
    public function getById(int $id): ?array;
    public function create(array $data): int;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function updateOrder(int $id, int $newPosition): bool;
    public function toggleActive(int $id): bool;
    protected function validate(array $data): array;
}
```

### Agents enfants
- ProjectAgent
- EducationAgent
- ExperienceAgent
- SkillAgent
- CertificationAgent
- CVAgent

---

## 🎨 Agent: Projects Manager

### Responsabilités
- Gestion complète des projets
- Upload d'images de projet
- Gestion des technologies (JSON)
- Catégorisation (entreprise/personnel)
- Projets mis en avant

### Fonctions spécifiques
```php
class ProjectAgent extends CRUDAgent {
    public function getFeaturedProjects(): array;
    public function getByCategory(string $category): array;
    public function addTechnology(int $projectId, string $tech): bool;
    public function removeTechnology(int $projectId, string $tech): bool;
    public function setFeatured(int $projectId, bool $featured): bool;
}
```

### Interactions
- Table: projects
- Utilise: FileAgent, ActivityLoggerAgent
- Upload dans: `/uploads/projects/`

---

## 🎓 Agent: Education Manager

### Responsabilités
- Gestion du parcours éducatif
- Ordonnancement chronologique
- Upload logos d'institutions
- Gestion des dates

### Fonctions spécifiques
```php
class EducationAgent extends CRUDAgent {
    public function getByInstitution(string $institution): array;
    public function getOrderedByDate(string $order = 'DESC'): array;
    public function checkDateOverlap(array $dates): bool;
}
```

### Interactions
- Table: education
- Utilise: FileAgent, ActivityLoggerAgent
- Upload dans: `/uploads/education/`

---

## 💼 Agent: Experience Manager

### Responsabilités
- Gestion des expériences professionnelles
- Gestion du poste actuel
- Technologies par expérience
- Calcul des durées

### Fonctions spécifiques
```php
class ExperienceAgent extends CRUDAgent {
    public function getCurrentExperience(): ?array;
    public function setAsCurrent(int $id): bool;
    public function calculateDuration(int $id): string;
    public function getByCompany(string $company): array;
}
```

### Interactions
- Table: experiences
- Utilise: ActivityLoggerAgent
- JSON: technologies

---

## ⚡ Agent: Skills Manager

### Responsabilités
- Gestion des compétences techniques
- Catégorisation (Frontend, Backend, DevOps, etc.)
- Niveaux de maîtrise
- Gestion des icônes

### Fonctions spécifiques
```php
class SkillAgent extends CRUDAgent {
    public function getByCategory(string $category): array;
    public function getByProficiency(string $level): array;
    public function getAllCategories(): array;
    public function updateProficiency(int $id, string $level): bool;
}
```

### Interactions
- Table: skills
- Utilise: ActivityLoggerAgent
- Icônes: Font Awesome classes

---

## 🏆 Agent: Certifications Manager

### Responsabilités
- Gestion des certifications
- Vérification des dates d'expiration
- Upload de badges
- Liens de vérification

### Fonctions spécifiques
```php
class CertificationAgent extends CRUDAgent {
    public function getActive(): array;
    public function getExpired(): array;
    public function getExpiringSoon(int $days = 30): array;
    public function checkExpiration(int $id): bool;
}
```

### Interactions
- Table: certifications
- Utilise: FileAgent, ActivityLoggerAgent
- Upload dans: `/uploads/certifications/`

---

## 📄 Agent: CV Manager

### Responsabilités
- Gestion des CVs téléchargeables
- Upload de PDFs
- Gestion multilingue (FR/EN)
- CV principal
- Compteur de téléchargements

### Fonctions spécifiques
```php
class CVAgent extends CRUDAgent {
    public function getPrimaryCV(string $lang = 'fr'): ?array;
    public function setPrimary(int $id): bool;
    public function incrementDownloadCount(int $id): bool;
    public function getByLanguage(string $lang): array;
    public function validatePDF(array $file): bool;
}
```

### Interactions
- Table: cvs
- Utilise: FileAgent, ActivityLoggerAgent
- Upload dans: `/uploads/cvs/`

---

## 👤 Agent: Profile Manager

### Responsabilités
- Gestion des informations personnelles (1 seul profil)
- Upload photo de profil
- Gestion des liens sociaux
- Coordonnées de contact

### Fonctions principales
```php
class ProfileAgent {
    public function getProfile(): array;
    public function updateProfile(array $data): bool;
    public function updateProfileImage(array $file): string;
    public function updateSocialLinks(array $links): bool;
    public function updateContactInfo(array $contact): bool;
}
```

### Interactions
- Table: personal_info (1 ligne)
- Utilise: FileAgent, ActivityLoggerAgent
- Upload dans: `/uploads/profile/`

---

## ⚙️ Agent: Settings Manager

### Responsabilités
- Gestion des paramètres système
- Configuration email
- Paramètres SEO
- Mode maintenance
- Sauvegardes

### Fonctions principales
```php
class SettingsAgent {
    public function getSetting(string $key): mixed;
    public function updateSetting(string $key, mixed $value): bool;
    public function getAllSettings(): array;
    public function enableMaintenanceMode(): bool;
    public function disableMaintenanceMode(): bool;
    public function createBackup(): string;
    public function restoreBackup(string $file): bool;
}
```

### Interactions
- Table: settings (potentielle)
- Utilise: DatabaseAgent, FileAgent
- Dépend de: AuthAgent (super_admin requis)

---

## 📊 Agent: Logs Viewer

### Responsabilités
- Affichage des logs d'activité
- Filtres avancés
- Export CSV/JSON
- Nettoyage des logs

### Fonctions principales
```php
class LogsViewerAgent {
    public function getLogs(array $filters, int $page, int $perPage): array;
    public function exportToCsv(array $filters): string;
    public function exportToJson(array $filters): string;
    public function cleanLogs(int $daysToKeep): int;
    public function getLogsByUser(int $userId): array;
    public function getLogsByTable(string $table): array;
}
```

### Interactions
- Lit: activity_logs
- Utilise: DatabaseAgent
- Écrit: fichiers d'export

---

## 🔄 Flux d'interaction entre agents

### Scénario: Création d'un projet

1. **User** → Soumet le formulaire
2. **AuthAgent** → Vérifie l'authentification
3. **ProjectAgent** → Valide les données
4. **FileAgent** → Upload l'image
5. **DatabaseAgent** → Insert dans la DB
6. **ActivityLoggerAgent** → Log l'action
7. **Response** → Redirection avec message de succès

### Scénario: Upload d'un CV

1. **User** → Upload le fichier
2. **AuthAgent** → Vérifie l'authentification
3. **CVAgent** → Valide le PDF
4. **FileAgent** → Stocke le fichier
5. **CVAgent** → Crée l'entrée DB
6. **ActivityLoggerAgent** → Log l'action
7. **Response** → Confirmation

---

## 📝 Implémentation recommandée

### Structure des classes
```
app/
├── Auth.php
├── Database/
│   └── Database.php
└── Agents/
    ├── DashboardAgent.php
    ├── FileAgent.php
    ├── ActivityLoggerAgent.php
    ├── CRUDAgent.php (abstract)
    ├── ProjectAgent.php
    ├── EducationAgent.php
    ├── ExperienceAgent.php
    ├── SkillAgent.php
    ├── CertificationAgent.php
    ├── CVAgent.php
    ├── ProfileAgent.php
    ├── SettingsAgent.php
    └── LogsViewerAgent.php
```

### Autoloading
Utiliser Composer PSR-4:
```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "App\\Agents\\": "app/Agents/"
    }
}
```

---

## 🎯 Bonnes pratiques

1. **Separation of Concerns**: Chaque agent a une responsabilité unique
2. **DRY**: Utiliser l'agent abstrait CRUDAgent pour éviter la duplication
3. **Error Handling**: Tous les agents doivent logger leurs erreurs
4. **Type Hinting**: Utiliser les types PHP 8.3
5. **Security**: Validation et échappement dans chaque agent
6. **Performance**: Caching des requêtes fréquentes
7. **Testing**: Tests unitaires pour chaque agent

---

## 🚀 Extensions futures

- **NotificationAgent**: Envoi d'emails, push notifications
- **AnalyticsAgent**: Statistiques avancées, rapports
- **CacheAgent**: Gestion du cache Redis/Memcached
- **APIAgent**: Exposition API REST pour les agents
- **BackupAgent**: Sauvegardes automatisées
- **SearchAgent**: Recherche globale multi-tables
