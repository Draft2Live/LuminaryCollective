<?php
if (!defined('ABSPATH')) exit;

require_once get_template_directory() . '/inc/template-helpers.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/menu.php';
require_once get_template_directory() . '/inc/polylang.php';
require_once get_template_directory() . '/inc/seed.php';

/**
 * Theme setup
 */
function luminary_setup() {
    load_theme_textdomain('luminary', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('automatic-feed-links');

    register_nav_menus([
        'primary' => __('Primary (header)', 'luminary'),
        'footer_community' => __('Footer column 1: Community', 'luminary'),
        'footer_join' => __('Footer column 2: Join', 'luminary'),
        'footer_contact' => __('Footer column 3: Contact', 'luminary'),
    ]);
}
add_action('after_setup_theme', 'luminary_setup');

/**
 * Body class — flag if Polylang is active so JS skips its own i18n.
 */
function luminary_body_class($classes) {
    if (function_exists('pll_current_language')) {
        $classes[] = 'lum-polylang-active';
    }
    return $classes;
}
add_filter('body_class', 'luminary_body_class');

/**
 * Enqueue styles and scripts
 */
function luminary_assets() {
    wp_enqueue_style('luminary-fonts-google', 'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,200;0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,300;1,9..144,400&display=swap', [], null);
    wp_enqueue_style('luminary-fonts-satoshi', 'https://api.fontshare.com/v2/css?f[]=satoshi@300,400,500,600,700&display=swap', [], null);
    wp_enqueue_style('luminary-main', get_template_directory_uri() . '/assets/css/main.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_script('luminary-main', get_template_directory_uri() . '/assets/js/main.js', [], wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'luminary_assets');

/**
 * Inject dynamic background-images for hero/testimonial/programs
 * (so .hero-subject, .testimonial-thumb and .pc-1..4 can use admin-uploaded images).
 */
function luminary_dynamic_styles() {
    $css = '';

    if ($img = get_theme_mod('hero_image')) {
        $css .= '.hero-subject{background-image:url(' . esc_url($img) . ') !important;}';
    }
    if ($tt = get_theme_mod('testimonial_image')) {
        $css .= '.testimonial-thumb{background-image:url(' . esc_url($tt) . ') !important;}';
    }

    $programs = get_posts([
        'post_type' => 'lum_program',
        'numberposts' => 4,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);
    foreach ($programs as $i => $p) {
        $thumb = get_the_post_thumbnail_url($p->ID, 'large');
        if (!$thumb) {
            $thumb = get_post_meta($p->ID, '_lum_image_url', true);
        }
        if ($thumb) {
            $css .= '.pc-' . ($i + 1) . '{background-image:url(' . esc_url($thumb) . ') !important;}';
        }
    }

    if ($css) {
        echo "<style id=\"luminary-dynamic\">{$css}</style>\n";
    }
}
add_action('wp_head', 'luminary_dynamic_styles', 99);

/**
 * Excerpt
 */
function luminary_excerpt_length() { return 22; }
add_filter('excerpt_length', 'luminary_excerpt_length');

function luminary_excerpt_more() { return '…'; }
add_filter('excerpt_more', 'luminary_excerpt_more');

/**
 * Reading time
 */
function luminary_reading_time($content = null) {
    if ($content === null) $content = get_post_field('post_content', get_the_ID());
    $words = str_word_count(wp_strip_all_tags($content));
    return max(1, (int) ceil($words / 200));
}
