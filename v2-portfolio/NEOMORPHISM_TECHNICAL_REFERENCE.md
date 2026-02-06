# Neomorphism Technical Reference Guide

## Quick Start - Copy Paste Classes

### Basic Neomorphic Elements

#### White Card with Soft Shadow
```html
<div class="neomorph">
  <!-- Your content here -->
</div>
```

#### Small Neomorphic Button
```html
<button class="neomorph-sm px-4 py-2 rounded-md">Click me</button>
```

#### Large Neomorphic Card
```html
<div class="neomorph-lg p-8">
  <h2>Content goes here</h2>
</div>
```

#### Hover Interactive Element
```html
<a href="#" class="neomorph-hover">Link with hover effect</a>
```

---

## CSS Variable Mapping

### Background & Text Colors
```css
:root {
  --background: 255 255 255;      /* #ffffff - Pure white */
  --foreground: 30 41 59;         /* #1e293b - Light black */
  --card: 255 255 255;            /* #ffffff - White cards */
  --card-foreground: 30 41 59;    /* #1e293b - Text on cards */
}
```

### Blue Accent Colors
```css
:root {
  --primary: 59 130 246;          /* #3b82f6 - Blue-500 */
  --primary-foreground: 255 255 255; /* #ffffff - White text on blue */
  --accent: 96 165 250;           /* #60a5fa - Blue-400 */
  --secondary: 6 182 212;         /* #06b6d4 - Cyan-500 */
}
```

### Utility Colors
```css
:root {
  --muted: 241 245 249;           /* #f1f5f9 - Very light */
  --muted-foreground: 100 116 139; /* #64748b - Medium gray */
  --border: 226 232 240;          /* #e2e8f0 - Light border */
  --input: 248 250 252;           /* #f8fafc - Off-white input */
  --ring: 59 130 246;             /* #3b82f6 - Blue focus */
}
```

### Spacing & Radius
```css
:root {
  --radius: 0.375rem;             /* 6px - Small radius */
}
```

---

## Tailwind Class Reference

### Font Classes
```css
/* All text uses Poppins */
font-sans           /* Poppins (was Inter, now Poppins) */
font-heading        /* Poppins for headings */
```

### Color Classes
```css
/* Text Colors */
text-foreground     /* #1e293b - Light black text */
text-primary        /* #3b82f6 - Blue text */
text-secondary      /* #06b6d4 - Cyan text */
text-muted-foreground /* #64748b - Gray text */

/* Background Colors */
bg-white            /* #ffffff - White background */
bg-primary          /* #3b82f6 - Blue background */
bg-primary-50       /* #eff6ff - Very light blue */
bg-secondary        /* #06b6d4 - Cyan background */

/* Border Colors */
border-slate-200    /* Light gray border */
border-primary      /* Blue border */
```

### Gradient Classes
```css
gradient-blue-cyan        /* from-blue-400 to-cyan-300 */
gradient-blue-cyan-light  /* from-blue-50 to-cyan-50 (very subtle) */
gradient-text            /* Blue-to-cyan text gradient */
```

### Shadow Classes
```css
/* Elevation shadows (traditional) */
shadow-elevation-1  /* Subtle shadow */
shadow-elevation-2  /* Medium shadow */
shadow-elevation-3  /* Strong shadow */
shadow-elevation-4  /* Very strong shadow */

/* Neomorphism shadows */
shadow-neomorph-sm  /* Subtle (3px offset) */
shadow-neomorph     /* Standard (6px offset) */
shadow-neomorph-lg  /* Strong (8px offset) */
```

### Border Radius Classes
```css
rounded-sm          /* calc(var(--radius) - 4px) = 2px */
rounded-md          /* calc(var(--radius) - 2px) = 4px */
rounded-lg          /* var(--radius) = 6px */
```

---

## Component Examples

### Neomorphic Button
```tsx
<Button 
  className="bg-primary text-white px-8 py-2 rounded-md neomorph-hover"
>
  Click Me
</Button>
```

### Neomorphic Card
```tsx
<div className="neomorph p-6">
  <h3 className="text-lg font-semibold text-foreground mb-2">
    Title
  </h3>
  <p className="text-muted-foreground">
    Description text
  </p>
</div>
```

### Neomorphic Input
```tsx
<input 
  className="w-full px-4 py-2 bg-white border border-slate-200 neomorph-sm focus:outline-none focus:ring-2 focus:ring-primary"
  type="text"
  placeholder="Enter text..."
/>
```

### Neomorphic Avatar
```tsx
<div className="neomorph-sm w-12 h-12 rounded-md overflow-hidden flex items-center justify-center">
  <img src="..." alt="..." className="w-full h-full object-cover" />
</div>
```

### Gradient Blue-Cyan Accent
```tsx
<div className="gradient-blue-cyan text-white px-8 py-3 rounded-md font-semibold">
  Featured CTA
</div>
```

---

## Neomorphism Shadow Breakdown

### Light Source: Top-Left

The neomorphism style uses a **top-left light source**, creating:

1. **Dark Shadow (Bottom-Right)**
   - `6px 6px 12px rgba(0, 0, 0, 0.08)` - Dark shadow offset down-right
   - Simulates light coming from top-left

2. **White Highlight (Top-Left)**
   - `-6px -6px 12px rgba(255, 255, 255, 0.8)` - White highlight offset up-left
   - Enhances 3D embossed effect

3. **Subtle Border**
   - `border: 1px solid rgba(200, 200, 200, 0.1)` - Very subtle border
   - Almost invisible but adds definition

---

## Complete Color Palette

### Primary Colors
```
White:          #ffffff (RGB: 255, 255, 255)
Light Black:    #1e293b (RGB: 30, 41, 59)
```

### Blue Gradient (Primary)
```
Blue-50:    #eff6ff
Blue-100:   #dbeafe
Blue-200:   #bfdbfe
Blue-300:   #93c5fd
Blue-400:   #60a5fa (Accent)
Blue-500:   #3b82f6 (Primary)
Blue-600:   #2563eb
Blue-700:   #1d4ed8
Blue-800:   #1e40af
Blue-900:   #1e3a8a
```

### Cyan Gradient (Secondary)
```
Cyan-50:    #ecf8ff
Cyan-100:   #cff0ff
Cyan-200:   #a5e8ff
Cyan-300:   #67deff
Cyan-400:   #22d3ee
Cyan-500:   #06b6d4 (Secondary)
Cyan-600:   #0891b2
Cyan-700:   #0e7490
Cyan-800:   #155e75
Cyan-900:   #164e63
```

### Grays (Supporting)
```
Slate-50:   #f8fafc
Slate-100:  #f1f5f9
Slate-200:  #e2e8f0 (Border)
Slate-600:  #475569
Slate-700:  #334155
Slate-800:  #1e293b (Text)
```

---

## Do's and Don'ts

### ✅ DO:
- Use white backgrounds for neomorphism
- Apply small border-radius (6px)
- Pair dark shadow with white highlight
- Use Blue-Cyan gradients for accents
- Keep opacity subtle (8-10%)
- Use Poppins for all text
- Apply smooth transitions (300ms)

### ❌ DON'T:
- Use dark backgrounds with neomorphism
- Apply large border-radius (>8px)
- Use only shadows without highlights
- Mix in Indigo/Violet/Green
- Use high opacity on shadows (>15%)
- Mix fonts (only Poppins)
- Apply harsh, instant state changes

---

## Responsive Considerations

### Mobile
```tsx
className="px-4 py-2 text-sm rounded-md neomorph-sm"
```

### Tablet
```tsx
className="px-6 py-3 text-base rounded-md neomorph"
```

### Desktop
```tsx
className="px-8 py-4 text-lg rounded-md neomorph-lg"
```

---

## Browser Compatibility

- **Modern Browsers:** Full support (Chrome, Firefox, Safari, Edge)
- **CSS Grid:** Yes
- **Flexbox:** Yes
- **CSS Variables:** Yes
- **Box-shadow:** Yes
- **Backdrop-filter:** Yes (for glass effects)
- **Gradients:** Yes

---

## Performance Tips

1. **Avoid excessive nesting** - Keep structure simple
2. **Use CSS variables** - Reduces redundancy
3. **Minimize blur effects** - Can impact performance
4. **Use will-change sparingly** - Only for animated elements
5. **Batch transitions** - Group property changes

---

## Accessibility Notes

1. **Color Contrast:** Light Black on White = 21:1 (WCAG AAA)
2. **Focus States:** Use `focus:ring-2 focus:ring-primary`
3. **Button States:** Maintain visible active/hover states
4. **Shadow Only:** Don't rely on shadow alone for information
5. **Font Size:** Minimum 16px on mobile

---

## Advanced Usage

### Animated Hover Effect
```tsx
<motion.div
  whileHover={{ y: -4 }}
  className="neomorph-hover p-6"
>
  Content
</motion.div>
```

### Pressed State (Button Activation)
```tsx
<motion.button
  whileTap={{ scale: 0.98 }}
  className="neomorph px-4 py-2"
>
  Press me
</motion.button>
```

### Gradient Text with Neomorphic Background
```tsx
<div className="neomorph p-6">
  <h1 className="gradient-text text-4xl font-bold">
    Title
  </h1>
</div>
```

---

**Last Updated:** 2024
**Neomorphism Version:** 1.0
**Status:** Production Ready ✅
