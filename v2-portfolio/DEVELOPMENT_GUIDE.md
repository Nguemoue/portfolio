# 🚀 PORTFOLIO V2 - GUIDE DE DÉVELOPPEMENT

## ✅ Ce qui a été créé

### 1. Branche Git
✅ Branche `v2-nextjs-portfolio` créée

### 2. Projet Next.js
✅ Next.js 14 avec App Router installé
✅ TypeScript configuré
✅ TailwindCSS configuré
✅ Framer Motion installé
✅ Lucide React & Hero Icons installés

### 3. Structure de dossiers
```
v2-portfolio/
├── app/                     # App Router Next.js
├── components/              
│   ├── ui/                 # Composants UI de base
│   ├── sections/           # Sections de page
│   └── layout/             # Composants layout
├── lib/                     # Utilitaires
├── types/                   # Types TypeScript
├── data/                    # Données statiques
└── public/                  # Assets statiques
```

### 4. Fichiers créés
✅ `tailwind.config.ts` - Configuration Tailwind personnalisée
✅ `types/index.ts` - Types TypeScript complets
✅ `data/personal-info.ts` - Données personnelles

---

## 🎨 Design System

### Couleurs
```typescript
primary: {
  DEFAULT: '#12d640', // Vert principal
  500: '#12d640',
  600: '#0eb536',
  // ... autres nuances
}

dark: {
  DEFAULT: '#1a1a2e', // Bleu foncé
  900: '#1a1a2e',
  // ... autres nuances
}
```

### Animations Tailwind
- `animate-fade-in`
- `animate-slide-in`
- `animate-slide-up`
- `animate-float`

---

## 📦 Prochaines étapes

### Phase 1: Layout & Navigation (À faire maintenant)
```bash
cd C:\laragon\www\portfolio\v2-portfolio
npm run dev
```

#### Créer les composants suivants:

1. **components/layout/Navbar.tsx**
```typescript
'use client'
import { useState } from 'react'
import Link from 'next/link'
import { motion } from 'framer-motion'
import { Menu, X } from 'lucide-react'

export default function Navbar() {
  const [isOpen, setIsOpen] = useState(false)
  
  const links = [
    { href: '/', label: 'Accueil' },
    { href: '/about', label: 'À propos' },
    { href: '/projects', label: 'Projets' },
    { href: '/experience', label: 'Expérience' },
    { href: '/blog', label: 'Blog' },
    { href: '/contact', label: 'Contact' },
  ]
  
  return (
    <nav className="fixed top-0 w-full bg-white/80 dark:bg-dark/80 backdrop-blur-md z-50 border-b border-gray-200 dark:border-gray-800">
      {/* Navigation desktop */}
      <div className="container mx-auto px-6 py-4">
        <div className="flex items-center justify-between">
          <Link href="/" className="text-2xl font-bold text-primary">
            LN
          </Link>
          
          {/* Desktop links */}
          <div className="hidden md:flex space-x-8">
            {links.map((link) => (
              <Link 
                key={link.href}
                href={link.href}
                className="text-gray-700 dark:text-gray-300 hover:text-primary transition"
              >
                {link.label}
              </Link>
            ))}
          </div>
          
          {/* Mobile menu button */}
          <button 
            className="md:hidden"
            onClick={() => setIsOpen(!isOpen)}
          >
            {isOpen ? <X /> : <Menu />}
          </button>
        </div>
        
        {/* Mobile menu */}
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            className="md:hidden py-4"
          >
            {links.map((link) => (
              <Link
                key={link.href}
                href={link.href}
                className="block py-2 text-gray-700 dark:text-gray-300"
                onClick={() => setIsOpen(false)}
              >
                {link.label}
              </Link>
            ))}
          </motion.div>
        )}
      </div>
    </nav>
  )
}
```

2. **components/layout/Footer.tsx**
```typescript
import { personalInfo } from '@/data/personal-info'
import { Github, Linkedin, Mail } from 'lucide-react'

export default function Footer() {
  return (
    <footer className="bg-dark text-white py-12">
      <div className="container mx-auto px-6">
        <div className="grid md:grid-cols-3 gap-8">
          <div>
            <h3 className="text-2xl font-bold text-primary mb-4">
              {personalInfo.name}
            </h3>
            <p className="text-gray-400">{personalInfo.title}</p>
          </div>
          
          <div>
            <h4 className="font-semibold mb-4">Contact</h4>
            <p className="text-gray-400">{personalInfo.email}</p>
            <p className="text-gray-400">{personalInfo.location}, {personalInfo.country}</p>
          </div>
          
          <div>
            <h4 className="font-semibold mb-4">Suivez-moi</h4>
            <div className="flex space-x-4">
              {personalInfo.githubUrl && (
                <a href={personalInfo.githubUrl} target="_blank" className="hover:text-primary transition">
                  <Github />
                </a>
              )}
              {personalInfo.linkedinUrl && (
                <a href={personalInfo.linkedinUrl} target="_blank" className="hover:text-primary transition">
                  <Linkedin />
                </a>
              )}
              <a href={`mailto:${personalInfo.email}`} className="hover:text-primary transition">
                <Mail />
              </a>
            </div>
          </div>
        </div>
        
        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
          © {new Date().getFullYear()} {personalInfo.name}. Tous droits réservés.
        </div>
      </div>
    </footer>
  )
}
```

3. **Modifier app/layout.tsx**
```typescript
import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import Navbar from "@/components/layout/Navbar";
import Footer from "@/components/layout/Footer";

const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Luc Nguemoue - Développeur Full Stack",
  description: "Portfolio professionnel de Luc Nguemoue, développeur web full stack",
  keywords: ["développeur", "full stack", "PHP", "JavaScript", "Next.js", "React"],
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="fr" className={inter.variable}>
      <body className="antialiased bg-white dark:bg-dark text-gray-900 dark:text-gray-100">
        <Navbar />
        <main className="min-h-screen pt-20">
          {children}
        </main>
        <Footer />
      </body>
    </html>
  );
}
```

4. **Créer app/page.tsx (Hero Section)**
```typescript
'use client'
import { motion } from 'framer-motion'
import { personalInfo } from '@/data/personal-info'
import { ArrowRight, Download } from 'lucide-react'
import Link from 'next/link'

export default function Home() {
  return (
    <section className="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50 dark:from-dark-900 dark:to-dark-800">
      <div className="container mx-auto px-6">
        <div className="grid md:grid-cols-2 gap-12 items-center">
          <motion.div
            initial={{ opacity: 0, x: -50 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.5 }}
          >
            <h1 className="text-5xl md:text-6xl font-bold mb-6">
              Bonjour, je suis{' '}
              <span className="text-primary">{personalInfo.name}</span>
            </h1>
            
            <h2 className="text-2xl md:text-3xl text-gray-600 dark:text-gray-400 mb-6">
              {personalInfo.title}
            </h2>
            
            <p className="text-lg text-gray-700 dark:text-gray-300 mb-8 leading-relaxed">
              {personalInfo.description}
            </p>
            
            <div className="flex flex-wrap gap-4">
              <Link 
                href="/projects"
                className="px-6 py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary-600 transition inline-flex items-center gap-2"
              >
                Voir mes projets <ArrowRight size={20} />
              </Link>
              
              <Link
                href="/contact"
                className="px-6 py-3 border-2 border-primary text-primary rounded-lg font-medium hover:bg-primary hover:text-white transition inline-flex items-center gap-2"
              >
                Me contacter
              </Link>
              
              <button className="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-white rounded-lg font-medium hover:bg-gray-700 transition inline-flex items-center gap-2">
                <Download size={20} /> Télécharger CV
              </button>
            </div>
          </motion.div>
          
          <motion.div
            initial={{ opacity: 0, x: 50 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.5, delay: 0.2 }}
            className="hidden md:block"
          >
            <div className="relative w-full h-[500px] bg-gradient-to-br from-primary/20 to-blue-500/20 rounded-3xl animate-float">
              {/* Placeholder pour image/illustration */}
              <div className="absolute inset-0 flex items-center justify-center">
                <div className="w-64 h-64 bg-primary/10 rounded-full"></div>
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  )
}
```

### Phase 2: Pages principales
Créer les pages suivantes dans `app/`:
- `about/page.tsx` - Page À propos
- `projects/page.tsx` - Liste des projets
- `experience/page.tsx` - Timeline expériences
- `blog/page.tsx` - Liste des articles
- `contact/page.tsx` - Formulaire de contact

### Phase 3: Composants sections
Créer dans `components/sections/`:
- `ProjectsGrid.tsx` - Grille de projets
- `ExperienceTimeline.tsx` - Timeline d'expériences
- `SkillsSection.tsx` - Section compétences
- `CertificationsSection.tsx` - Certifications
- `ContactForm.tsx` - Formulaire de contact

### Phase 4: Intégration API
Créer `lib/api.ts` pour connecter avec votre backend PHP :
```typescript
const API_URL = 'http://localhost/api'

export async function getProjects() {
  const res = await fetch(`${API_URL}/projects`)
  return res.json()
}

export async function getExperiences() {
  const res = await fetch(`${API_URL}/experiences`)
  return res.json()
}

// ... autres fonctions
```

---

## 🚀 Commandes utiles

```bash
# Démarrer le serveur de développement
npm run dev

# Build pour production
npm run build

# Démarrer en mode production
npm start

# Linter
npm run lint
```

---

## 📝 Notes importantes

1. **Mode Dark**: Activé via `className="dark"` sur `<html>`
2. **Responsive**: Tout est responsive mobile-first
3. **Animations**: Utiliser Framer Motion pour les animations
4. **SEO**: Metadata dans chaque page
5. **Performance**: Utiliser Next.js Image et optimisation automatique

---

## 🎯 Priorités

1. ✅ Layout & Navigation (À faire en premier)
2. Hero Section animée
3. Section Projets avec filtres
4. Timeline Expériences
5. Section Skills
6. Formulaire Contact
7. Blog (optionnel)
8. Mode Dark/Light toggle
9. Connexion API backend PHP
10. Déploiement

---

**Le projet est prêt à être développé ! Commencez par créer les composants Navbar et Footer, puis la Hero Section.** 🚀

Le serveur démarre sur: http://localhost:3000
