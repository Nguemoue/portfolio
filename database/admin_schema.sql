-- Base de données pour le système d'administration
-- Compatible avec MySQL 8.0+ et PHP 8.3

USE portfolio;

-- Table des utilisateurs admin
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'super_admin') DEFAULT 'admin',
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des informations personnelles
CREATE TABLE IF NOT EXISTS personal_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    email VARCHAR(100),
    phone VARCHAR(20),
    whatsapp VARCHAR(20),
    location VARCHAR(100),
    country VARCHAR(50),
    profile_image VARCHAR(255),
    linkedin_url VARCHAR(255),
    github_url VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table du parcours éducatif
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(200) NOT NULL,
    institution VARCHAR(200) NOT NULL,
    location VARCHAR(100),
    start_date DATE,
    end_date DATE,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des expériences professionnelles
CREATE TABLE IF NOT EXISTS experiences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(200) NOT NULL,
    company VARCHAR(200) NOT NULL,
    company_url VARCHAR(255),
    location VARCHAR(100),
    start_date DATE,
    end_date DATE,
    is_current BOOLEAN DEFAULT FALSE,
    description TEXT,
    technologies JSON,
    is_active BOOLEAN DEFAULT TRUE,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des projets
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    project_url VARCHAR(255),
    github_url VARCHAR(255),
    image VARCHAR(255),
    technologies JSON,
    category ENUM('entreprise', 'personnel') DEFAULT 'personnel',
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des compétences
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100),
    proficiency ENUM('débutant', 'intermédiaire', 'avancé', 'expert') DEFAULT 'intermédiaire',
    icon VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des certifications
CREATE TABLE IF NOT EXISTS certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    issuing_organization VARCHAR(200) NOT NULL,
    credential_id VARCHAR(100),
    credential_url VARCHAR(255),
    issue_date DATE,
    expiration_date DATE,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    order_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des CVs
CREATE TABLE IF NOT EXISTS cvs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    file_path VARCHAR(255) NOT NULL,
    file_size INT,
    language ENUM('fr', 'en') DEFAULT 'fr',
    is_primary BOOLEAN DEFAULT FALSE,
    download_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des logs d'activité
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(50),
    record_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Insertion de l'utilisateur admin par défaut
INSERT IGNORE INTO users (username, email, password, role) VALUES
('admin', 'lucchuala@gmail.com', '$2y$12$3TVXCdqNuKt02BxVTxMXoukvzggTJ0f7hm60D1RdDcu28H9Ib4Bp6', 'super_admin');

-- Mot de passe par défaut : 'admin123' (à changer immédiatement)

-- Insertion des informations personnelles par défaut
INSERT IGNORE INTO personal_info (id, name, title, description, email, phone, whatsapp, location, country, linkedin_url, github_url) VALUES
(1, 'Luc Nguemoue', 'Développeur Web Full Stack', 'Développeur concentré et enthousiaste, avec un intérêt marqué pour le développement de logiciels et l\'intelligence artificielle.', 'lucchuala@gmail.com', '+237 699 568 073', '+237 699 568 073', 'Yaoundé', 'Cameroun', 'https://www.linkedin.com/in/nguemoue', 'https://www.github.com/Nguemoue');
