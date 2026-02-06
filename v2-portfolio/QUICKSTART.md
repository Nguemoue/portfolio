# 🎨 Portfolio v2 - Checklist de Démarrage

## ✅ Installation Complète

Tout est installé et configuré :
- ✅ Next.js 14.2.23
- ✅ React 19.0.0
- ✅ TypeScript 5
- ✅ TailwindCSS 3.4.1
- ✅ Framer Motion 11.15.0
- ✅ Shadcn UI (button component)
- ✅ 369 packages, 0 vulnérabilités

---

## 🚀 Pour démarrer

### Méthode 1: Commande simple
```bash
cd C:\laragon\www\portfolio\v2-portfolio
npm run dev
```

### Méthode 2: Si erreur
```bash
# Nettoyer et réinstaller
cd C:\laragon\www\portfolio\v2-portfolio
rm -rf .next
rm -rf node_modules
npm install
npm run dev
```

### Méthode 3: Build puis démarrer
```bash
cd C:\laragon\www\portfolio\v2-portfolio
npm run build
npm start
```

---

## 📝 Vérifications Avant de Lancer

### 1. Fichiers Créés ✅
- [x] `components/ui/button.tsx`
- [x] `components/layout/Navbar.tsx`
- [x] `components/layout/Footer.tsx`
- [x] `components/sections/Hero.tsx`
- [x] `components/sections/About.tsx`
- [x] `components/sections/Education.tsx`
- [x] `components/sections/Experience.tsx`
- [x] `components/sections/Projects.tsx`
- [x] `components/sections/Skills.tsx`
- [x] `components/sections/Contact.tsx`
- [x] `lib/utils.ts`
- [x] `app/layout.tsx` (modifié)
- [x] `app/page.tsx` (modifié)
- [x] `app/globals.css` (modifié)
- [x] `tailwind.config.ts` (configuré)

### 2. Image de Profil ✅
- [x] Dossier `public/assets/img/` créé
- [x] Image `profile.jpeg` copiée

### 3. Configuration ✅
- [x] TailwindCSS configuré avec couleur primaire #12d640
- [x] Fonts Google (Inter, Poppins) configurées
- [x] SEO metadata configurés
- [x] Animations Framer Motion prêtes

---

## 🎯 Sections Disponibles

Une fois le serveur lancé, vous verrez:

1. **Hero Section** (http://localhost:3000#hero)
   - Typing animation: "Développeur Full Stack", "Développeur Laravel", "Passionné d'IA"
   - Photo de profil avec effet glow
   - 2 boutons CTA
   - Liens sociaux

2. **About** (http://localhost:3000#about)
   - Bio avec lettre initiale stylée
   - Coordonnées (tél, email, localisation)
   - 4 centres d'intérêts

3. **Education** (http://localhost:3000#education)
   - Formation IAI Cameroun
   - 3 certifications

4. **Experience** (http://localhost:3000#experience)
   - Timeline verticale
   - 2 expériences (Kamix, Kozao)

5. **Projects** (http://localhost:3000#projects)
   - Filtres: Tous / Enterprise / Personnel
   - Grille de projets

6. **Skills** (http://localhost:3000#skills)
   - 4 catégories
   - Barres de progression animées

7. **Contact** (http://localhost:3000#contact)
   - Formulaire complet
   - Informations de contact

---

## 🔧 Si Erreur au Démarrage

### Erreur: "Internal Server Error"
**Cause possible**: Conflit de cache ou imports

**Solution**:
```bash
cd C:\laragon\www\portfolio\v2-portfolio
rm -rf .next
npm run dev
```

### Erreur: "Port 3000 already in use"
**Solution 1**: Tuer le processus
```bash
npx kill-port 3000
npm run dev
```

**Solution 2**: Utiliser un autre port
```bash
npm run dev -- -p 3001
```

### Erreur: "Module not found"
**Solution**:
```bash
npm install
npm run dev
```

---

## 📱 Test Responsivité

Une fois le site lancé, testez sur:
- Desktop (1920x1080)
- Tablet (768px)
- Mobile (375px)

---

## 🎨 Personnalisation Rapide

### Changer la couleur primaire
```typescript
// tailwind.config.ts
colors: {
  primary: {
    DEFAULT: '#12d640', // Changez ici
  }
}
```

### Modifier les projets
```typescript
// components/sections/Projects.tsx
const projects = [
  // Ajoutez vos projets ici
]
```

### Modifier les compétences
```typescript
// components/sections/Skills.tsx
const skillCategories = [
  // Modifiez les compétences ici
]
```

---

## 📊 Performance Attendue

- ⚡ **First Contentful Paint**: < 1.5s
- ⚡ **Time to Interactive**: < 2.5s
- ⚡ **Lighthouse Score**: 90+
- ✅ **SEO**: Optimisé
- ✅ **Accessibility**: Bonne
- ✅ **Best Practices**: Respectées

---

## 📞 Si Problème

1. Vérifier que Node.js 18+ est installé: `node --version`
2. Vérifier que npm fonctionne: `npm --version`
3. Nettoyer le cache: `npm cache clean --force`
4. Réinstaller: `rm -rf node_modules && npm install`

---

## 🎉 Prêt à Lancer !

Votre portfolio v2 est 100% prêt. Lancez simplement:

```bash
cd C:\laragon\www\portfolio\v2-portfolio
npm run dev
```

Puis ouvrez: **http://localhost:3000**

---

**Créé le**: 6 février 2026  
**Status**: ✅ Prêt à l'emploi
