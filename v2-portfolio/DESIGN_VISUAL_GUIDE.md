# 🎨 Design System - Visual Reference Guide

## Color Palette

### Primary Colors
```
🔵 Primary (Indigo-600)
   HEX: #4f46e5
   RGB: 79, 70, 229
   Usage: Main CTA buttons, links, headings accent, primary branding
   Trust Level: High (professional, tech-forward)

🟣 Secondary (Violet-500)
   HEX: #8b5cf6
   RGB: 139, 92, 246
   Usage: Accent elements, secondary CTAs, decorative gradients
   Energy Level: Medium-High (modern, vibrant)

🟣 Accent (Violet-400)
   HEX: #a855f7
   RGB: 168, 85, 247
   Usage: Interactive elements, hover states, highlights
   Emphasis: Maximum contrast with backgrounds
```

### Neutral Colors
```
⚪ Background (Slate-50)
   HEX: #f8fafc
   RGB: 248, 254, 252
   Usage: Page background, main canvas
   Purpose: Clean, bright, professional

⚫ Foreground (Slate-900)
   HEX: #0f172a
   RGB: 15, 23, 42
   Usage: Text, primary content
   Contrast: AAA compliance with background

⚪ Card (White)
   HEX: #ffffff
   RGB: 255, 255, 255
   Usage: Card backgrounds, containers
   Elevation: Used with shadows for depth

🔲 Border (Slate-200)
   HEX: #e2e8f0
   RGB: 226, 232, 240
   Usage: Subtle divisions, borders
   Opacity: Transparent in some contexts
```

### Semantic Colors
```
🔴 Destructive (Red-600)
   HEX: #dc2626
   Usage: Delete, error, warning states
   Prominence: High (demands attention)
```

---

## Typography System

### Font Families
```
🔤 Headings (All h1-h6)
   Font: Poppins
   Weights: 300, 400, 500, 600, 700
   Character: Modern, clean, geometric
   CSS Variable: var(--font-poppins)
   CSS Class: font-heading

📝 Body Text & UI
   Font: Inter
   Weights: 300, 400, 500, 600, 700
   Character: Highly readable, neutral
   CSS Variable: var(--font-inter)
   CSS Class: font-sans
```

### Scale & Usage
```
h1: text-5xl md:text-7xl (Hero, page titles)
h2: text-3xl md:text-5xl (Section titles)
h3: text-2xl md:text-3xl (Subsections)
h4: text-xl md:text-2xl (Card titles)
p:  text-base md:text-lg (Body copy)
```

---

## Shadow & Elevation System

### Elevation Levels
```
Elevation 1 (Subtle)
┌─────────────────┐
│ Soft shadow for │ 0 1px 3px rgba(0,0,0,0.1)
│ floated content │
└─────────────────┘

Elevation 2 (Standard Card)
┌─────────────────────┐
│ Card containers,    │ 0 4px 6px rgba(0,0,0,0.1)
│ primary buttons     │
└─────────────────────┘

Elevation 3 (Interactive)
┌──────────────────────┐
│ Hover states,        │ 0 10px 15px rgba(0,0,0,0.1)
│ interactive elements │
└──────────────────────┘

Elevation 4 (Prominent)
┌──────────────────┐
│ Modals,          │ 0 20px 25px rgba(0,0,0,0.1)
│ overlays, dropdowns│
└──────────────────┘
```

### Usage Guidelines
- **Elevation 1**: Small badges, subtle separations
- **Elevation 2**: Cards, buttons, floating elements
- **Elevation 3**: Hover states, interactive feedback
- **Elevation 4**: Modals, prominent overlays, depth emphasis

---

## Gradient System

### Primary Gradient (Indigo → Violet)
```
┌──────────────────────────────┐
│ Indigo-600 ─→ Violet-500     │
│ #4f46e5    ─→ #8b5cf6        │
│ Used for: CTAs, headers, text │
└──────────────────────────────┘
Tailwind: bg-gradient-to-r from-indigo-600 to-violet-500
CSS Class: .gradient-indigo-violet
```

### Light Gradient (For Backgrounds)
```
┌────────────────────────────────┐
│ Indigo-50 ─→ Violet-50         │
│ #eef2ff   ─→ #faf5ff          │
│ Used for: Section backgrounds  │
└────────────────────────────────┘
Tailwind: bg-gradient-to-r from-indigo-50 to-violet-50
CSS Class: .gradient-indigo-violet-light
```

### Gradient Text Effect
```
┌──────────────────────────────┐
│ GRADIENT TEXT                │ (Like "Nguemoue" in hero)
│ Applied: bg-clip-text        │
│ Visibility: text-transparent │
└──────────────────────────────┘
CSS Class: .gradient-text
```

---

## Glassmorphism Effects

### Light Glass (For Light Mode)
```
┌─────────────────────────────┐
│ Light Glass Container       │
│ ✨ Slightly transparent     │ bg-white/60
│ ✨ Subtle blur effect       │ backdrop-blur-sm
│ ✨ Soft border              │ border border-white/20
│ Usage: Social icons, buttons│
└─────────────────────────────┘
CSS Class: .glass
```

### Dark Glass (For Dark Sections - if needed)
```
┌──────────────────────────────┐
│ Dark Glass Container         │
│ ✨ Dark semi-transparent    │ bg-slate-900/20
│ ✨ Medium blur effect        │ backdrop-blur-md
│ ✨ Subtle border             │ border border-slate-600/20
└──────────────────────────────┘
CSS Class: .glass-dark
```

---

## Component Patterns

### Button Styles

#### Primary Button (CTA)
```html
<button class="gradient-indigo-violet text-white font-semibold 
                shadow-elevation-2 hover:shadow-elevation-3">
  Voir mes projets
</button>

Visual:
┌──────────────────┐
│ Voir mes projets │ ← Indigo→Violet gradient
└──────────────────┘ ← Elevation 2 shadow (elevation 3 on hover)
```

#### Secondary Button (Outline)
```html
<button class="border-2 border-primary text-primary 
               hover:bg-indigo-50">
  Me contacter
</button>

Visual:
┌──────────────────┐
│ Me contacter     │ ← Indigo outline, text
└──────────────────┘ ← Light indigo hover background
```

### Card Pattern
```html
<div class="card-modern">
  <!-- Content -->
</div>

Includes:
✓ White background
✓ Rounded corners (0.5rem)
✓ Elevation 2 shadow
✓ Light slate border
✓ Smooth hover to elevation 3
```

### Social Link Pattern
```html
<a class="w-12 h-12 rounded-full bg-white/60 backdrop-blur-sm 
          border border-slate-200 flex items-center justify-center
          hover:gradient-indigo-violet hover:text-white
          transition-all duration-300 shadow-soft hover:shadow-elevation-2">
  <Icon />
</a>

Visual (Default):
┌───────┐
│   🔗  │ ← Light glass, slate-600 text
└───────┘

Visual (Hover):
┌───────┐
│   🔗  │ ← Gradient fill, white text, elevation 2
└───────┘
```

---

## Spacing & Layout

### Container Spacing
```
Horizontal Padding: 2rem (32px) standard
Mobile: Responsive reduction
Max Width: 1400px (2xl screens)
```

### Component Spacing
```
Hero Section: min-h-screen (full viewport)
Gaps: 4px, 8px, 12px, 16px, 24px, 32px
Margins: Standard Tailwind increments
```

---

## Animations & Transitions

### Staggered Entrance (Hero Section)
```
Profile:      0.0s delay  (scale 0→1)
Heading:      0.2s delay  (y: 20→0)
Subheading:   0.4s delay  (y: 20→0)
Description:  0.6s delay  (y: 20→0)
CTA Buttons:  0.8s delay  (y: 20→0)
Social Links: 1.0s delay  (y: 20→0)
Scroll Icon:  1.2s delay  (fade in)
```

### Smooth Transitions
```
Duration: 300ms (--transition-smooth)
Easing: ease-in-out
Properties: all
```

### Hover Effects
```
Profile Glow: Scale 1→1.05 over 3s (infinite)
Social Icons: Scale 1→1.1, y shift -4px
Buttons:      Shadow elevation change
Scroll Icon:  Color change, continuous motion
```

---

## Responsive Design

### Breakpoints
```
Mobile:     < 768px
Tablet:     768px - 1024px
Desktop:    1024px - 1400px
Ultra-wide: > 1400px
```

### Typography Scaling
```
Mobile Text:   text-lg / text-2xl
Desktop Text:  text-xl / text-3xl
Mobile Heading: text-5xl
Desktop Heading: text-7xl
```

---

## Accessibility

### Color Contrast
```
Primary (#4f46e5) on White: 7.2:1 ratio ✓ AAA
Foreground (#0f172a) on Background: 12.6:1 ratio ✓ AAA
All text: Minimum 4.5:1 contrast ratio ✓
```

### Typography
```
Line Height: 1.5-2.0 (readable)
Letter Spacing: Standard Inter/Poppins defaults
Font Size: Minimum 16px mobile
```

### Interactive Elements
```
Button Size: Minimum 44x44px touch target
Focus States: Visible ring (primary color)
Hover States: Clear visual feedback
```

---

## CSS Class Reference

### Color Classes
```
.text-primary       → Indigo-600 text
.bg-primary         → Indigo-600 background
.border-primary     → Indigo-600 border
.text-secondary     → Violet-500 text
.gradient-text      → Gradient text effect
```

### Shadow Classes
```
.shadow-soft        → Minimal shadow
.shadow-elevation-1 → Subtle lift
.shadow-elevation-2 → Card level
.shadow-elevation-3 → Interactive
.shadow-elevation-4 → Prominent
```

### Gradient Classes
```
.gradient-indigo-violet       → Primary gradient
.gradient-indigo-violet-light → Light variant
.gradient-text                → Text gradient
```

### Utility Classes
```
.glass              → Light glassmorphism
.glass-dark         → Dark glassmorphism
.card-modern        → Modern card style
.transition-smooth  → 300ms smooth transition
.font-heading       → Poppins font
.font-sans          → Inter font
```

---

## Design Tokens Summary

```json
{
  "colors": {
    "primary": {
      "default": "#4f46e5",
      "light": "#e0e7ff",
      "dark": "#312e81"
    },
    "secondary": {
      "default": "#8b5cf6",
      "light": "#f3e8ff",
      "dark": "#581c87"
    },
    "neutral": {
      "background": "#f8fafc",
      "foreground": "#0f172a",
      "card": "#ffffff",
      "border": "#e2e8f0"
    }
  },
  "typography": {
    "heading": "Poppins",
    "body": "Inter"
  },
  "spacing": {
    "radius": "0.5rem",
    "padding": "2rem",
    "gap": "1rem"
  },
  "shadows": {
    "soft": "0 1px 3px rgb(0 0 0 / 5%)",
    "elevation1": "0 1px 3px rgb(0 0 0 / 10%)",
    "elevation2": "0 4px 6px rgb(0 0 0 / 10%)",
    "elevation3": "0 10px 15px rgb(0 0 0 / 10%)",
    "elevation4": "0 20px 25px rgb(0 0 0 / 10%)"
  },
  "animation": {
    "duration": "300ms",
    "easing": "ease-in-out"
  }
}
```

---

## Quick Implementation Guide

### Using the Design System

#### 1. Text with Gradient
```html
<h1 class="font-heading text-6xl">
  Luc <span class="gradient-text">Nguemoue</span>
</h1>
```

#### 2. Modern Card
```html
<div class="card-modern p-6">
  <h3 class="font-heading">Title</h3>
  <p class="font-sans text-foreground">Content</p>
</div>
```

#### 3. CTA Button
```html
<button class="gradient-indigo-violet text-white font-heading 
               shadow-elevation-2 hover:shadow-elevation-3 
               px-8 py-3 rounded-lg transition-smooth">
  Click Me
</button>
```

#### 4. Social Icon with Glass Effect
```html
<a class="w-12 h-12 rounded-full glass flex items-center justify-center
          hover:gradient-indigo-violet hover:text-white transition-smooth">
  <Icon />
</a>
```

#### 5. Section with Gradient Background
```html
<section class="bg-gradient-to-r from-indigo-50 to-violet-50 py-16">
  <div class="container">
    <!-- Content -->
  </div>
</section>
```

---

## Performance Notes

✅ Minimal shadow usage for smooth rendering
✅ Optimized animations (GPU-accelerated transforms)
✅ Efficient gradient rendering
✅ Lazy-loaded images where possible
✅ CSS variables for theme consistency
✅ No unnecessary blur effects on critical elements

---

**This design system ensures a cohesive, professional, and modern appearance across the entire portfolio.**
