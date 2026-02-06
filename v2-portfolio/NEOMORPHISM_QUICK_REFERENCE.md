# Neomorphism Quick Reference Card

## 🎨 Color Palette at a Glance

### Primary Colors
| Name | Hex | RGB | Usage |
|------|-----|-----|-------|
| White | #ffffff | 255,255,255 | Background |
| Light Black | #1e293b | 30,41,59 | Text |
| Blue-500 | #3b82f6 | 59,130,246 | Primary CTA |
| Blue-400 | #60a5fa | 96,165,250 | Accents |
| Cyan-500 | #06b6d4 | 6,182,212 | Secondary |

### Supporting Colors
| Name | Hex | Usage |
|------|-----|-------|
| Light Slate | #f1f5f9 | Input backgrounds |
| Border Slate | #e2e8f0 | Borders |
| Muted Slate | #64748b | Disabled text |

---

## 📝 Font Reference

```css
/* All text uses Poppins */
font-family: 'Poppins', sans-serif;

/* Available weights */
300: Light
400: Regular (default)
500: Medium
600: SemiBold
700: Bold
```

---

## 🔲 Border Radius

```css
/* All elements use 6px */
--radius: 0.375rem; /* 6px */

/* Tailwind classes */
rounded-sm   /* 2px */
rounded-md   /* 4px */
rounded-lg   /* 6px (use this) */
```

---

## ⚫ Shadow Styles

### Small (3px offset)
```css
.neomorph-sm {
  box-shadow: 3px 3px 8px rgba(0,0,0,0.06),
              -3px -3px 8px rgba(255,255,255,0.9);
}
```

### Standard (6px offset)
```css
.neomorph {
  box-shadow: 6px 6px 12px rgba(0,0,0,0.08),
              -6px -6px 12px rgba(255,255,255,0.8);
}
```

### Large (8px offset)
```css
.neomorph-lg {
  box-shadow: 8px 8px 16px rgba(0,0,0,0.1),
              -8px -8px 16px rgba(255,255,255,0.7);
}
```

---

## 🎯 Common Classes

### Background
```
bg-white          /* White background */
bg-primary        /* Blue-500 */
bg-secondary      /* Cyan-500 */
bg-primary-50     /* Light blue */
```

### Text
```
text-foreground   /* Light black */
text-primary      /* Blue */
text-secondary    /* Cyan */
text-muted-foreground  /* Gray */
```

### Borders
```
border-slate-200  /* Light gray */
border-primary    /* Blue */
border-secondary  /* Cyan */
```

### Shadows
```
shadow-neomorph-sm    /* Subtle */
shadow-neomorph       /* Standard */
shadow-neomorph-lg    /* Strong */
neomorph-hover        /* Interactive */
```

### Gradients
```
gradient-blue-cyan       /* Blue to Cyan */
gradient-blue-cyan-light /* Subtle gradient */
gradient-text           /* Text gradient */
```

---

## 📦 Component Templates

### Basic Card
```html
<div class="neomorph p-6 rounded-lg">
  <h3 class="text-foreground font-semibold">Title</h3>
  <p class="text-muted-foreground">Content</p>
</div>
```

### Primary Button
```html
<button class="bg-primary text-white px-6 py-2 rounded-md neomorph-hover">
  Click Me
</button>
```

### Secondary Button
```html
<button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-md neomorph-hover">
  Secondary
</button>
```

### Profile Image
```html
<div class="neomorph-lg w-32 h-32 rounded-md overflow-hidden">
  <img src="..." alt="..." class="w-full h-full object-cover" />
</div>
```

### Icon Button
```html
<a href="#" class="w-12 h-12 rounded-md bg-white neomorph-hover flex items-center justify-center">
  <IconComponent />
</a>
```

---

## ✅ Do's ✅

- ✅ Use white backgrounds
- ✅ Apply Poppins to all text
- ✅ Use 6px border radius
- ✅ Pair dark shadow with white highlight
- ✅ Use Blue-Cyan gradients
- ✅ Keep shadows subtle (8-10% opacity)
- ✅ Use smooth transitions (300ms)
- ✅ Apply `.neomorph-hover` for interactive elements

---

## ❌ Don'ts ❌

- ❌ Don't use dark backgrounds
- ❌ Don't use Indigo/Violet/Green
- ❌ Don't use large border radius (pills)
- ❌ Don't use shadows alone without highlights
- ❌ Don't use other fonts (Inter, Arial, etc.)
- ❌ Don't apply harsh, instant state changes
- ❌ Don't use dark mode
- ❌ Don't mix fonts

---

## 🔤 Typography Sizes

```css
/* Heading sizes */
h1 { font-size: 2.25rem; }   /* 36px */
h2 { font-size: 1.875rem; }  /* 30px */
h3 { font-size: 1.5rem; }    /* 24px */
h4 { font-size: 1.25rem; }   /* 20px */
h5 { font-size: 1.125rem; }  /* 18px */
h6 { font-size: 1rem; }      /* 16px */

/* Body text */
body { font-size: 1rem; }    /* 16px default */
small { font-size: 0.875rem; } /* 14px */
```

---

## 🌈 Gradient Combinations

### Blue to Cyan (Primary)
```css
from-blue-400 to-cyan-300
from-blue-500 to-cyan-400
```

### Subtle Blue-Cyan
```css
from-blue-50 to-cyan-50
```

### Blue Gradient (Monochromatic)
```css
from-blue-400 to-blue-600
```

### Cyan Gradient (Monochromatic)
```css
from-cyan-300 to-cyan-500
```

---

## 📐 Spacing Guide

```css
/* Use Tailwind spacing */
p-2    /* 8px */
p-4    /* 16px */
p-6    /* 24px */
p-8    /* 32px */

gap-2  /* 8px */
gap-4  /* 16px */
gap-6  /* 24px */
```

---

## 🎬 Transition Timing

```css
/* Standard duration */
duration-300 /* 300ms default */

/* Easing */
ease-in-out  /* Smooth acceleration/deceleration */
ease         /* Default easing */
```

---

## 🔍 Focus States

```html
<input 
  class="focus:ring-2 focus:ring-primary focus:outline-none"
/>

<button 
  class="focus:ring-2 focus:ring-offset-2 focus:ring-primary"
/>
```

---

## 🎯 Color Hex Reference

```
Primary Blue:      #3b82f6
Secondary Cyan:    #06b6d4
Accent Blue:       #60a5fa
Background White:  #ffffff
Text Light Black:  #1e293b
Light Slate:       #f1f5f9
Border Slate:      #e2e8f0
```

---

## 📋 CSS Variables

```css
:root {
  --background: 255 255 255;      /* White */
  --foreground: 30 41 59;         /* Light Black */
  --primary: 59 130 246;          /* Blue-500 */
  --secondary: 6 182 212;         /* Cyan-500 */
  --accent: 96 165 250;           /* Blue-400 */
  --muted: 241 245 249;           /* Light Slate */
  --border: 226 232 240;          /* Border Slate */
  --input: 248 250 252;           /* Off-white */
  --ring: 59 130 246;             /* Blue focus */
  --radius: 0.375rem;             /* 6px */
}
```

---

## 🚀 Quick Copy-Paste

### Minimal Card
```html
<div class="bg-white neomorph p-6">Content</div>
```

### Minimal Button
```html
<button class="bg-primary text-white px-6 py-2 rounded-md">Click</button>
```

### Minimal Gradient
```html
<div class="bg-gradient-to-r from-blue-400 to-cyan-300 text-white p-6">
  Gradient
</div>
```

### Minimal Text
```html
<p class="text-foreground font-sans">Text using Poppins</p>
```

---

## 🎨 Color Combinations

### Good Pairs
- White bg + Blue text
- White bg + Blue button
- Light Slate bg + Blue text
- Blue bg + White text
- Cyan bg + White text

### Avoid
- Dark backgrounds
- Indigo/Violet mix
- Green accents
- Text without contrast

---

## 📊 Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers

---

## 🔗 Useful Classes

```
/* Layout */
flex, grid, container, mx-auto

/* Spacing */
p-*, m-*, gap-*

/* Typography */
text-*, font-*, font-sans

/* Colors */
bg-*, text-*, border-*

/* Shadows */
shadow-*, neomorph*

/* Responsive */
sm:, md:, lg:, xl:

/* Interactivity */
hover:, focus:, active:
```

---

## ⚡ Performance Tips

1. Use CSS variables for colors
2. Minimize blur effects
3. Use neomorph classes (not custom shadows)
4. Batch transitions together
5. Avoid excessive nesting

---

**Quick Reference Version:** 1.0
**Last Updated:** 2024
**Status:** Ready to Use ✅
