<?php
if (!defined('ABSPATH')) exit;

/**
 * Polylang-aware text fetcher. Reads the *_ua mod and runs through pll__() if Polylang is active.
 */
function lum_get_text($key, $default = '') {
    $val = get_theme_mod($key . '_ua', $default);
    if (function_exists('pll__')) return pll__($val);
    return $val;
}

/**
 * Render UA text (HTML escaped). Translated via Polylang if active.
 */
function lum_ua($key, $default_ua = '') {
    echo esc_html(lum_get_text($key, $default_ua));
}

/**
 * Render text allowing inline HTML (br, em, span).
 */
function lum_html($key, $default_ua = '') {
    echo wp_kses(lum_get_text($key, $default_ua), [
        'br' => [], 'em' => [], 'strong' => [], 'span' => ['class' => true],
    ]);
}

/**
 * data-pl="..." attribute. Used by JS switcher only (no Polylang).
 * If Polylang is active, this is a no-op — Polylang handles translations natively.
 */
function lum_pl_attr($key, $default_pl = '') {
    if (function_exists('pll_current_language')) return;
    $pl = get_theme_mod($key . '_pl', $default_pl);
    if ($pl !== '') echo ' data-pl="' . esc_attr($pl) . '"';
}

/**
 * Get UA + PL pair as array (rarely needed).
 */
function lum_t($key, $default_ua = '', $default_pl = '') {
    return [
        'ua' => get_theme_mod($key . '_ua', $default_ua),
        'pl' => get_theme_mod($key . '_pl', $default_pl),
    ];
}

/**
 * Get a CPT meta value (without _lum_ prefix).
 */
function lum_meta($post_id, $field, $default = '') {
    $val = get_post_meta($post_id, '_lum_' . $field, true);
    return $val !== '' ? $val : $default;
}

/**
 * Polylang-powered language switcher.
 *
 * Renders Polylang's switcher when the plugin is active. Falls back to the
 * theme's own JS-based UA/PL toggle so the header keeps working before
 * Polylang has been installed/configured.
 *
 * Markup matches the original .lang-switch / .lang-btn structure so all
 * existing CSS keeps applying.
 */
function lum_render_language_switcher() {
    // Polylang active — render real cross-language permalinks.
    if ( function_exists( 'pll_the_languages' ) && function_exists( 'pll_current_language' ) ) {
        $langs = pll_the_languages( [
            'raw'              => 1,
            'hide_if_empty'    => 0,
            'display_names_as' => 'slug',
            'echo'             => 0,
        ] );
        if ( ! is_array( $langs ) || empty( $langs ) ) {
            return; // Polylang installed but no languages configured yet.
        }
        echo '<div class="lang-switch lang-switch--polylang">';
        $items = array_values( $langs );
        $count = count( $items );
        foreach ( $items as $i => $lang ) {
            $is_current = ! empty( $lang['current_lang'] );
            $no_trans   = ! empty( $lang['no_translation'] );
            $url        = $no_trans ? home_url( '/' ) : ( $lang['url'] ?? '#' );
            $slug       = isset( $lang['slug'] ) ? strtoupper( $lang['slug'] ) : '';
            $cls        = 'lang-btn' . ( $is_current ? ' lang-btn--active' : '' );
            printf(
                '<a class="%s" href="%s" hreflang="%s" lang="%s">%s</a>',
                esc_attr( $cls ),
                esc_url( $url ),
                esc_attr( $lang['locale'] ?? $lang['slug'] ?? '' ),
                esc_attr( $lang['locale'] ?? $lang['slug'] ?? '' ),
                esc_html( $slug )
            );
            if ( $i < $count - 1 ) {
                echo '<span class="lang-sep">/</span>';
            }
        }
        echo '</div>';
        return;
    }

    // Fallback — theme's own JS switcher (data-pl attributes drive it).
    ?>
    <div class="lang-switch">
        <button class="lang-btn lang-btn--active" data-lang="ua" type="button">UA</button>
        <span class="lang-sep">/</span>
        <button class="lang-btn" data-lang="pl" type="button">PL</button>
    </div>
    <?php
}
