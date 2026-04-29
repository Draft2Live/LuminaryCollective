<?php
if (!defined('ABSPATH')) exit;

/**
 * Polylang integration.
 *
 * When Polylang is active:
 *   - All Customizer text values are registered via pll_register_string().
 *     Translate them in: Languages → Strings translations (group: "Women Leadership").
 *   - lum_ua() outputs translated text via pll__() automatically.
 *   - lum_pl_attr() becomes a no-op (Polylang serves the right language directly,
 *     so JS data-pl swap is unnecessary).
 *   - Header switcher renders pll_the_languages() instead of UA/PL buttons.
 *   - Each Page (Home, Journal, About...) and CPT entry can be duplicated per language
 *     from the WP admin (Polylang adds a "+" icon next to each post).
 *
 * When Polylang is NOT active: theme falls back to the JS data-pl switcher.
 */

function lum_pll_active() {
    return function_exists('pll_register_string') && function_exists('pll__');
}

/**
 * Register all theme_mod *_ua values as translatable strings in Polylang.
 */
function lum_pll_register_strings() {
    if (!lum_pll_active()) return;

    $keys = [
        // Branding
        'logo_main', 'logo_sub',
        // Hero
        'vertical_1', 'vertical_2', 'hero_eyebrow', 'hero_h1_a', 'hero_h1_b', 'hero_sub',
        // Testimonial
        'tt_label', 'tt_quote',
        // Nav
        'nav_programs', 'nav_summits', 'nav_members', 'nav_stories', 'nav_join', 'cta_apply',
        // Programs section
        'progs_eyebrow', 'progs_title_a', 'progs_title_b', 'progs_sub', 'progs_link',
        // Quote
        'quote_text', 'quote_attr',
        // Criteria
        'crit_eyebrow', 'crit_title_a', 'crit_title_b', 'crit_yes_h', 'crit_yes_items', 'crit_no_h', 'crit_no_items',
        // Members
        'memb_eyebrow', 'memb_title_a', 'memb_title_b', 'memb_sub',
        // Benefits
        'ben_eyebrow', 'ben_title_a', 'ben_title_b',
        // FAQ
        'faq_eyebrow', 'faq_title_a', 'faq_title_b',
        // Journal
        'jrn_eyebrow', 'jrn_title_a', 'jrn_title_b', 'jrn_sub', 'jrn_more',
        // Final CTA
        'cta_eyebrow', 'cta_headline_a', 'cta_headline_b', 'cta_sub', 'cta_button', 'cta_secondary',
        // Footer
        'footer_blurb', 'footer_news_btn', 'footer_tag',
    ];
    $multiline = ['hero_sub', 'tt_quote', 'progs_sub', 'quote_text', 'crit_yes_items', 'crit_no_items', 'memb_sub', 'jrn_sub', 'cta_sub', 'footer_blurb'];
    foreach ($keys as $k) {
        $val = get_theme_mod($k . '_ua', '');
        if ($val !== '') {
            pll_register_string($k, $val, 'Women Leadership', in_array($k, $multiline, true));
        }
    }
}
add_action('init', 'lum_pll_register_strings', 20);

// Switcher rendering lives in inc/template-helpers.php → lum_render_language_switcher()
