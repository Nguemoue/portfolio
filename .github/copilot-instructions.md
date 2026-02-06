# Portfolio Project - Copilot Instructions

## Project Overview

This is a **dual-version personal portfolio website** for Luc Nguemoue:
- **Main PHP version** (root): Production-ready portfolio with full admin dashboard
- **v2-portfolio**: Next.js/React rewrite (in development)

## Architecture

### PHP Portfolio (Primary)

**Entry Point**: `index.php` - Monolithic HTML/PHP file with embedded frontend

**Backend**:
- **Framework**: Custom PHP 8.3+ with PSR-4 autoloading (Composer)
- **Database**: MySQL 8.0+ accessed via PDO singleton pattern
- **Authentication**: Session-based with `App\Auth` class
- **Database Layer**: `App\Database\Database` - singleton PDO instance

**Admin Dashboard** (`/admin/`):
- Full CRUD system for portfolio content management
- Module-based structure: each module has `index.php`, `create.php`, `edit.php`, `form.php`, `save.php`, `delete.php`
- All admin pages require authentication via `_init.php`
- Activity logging built-in for all CRUD operations

**Frontend**:
- **CSS**: TailwindCSS 3.x + DaisyUI 4.6 components (admin only uses DaisyUI)
- **JS**: Vanilla JavaScript + Typed.js for animations
- **Icons**: Font Awesome 6.4

### Next.js v2 (`/v2-portfolio/`)

**Stack**: Next.js 16, React 19, TypeScript 5, Tailwind CSS 4
- Separate codebase, not yet integrated with main site
- Modern component-based architecture
- See `v2-portfolio/README.md` for v2-specific instructions

## Database Schema

Key tables:
- `users` - Admin users with role-based access (admin/super_admin)
- `personal_info` - Profile information (single row)
- `projects` - Portfolio projects with images and technologies (JSON)
- `education` - Academic background
- `experiences` - Work history with technologies (JSON)
- `skills` - Categorized skills with proficiency levels
- `certifications` - Professional certifications with expiry tracking
- `cvs` - Downloadable PDF resumes (multi-language)
- `activity_logs` - Audit trail of all admin actions

Schema: `database/admin_schema.sql`

## File Structure

```
portfolio/
├── admin/                    # Admin dashboard
│   ├── modules/             # CRUD modules
│   │   ├── _init.php       # Auth check + helpers (required by all modules)
│   │   ├── projects/       # Project management
│   │   ├── education/      # Education management
│   │   ├── experience/     # Experience management
│   │   ├── skills/         # Skills management
│   │   ├── certifications/ # Certification management
│   │   ├── cvs/            # CV upload/management
│   │   ├── profile/        # Personal info editing
│   │   ├── settings/       # System settings (super_admin only)
│   │   └── logs/           # Activity log viewer
│   ├── components/         # Shared UI (header, sidebar, footer)
│   ├── assets/             # Admin CSS/JS
│   ├── index.php           # Dashboard with stats
│   ├── login.php           # Authentication
│   └── logout.php          # Session cleanup
├── app/                     # PHP classes (PSR-4)
│   ├── Auth.php            # Authentication + activity logging
│   └── Database/
│       └── Database.php    # PDO singleton
├── config/
│   └── database.php        # DB config (uses env() helper)
├── helpers/
│   └── helpers.php         # env() and config() functions
├── uploads/                # User-uploaded files
│   ├── projects/
│   ├── education/
│   ├── certifications/
│   ├── profile/
│   └── cvs/
├── assets/                 # Frontend assets
│   ├── css/
│   ├── js/
│   └── img/
├── v2-portfolio/           # Next.js rewrite (separate project)
└── index.php               # Main portfolio page

```

## Key Conventions

### Admin Module Structure
Every admin CRUD module follows this pattern:
- `index.php` - List view with pagination
- `create.php` - Empty form for new records
- `edit.php?id=X` - Pre-filled form for existing record
- `form.php` - Shared form markup (included by create/edit)
- `save.php` - POST handler for both create and update
- `delete.php?id=X` - DELETE handler

All modules start with: `require_once __DIR__ . '/../_init.php';`

### Authentication Flow
```php
// Check if logged in
Auth::requireAuth();

// Check for super_admin role
Auth::requireSuperAdmin();

// Get current user
$user = Auth::user();  // ['id', 'username', 'email', 'role']
$userId = Auth::id();
```

### Database Access
```php
use App\Database\Database;

$db = Database::getInstance(); // Returns PDO
$stmt = $db->prepare("SELECT ...");
$stmt->execute([...]);
```

### Activity Logging
```php
use App\Auth;

// Log any CRUD action
Auth::logActivity('create', 'projects', $projectId, [], $newValues);
Auth::logActivity('update', 'projects', $projectId, $oldValues, $newValues);
Auth::logActivity('delete', 'projects', $projectId, $oldValues, []);
```

### File Uploads
- Images: `uploads/{module}/` (e.g., `uploads/projects/image_123.jpg`)
- PDFs: `uploads/cvs/` (max 10MB)
- Always validate MIME types
- Use unique filenames: `{type}_{timestamp}_{random}.{ext}`

### JSON Fields
Technologies and arrays stored as JSON in MySQL:
```php
// Save
$technologies = json_encode(['PHP', 'Laravel', 'MySQL']);

// Retrieve
$technologies = json_decode($row['technologies'], true);
```

### Flash Messages (Admin)
```php
// Set in _init.php helper
admin_flash('Project created successfully', 'success');
admin_redirect('/admin/modules/projects/');
```

### Consistent Naming
- Database: snake_case (`created_at`, `is_active`)
- PHP classes: PascalCase (`Auth`, `Database`)
- PHP methods: camelCase (`getInstance()`, `logActivity()`)
- Files/folders: lowercase with hyphens or underscores

## Environment Configuration

`.env` file required:
```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=portfolio
DB_USER=root
DB_PASSWORD=
```

Access via `env()` helper: `env('DB_HOST')`

## Development Workflow

### PHP Portfolio
1. Run on local server (Laragon, XAMPP, etc.)
2. Ensure MySQL is running with `portfolio` database
3. Import schema: `database/admin_schema.sql`
4. Default admin login: username `admin`, password `admin123` (change in production)
5. Access admin: `http://localhost/admin/`

### Next.js v2
```bash
cd v2-portfolio
npm install
npm run dev    # Development server on port 3000
npm run build  # Production build
npm run lint   # ESLint
```

## Security Notes

- **Never commit** `.env` file
- **All admin pages** protected by `Auth::requireAuth()`
- **Settings module** restricted to `super_admin` role
- **SQL injection prevention**: Always use prepared statements
- **XSS prevention**: Use `htmlspecialchars()` for output
- **File uploads**: Validate MIME types and file sizes
- **Activity logging**: Captures IP address and user agent for audit trail

## Common Tasks

### Add a new admin module
1. Create folder: `admin/modules/{module_name}/`
2. Copy structure from existing module (e.g., `projects/`)
3. Create corresponding database table
4. Add link to sidebar: `admin/components/sidebar.php`
5. Remember to include `_init.php` at top of each file

### Change database schema
1. Update `database/admin_schema.sql`
2. Run ALTER TABLE commands or reimport
3. Update corresponding PHP module files

### Add frontend feature
- Main site: Edit `index.php` (monolithic)
- v2: Edit files in `v2-portfolio/app/` and `v2-portfolio/components/`

## Documentation

Extensive admin documentation exists:
- `ADMIN_INSTRUCTIONS.md` - Complete admin system guide (9,000+ chars)
- `ADMIN_DEVELOPMENT.md` - Development progress and features (12,000+ chars)
- `ADMIN_AGENTS.md` - Architecture patterns and agent definitions (13,000+ chars)
- `ADMIN_SKILLS.md` - Required technical skills and roadmap (12,000+ chars)

For v2-portfolio:
- `v2-portfolio/README.md` - Next.js project overview
- `v2-portfolio/DEVELOPMENT_GUIDE.md` - Development guidelines
- `v2-portfolio/QUICKSTART.md` - Quick setup guide

## Testing

### Playwright MCP Server (Configured)
Playwright is available for automated browser testing via MCP integration.

**Use cases**:
- Test admin login flow: `http://localhost/admin/login.php`
- Verify CRUD operations in admin modules
- Test responsive design across viewports
- Validate form submissions and error handling
- Test Next.js v2 components: `http://localhost:3000`

**Example test scenarios**:
- Navigate to admin dashboard and verify statistics display
- Create a new project through the admin interface
- Upload a file (CV or image) and verify success
- Test mobile responsive menu behavior

## Production Deployment

1. Set proper file permissions:
   - Directories: 755
   - PHP files: 644
   - `uploads/`: 775 (web server writable)
2. Enable HTTPS (SSL/TLS required)
3. Change default admin credentials
4. Update `.env` with production database credentials
5. Disable error display: `display_errors = Off` in php.ini
6. Enable OPcache for performance
7. Configure `.htaccess` for security headers
