=== Luminary Collective ===

Contributors: luminary
Tags: editorial, luxury, women-leadership, minimal, bilingual, custom-post-types, customizer, polylang
Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later

Editorial luxury theme for a women's leadership community. Customizer-driven globals, CPT-driven repeatable content (Programs, Members, Benefits, FAQ), 4 nav-menu locations (header + 3 footer columns), Polylang-ready with automatic JS fallback.

== Installation ==

1. Appearance → Themes → Add New → Upload Theme → women_leadership.zip → Install Now → Activate.

2. On activation the theme creates:
   - Pages: "Home" (set as front page) + "Journal" (= /blog/)
   - 4 Programs, 4 Members, 6 Benefits, 5 FAQ items (UA + PL content)
   - 6 Categories: Leadership, Power, Craft, Rituals, Money, Culture
   - 4 Menus assigned to their locations: "Primary", "Footer Community", "Footer Join", "Footer Contact"
   - Reading settings: front page = Home, posts page = Journal

3. Done — open the homepage and everything is wired up.

== Editing content ==

GLOBAL TEXTS — Appearance → Customize → "Luminary: Hero / Programs / Members / Benefits / FAQ / Final CTA / Footer / Branding / Navigation / Testimonial / Big quote / Criteria / Journal preview"
Each text has UA and PL fields.

REPEATABLE CONTENT (admin sidebar):
- Programs — title, excerpt, featured image, meta1/meta2, PL fields
- Members — title (name), featured image, role UA/PL
- Benefits — title, excerpt, PL versions
- FAQ — title (question), content (answer), PL versions

BLOG POSTS — Posts → Add New
Standard WP fields: title, content, categories, tags, featured image, author.
On the front-end (single post): featured image, title, byline (author + bio), date, category, tags, reading time, content, full taxonomy footer.

MENUS — Appearance → Menus
4 locations are registered:
- Primary (header)
- Footer column 1: Community
- Footer column 2: Join
- Footer column 3: Contact
Each menu item has a "Polish label (data-pl)" field — fill in for the JS switcher to pick it up.

== Multilingual ==

Two modes:

A) JS switcher (default, no plugin required)
   - UA / PL toggle in the header.
   - Texts have data-pl attributes; clicking PL swaps innerHTML on the same page.
   - State persists in localStorage.
   - Good for prototype / single-language SEO.

B) Polylang plugin (recommended for production)
   - Install Polylang from WP plugin directory.
   - Languages → add Ukrainian and Polish.
   - In Languages → Settings, enable translation for the custom post types: Programs, Members, Benefits, FAQ.
   - Theme auto-detects Polylang and:
     * Replaces the JS switcher with Polylang's <a> links (uses same .lang-btn markup → same styling).
     * Skips the JS data-pl swap (Polylang serves the right page version directly).
     * Registers all Customizer text values as translatable strings — find them in Languages → Strings translations, group "Women Leadership".
   - Pages, Posts, Menus get duplicated per language via the standard Polylang UI ("+" icon next to each post).

== Files ==

- style.css                — theme header
- functions.php            — setup, asset enqueue, dynamic styles
- header.php / footer.php  — wp_nav_menu × 4, wp_head/wp_footer
- front-page.php           — home: hero + programs + criteria + members + benefits + journal preview + FAQ + CTA
- page.php                 — generic page template (any Page → uses this)
- page-blog.php            — blog index template (assigned to "Journal" page)
- archive.php              — category / tag / author archives
- single.php               — single post with full author/category/tag/date metadata
- search.php               — search results
- index.php                — fallback
- inc/template-helpers.php — lum_ua / lum_pl_attr / lum_render_language_switcher
- inc/cpt.php              — Programs, Members, Benefits, FAQ post types + meta boxes
- inc/customizer.php       — all Customizer settings
- inc/menu.php             — nav menu integration + footer fallback functions
- inc/polylang.php         — pll_register_string registration
- inc/seed.php             — activation seeding (pages, CPTs, menus, categories)
- assets/css/main.css      — full stylesheet
- assets/js/main.js        — JS i18n + scroll reveal + filter chips
- assets/images/*.png      — default hero, testimonial, programs, members
