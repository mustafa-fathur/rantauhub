# RantauHub Theme Guide

This document explains how to use the RantauHub custom DaisyUI theme in your components.

## Color Palette

The application uses a custom color scheme aligned with the Minangkabau heritage:

- **Primary (`#122937`)**: Dark blue/teal
  - Used for: Headers, primary buttons, main brand elements, backgrounds
  - CSS: `bg-primary`, `text-primary`, `border-primary`
  - Content color: `text-primary-content` (white)

- **Secondary (`#CEA761`)**: Gold
  - Used for: Accent highlights, titles, progress bars, star ratings, call-to-action buttons
  - CSS: `bg-secondary`, `text-secondary`, `border-secondary`
  - Content color: `text-secondary-content` (dark blue)

- **Accent (`#925E25`)**: Darker gold/brown
  - Used for: Tertiary accents, depth elements
  - CSS: `bg-accent`, `text-accent`, `border-accent`
  - Content color: `text-accent-content` (white)

## Usage Examples

### Buttons

```blade
<!-- Primary button (dark blue) -->
<button class="btn btn-primary">Primary Action</button>

<!-- Secondary button (gold) -->
<button class="btn btn-secondary">Highlight Action</button>

<!-- Accent button (darker gold) -->
<button class="btn btn-accent">Tertiary Action</button>
```

### Backgrounds & Cards

```blade
<!-- Main background -->
<div class="bg-base-100">Content</div>

<!-- Subtle background -->
<div class="bg-base-200">Content</div>

<!-- Prominent background -->
<div class="bg-primary text-primary-content">Content</div>
```

### Text Colors

```blade
<!-- Primary colored text -->
<span class="text-primary">Brand Text</span>

<!-- Secondary colored text -->
<span class="text-secondary">Accent Text</span>

<!-- Default text (adapts to theme) -->
<p class="text-base-content">Body text</p>
```

### Progress Bars

```blade
<div class="w-full bg-base-300 rounded-full h-2.5">
    <div class="bg-secondary h-2.5 rounded-full" style="width: 70%"></div>
</div>
```

### Badges/Tags

```blade
<!-- Primary badge -->
<span class="badge badge-primary">Primary</span>

<!-- Secondary badge -->
<span class="badge badge-secondary">Secondary</span>

<!-- Accent badge -->
<span class="badge badge-accent">Accent</span>
```

### Cards

```blade
<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title text-primary">Card Title</h2>
        <p class="text-base-content">Card content</p>
        <div class="card-actions">
            <button class="btn btn-primary">Action</button>
        </div>
    </div>
</div>
```

## Applying the Theme

The theme is configured in:
- **CSS Variables**: `resources/css/app.css` (Tailwind v4 `@theme` syntax)
- **DaisyUI Config**: `tailwind.config.js` (DaisyUI theme definition)

To apply the theme globally, add `data-theme="rantauhub"` to your root HTML element:

```blade
<html data-theme="rantauhub">
```

Or apply it to specific sections:

```blade
<div data-theme="rantauhub">
    <!-- Theme applies to this section only -->
</div>
```

## Dark Mode Support

Dark mode is supported with adjusted base colors. Toggle dark mode using:

```blade
<html class="dark" data-theme="rantauhub">
```

The theme automatically adjusts:
- Base backgrounds become darker
- Text colors become lighter
- Primary, secondary, and accent colors remain the same for brand consistency

## Component Examples

### Header Navigation
```blade
<nav class="bg-primary text-primary-content">
    <div class="navbar">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl text-secondary">RantauHub</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a class="text-primary-content hover:text-secondary">Home</a></li>
            </ul>
        </div>
    </div>
</nav>
```

### Hero Section
```blade
<section class="hero bg-primary text-primary-content">
    <div class="hero-content text-center">
        <h1 class="text-5xl font-bold text-secondary">RantauHub</h1>
        <p class="py-6">Smart Solution for West Sumatra Sustainability</p>
        <button class="btn btn-secondary">Get Started</button>
    </div>
</section>
```

### Investment Card (from design)
```blade
<div class="card bg-base-100 shadow-xl">
    <figure><img src="..." alt="UMKM" /></figure>
    <div class="card-body">
        <div class="badge badge-secondary">Kuliner</div>
        <h2 class="card-title">Rendang Uni Rina</h2>
        <p class="text-base-content text-sm">Solok, Sumatera Barat</p>
        <p class="text-base-content">Description...</p>
        <div class="w-full bg-base-300 rounded-full h-2">
            <div class="bg-secondary h-2 rounded-full" style="width: 70%"></div>
        </div>
        <p class="text-base-content text-sm">Rp 35.0 jt terkumpul • 70% • 21 Investor</p>
        <div class="card-actions">
            <button class="btn btn-primary btn-block">Lihat Detail</button>
        </div>
    </div>
</div>
```

## Best Practices

1. **Use semantic colors**: Prefer `btn-primary` over `btn-[#122937]`
2. **Content colors**: Always pair background colors with their content colors (`bg-primary` with `text-primary-content`)
3. **Consistency**: Use the same color for similar elements (all primary buttons use `btn-primary`)
4. **Accessibility**: Ensure sufficient contrast between text and background
5. **Dark mode**: Test components in both light and dark modes

## Tailwind Utilities

You can also use Tailwind utilities directly:

```blade
<!-- Custom background with primary -->
<div class="bg-[#122937] text-white">Custom</div>

<!-- Using CSS variables -->
<div style="background-color: var(--color-primary);">Custom</div>
```

However, prefer DaisyUI classes or Tailwind theme utilities (`bg-primary`) for better theme consistency.

