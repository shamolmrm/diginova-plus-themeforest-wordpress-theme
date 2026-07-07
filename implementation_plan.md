# DigiNova Plus — ThemeForest WordPress Theme

A premium Digital Products & SaaS Marketplace WordPress Theme. This plan covers all 15 tasks required to build, polish, and submit the theme to ThemeForest.

---

## User Review Required

> [!IMPORTANT]
> This is a **very large project** (~150+ files, ~15,000+ lines of code). I recommend we build it **task-by-task** (Day 1 → Day 9) so you can review each section before moving on. Confirm how you'd like to proceed:
> - **Option A**: Build all tasks in one shot (will take a long time, may need multiple sessions)
> - **Option B**: Build day-by-day starting with **Day 1 (Tasks 1 & 2)** — recommended

> [!WARNING]
> **Envato Soft Reject Risk Areas** I'll proactively guard against:
> - Missing text domain on any translatable string
> - Direct DB queries without `$wpdb->prepare()`
> - Missing nonce verification on any AJAX/form handler
> - Bundled plugins inside theme folder (CPT must be in companion plugin)
> - Inline styles / hardcoded colors in PHP

---

## Open Questions

> [!IMPORTANT]
> **Author branding** — The prompt has placeholder `Author: YourName` / `Author URI: https://yoursite.com`. What name/URL should I use in `style.css`?

> [!IMPORTANT]
> **Redux vs Customizer** — The prompt mentions both Redux Framework and the native WordPress Customizer API. I'll use **native Customizer API** (preferred by Envato reviewers in 2024+ since Redux requires an extra plugin). Confirm if you want Redux instead.

> [!IMPORTANT]
> **EDD vs WooCommerce** — Both are listed as primary. I'll implement WooCommerce as the primary e-commerce layer and add EDD compatibility hooks. Confirm if EDD should be primary.

> [!IMPORTANT]
> **Chart.js for vendor dashboard** — Should I bundle Chart.js from CDN or local file? (Local is safer for Envato review)

---

## Proposed Changes

### Day 1 — Task 1: Core Theme Files

#### [NEW] [style.css](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus/style.css)
- Full theme headers (Envato-compliant)
- CSS custom properties (all design tokens)
- Normalized reset + base typography
- Utility classes (flex, grid, spacing, visibility)
- Dark mode CSS variables via `[data-theme="dark"]`

#### [NEW] [functions.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus/functions.php)
- `require_once` all `/inc/` class files
- TGMPA plugin requirements (Elementor, WooCommerce, One Click Demo Import, DigiNova Core)
- `diginovaplus_setup()` → theme support + menus + sidebars
- `diginovaplus_scripts()` → asset enqueue
- Customizer loader

#### [NEW] [inc/class-theme-setup.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus/inc/class-theme-setup.php)
- OOP class `DigiNova_Plus_Theme_Setup`
- All `add_theme_support()` calls
- `register_nav_menus()` — 5 menu locations
- `register_sidebar()` — 6 widget areas
- Custom image sizes

#### [NEW] [inc/class-assets.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus/inc/class-assets.php)
- Google Fonts preconnect + enqueue
- Bootstrap 5.3 CSS + JS
- Conditional script loading (WooCommerce, single product, vendor dashboard)
- `wp_localize_script()` for AJAX + nonce data

---

### Day 1 — Task 2: Companion Plugin

#### [NEW] [diginovaplus-core/diginovaplus-core.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus-core/diginovaplus-core.php)
- Plugin headers
- Autoloader / class includes on `plugins_loaded`

#### [NEW] [diginovaplus-core/inc/class-post-types.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus-core/inc/class-post-types.php)
- `diginovaplus_products` CPT registration

#### [NEW] [diginovaplus-core/inc/class-taxonomies.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus-core/inc/class-taxonomies.php)
- 3 taxonomies: category, tag, software_type

#### [NEW] [diginovaplus-core/inc/class-meta-boxes.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus-core/inc/class-meta-boxes.php)
- Full meta box system (price, version, demo URL, file info, compatibility)
- All fields nonce-protected + sanitized

#### [NEW] [diginovaplus-core/inc/class-reviews.php](file:///d:/Flutter App/Wordpress/DigiNova Plus - ThemeForest WordPress Theme/diginovaplus-core/inc/class-reviews.php)
- Star rating system (1–5)
- AJAX submit + nonce
- Average calculation

---

### Day 2 — Task 3: Header + Footer

#### [NEW] header.php
- Sticky header with JS scroll class
- Logo, primary nav (Bootstrap 5 Walker), search overlay, dark mode toggle, cart icon, user dropdown

#### [NEW] footer.php
- 4-column widget areas, social icons, copyright, back-to-top

#### [NEW] template-parts/header/header-default.php
#### [NEW] template-parts/header/header-transparent.php
#### [NEW] template-parts/header/header-sticky.php
#### [NEW] template-parts/footer/footer-default.php
#### [NEW] template-parts/footer/footer-minimal.php
#### [NEW] inc/class-walker-nav.php
- Bootstrap 5 dropdown walker with aria attributes + mega menu support

---

### Day 2 — Task 4: Home Page Templates

#### [NEW] template-parts/hero/hero-saas.php
- Glassmorphism hero, animated gradient, stats row, trusted logos

#### [NEW] template-parts/hero/hero-marketplace.php
- Search bar with category dropdown, category icon grid

#### [NEW] page-templates/template-home-saas.php
- 10-section SaaS homepage

#### [NEW] page-templates/template-home-marketplace.php
- Flash sale countdown, recently viewed (cookie-based)

---

### Day 3 — Task 5: Products Directory

#### [NEW] page-templates/template-products.php
- Left sidebar filters (category, price slider, software type, rating, sort)
- AJAX product grid with load more, view toggle (grid/list)

#### [NEW] assets/js/ajax-filter.js
- URL state management, debounced price slider, nonce-protected fetch, error handling

#### [NEW] template-parts/product/product-card.php
- Badges, lazy loading, author, rating, sales count, wishlist, quick preview

#### [NEW] template-parts/product/product-card-list.php
- List view variant

---

### Day 4 — Task 6: Single Product Page

#### [NEW] single-diginovaplus_products.php
- 8/12 + 4/12 sticky sidebar layout
- Screenshot gallery with lightbox
- Tab navigation (Overview / Changelog / Reviews / FAQ / Support)
- Author info card, related products
- Price card CTA, product stats, live preview button, share buttons

---

### Day 4 — Task 7: Live Preview Page

#### [NEW] page-templates/template-live-preview.php
- Standalone iframe page (no header/footer)
- Device switcher (desktop/tablet/mobile widths)
- URL parameter sanitization

#### [NEW] assets/js/live-preview.js

---

### Day 5 — Task 8: Vendor Dashboard

#### [NEW] page-templates/template-vendor-dashboard.php
- 8-tab sidebar dashboard
- Chart.js sales chart
- Products management, sales table, reviews tab

---

### Day 5 — Task 9: Customizer

#### [NEW] inc/class-customizer.php
- 7 Customizer panels (General, Colors, Typography, Header, Footer, Shop, Dark Mode)
- Live preview transport methods
- Postmessage JS for instant preview

---

### Day 6 — Task 10: Elementor Widgets

#### [NEW] elementor-widgets/class-widget-product-grid.php
#### [NEW] elementor-widgets/class-widget-hero-saas.php
#### [NEW] elementor-widgets/class-widget-stats-counter.php
#### [NEW] elementor-widgets/class-widget-pricing-table.php
#### [NEW] elementor-widgets/class-widget-vendor-showcase.php
#### [NEW] elementor-widgets/class-widget-testimonials.php
#### [NEW] elementor-widgets/class-widget-category-tabs.php
#### [NEW] elementor-widgets/class-widget-cta-banner.php
#### [NEW] inc/class-elementor-widgets.php — Widget registration

---

### Day 6 — Task 11: Demo Import

#### [NEW] inc/class-demo-importer.php
- 3 demo configurations (SaaS, Marketplace, Mega Store)
- Post-import hooks (set homepage, assign menus)

#### [NEW] demo-data/demo-content.xml
#### [NEW] demo-data/widgets.wie
#### [NEW] demo-data/customizer.dat
#### [NEW] demo-data/README.txt

---

### Day 7 — Task 12: SCSS + Animations

#### [NEW] assets/scss/_variables.scss
#### [NEW] assets/scss/_mixins.scss
#### [NEW] assets/scss/_base.scss
#### [NEW] assets/scss/_header.scss
#### [NEW] assets/scss/_footer.scss
#### [NEW] assets/scss/_products.scss
#### [NEW] assets/scss/_single-product.scss
#### [NEW] assets/scss/_vendor-dashboard.scss
#### [NEW] assets/scss/_elementor-widgets.scss
#### [NEW] assets/scss/main.scss
#### [NEW] assets/css/animations.css

---

### Day 7 — Task 13: WooCommerce Integration

#### [NEW] assets/css/woocommerce.css
- Full WooCommerce reskin matching DigiNova Plus design system
- Cart, checkout, my account, order confirmation

---

### Day 8 — Task 14: Support Ticket Page

#### [NEW] page-templates/template-support.php
- Buyer + author views
- AJAX ticket submission with file upload
- Ticket thread view

---

### Day 9 — Task 15: Additional Files

#### [NEW] index.php
#### [NEW] 404.php
#### [NEW] search.php
#### [NEW] archive.php
#### [NEW] single.php
#### [NEW] page.php
#### [NEW] comments.php
#### [NEW] sidebar.php
#### [NEW] rtl.css
#### [NEW] languages/diginovaplus.pot
#### [NEW] readme.txt
#### [NEW] changelog.txt
#### [NEW] inc/helpers.php
#### [NEW] inc/template-tags.php
#### [NEW] inc/class-breadcrumb.php
#### [NEW] inc/class-ajax-handler.php

---

## Verification Plan

### Automated Tests
- PHP CodeSniffer: `phpcs --standard=WordPress-Extra diginovaplus/`
- Check for missing text domain: `grep -r "__('" . --include="*.php" | grep -v "'diginovaplus'"`

### Manual Verification
- Load theme in local WordPress 6.6 (LocalWP)
- Activate companion plugin, verify CPT appears
- Import demo data via One Click Demo Import
- Test all 3 home page templates
- Test AJAX filter on products directory
- Test vendor dashboard with author user role
- Test dark mode toggle
- Test RTL mode
- Check mobile responsiveness at 320px, 375px, 768px, 1024px, 1440px
- Validate HTML with W3C validator
- Check PageSpeed score

### ThemeForest Submission Checklist
- All 15 checklist items from Task 15 verified before ZIP submission
