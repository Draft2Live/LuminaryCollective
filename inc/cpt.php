<?php
if (!defined('ABSPATH')) exit;

/**
 * Register Custom Post Types: program, member, benefit, faq.
 * All non-public (not on frontend as singles) — used as data on home page.
 */
function lum_register_cpts() {
    register_post_type('lum_program', [
        'labels' => [
            'name' => __('Programs', 'luminary'),
            'singular_name' => __('Program', 'luminary'),
            'add_new_item' => __('Add Program', 'luminary'),
            'edit_item' => __('Edit Program', 'luminary'),
            'menu_name' => __('Programs', 'luminary'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'excerpt', 'thumbnail', 'page-attributes'],
        'has_archive' => false,
    ]);

    register_post_type('lum_member', [
        'labels' => [
            'name' => __('Members', 'luminary'),
            'singular_name' => __('Member', 'luminary'),
            'add_new_item' => __('Add Member', 'luminary'),
            'menu_name' => __('Members', 'luminary'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 22,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'thumbnail', 'page-attributes'],
        'has_archive' => false,
    ]);

    register_post_type('lum_benefit', [
        'labels' => [
            'name' => __('Benefits', 'luminary'),
            'singular_name' => __('Benefit', 'luminary'),
            'add_new_item' => __('Add Benefit', 'luminary'),
            'menu_name' => __('Benefits', 'luminary'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 23,
        'menu_icon' => 'dashicons-awards',
        'supports' => ['title', 'excerpt', 'page-attributes'],
        'has_archive' => false,
    ]);

    register_post_type('lum_faq', [
        'labels' => [
            'name' => __('FAQ', 'luminary'),
            'singular_name' => __('FAQ Item', 'luminary'),
            'add_new_item' => __('Add FAQ', 'luminary'),
            'menu_name' => __('FAQ', 'luminary'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 24,
        'menu_icon' => 'dashicons-format-chat',
        'supports' => ['title', 'editor', 'page-attributes'],
        'has_archive' => false,
    ]);
}
add_action('init', 'lum_register_cpts');

/**
 * Meta boxes: extra fields for each CPT.
 */
function lum_add_meta_boxes() {
    add_meta_box('lum_program_fields', __('Program Details', 'luminary'), 'lum_program_meta_box', 'lum_program', 'normal', 'high');
    add_meta_box('lum_member_fields', __('Member Details', 'luminary'), 'lum_member_meta_box', 'lum_member', 'normal', 'high');
    add_meta_box('lum_benefit_fields', __('Polish Translation', 'luminary'), 'lum_benefit_meta_box', 'lum_benefit', 'normal', 'high');
    add_meta_box('lum_faq_fields', __('Polish Translation', 'luminary'), 'lum_faq_meta_box', 'lum_faq', 'normal', 'high');
}
add_action('add_meta_boxes', 'lum_add_meta_boxes');

function lum_field_input($post_id, $key, $label, $type = 'text', $placeholder = '') {
    $val = get_post_meta($post_id, '_lum_' . $key, true);
    echo '<p style="margin-top:14px"><label style="display:block;font-weight:600;margin-bottom:4px">' . esc_html($label) . '</label>';
    if ($type === 'textarea') {
        echo '<textarea name="_lum_' . esc_attr($key) . '" rows="3" style="width:100%" placeholder="' . esc_attr($placeholder) . '">' . esc_textarea($val) . '</textarea>';
    } else {
        echo '<input type="text" name="_lum_' . esc_attr($key) . '" value="' . esc_attr($val) . '" style="width:100%" placeholder="' . esc_attr($placeholder) . '" />';
    }
    echo '</p>';
}

function lum_program_meta_box($post) {
    wp_nonce_field('lum_save_meta', 'lum_meta_nonce');
    echo '<p style="color:#666"><em>Tip: title above is the program name. Excerpt is the description. Featured image is the program photo. Below — extra fields and Polish translations.</em></p>';
    lum_field_input($post->ID, 'meta1_ua', __('Meta 1 (UA) — наприклад "6 місяців"', 'luminary'), 'text', '6 місяців');
    lum_field_input($post->ID, 'meta1_pl', __('Meta 1 (PL)', 'luminary'), 'text', '6 miesięcy');
    lum_field_input($post->ID, 'meta2_ua', __('Meta 2 (UA) — наприклад "Група з 12"', 'luminary'), 'text', 'Група з 12');
    lum_field_input($post->ID, 'meta2_pl', __('Meta 2 (PL)', 'luminary'), 'text', 'Grupa 12 osób');
    lum_field_input($post->ID, 'title_pl', __('Title (PL) — translation of the program name', 'luminary'));
    lum_field_input($post->ID, 'excerpt_pl', __('Description (PL)', 'luminary'), 'textarea');
    lum_field_input($post->ID, 'link_url', __('Link URL (optional)', 'luminary'), 'text', '#');
}

function lum_member_meta_box($post) {
    wp_nonce_field('lum_save_meta', 'lum_meta_nonce');
    echo '<p style="color:#666"><em>Title above is the member name. Featured image is the portrait.</em></p>';
    lum_field_input($post->ID, 'role_ua', __('Role (UA) — наприклад "COO · Meridian Capital"', 'luminary'));
    lum_field_input($post->ID, 'role_pl', __('Role (PL)', 'luminary'));
}

function lum_benefit_meta_box($post) {
    wp_nonce_field('lum_save_meta', 'lum_meta_nonce');
    echo '<p style="color:#666"><em>Title is the benefit name (UA). Excerpt is the description (UA). Below — Polish translations.</em></p>';
    lum_field_input($post->ID, 'title_pl', __('Title (PL)', 'luminary'));
    lum_field_input($post->ID, 'excerpt_pl', __('Description (PL)', 'luminary'), 'textarea');
}

function lum_faq_meta_box($post) {
    wp_nonce_field('lum_save_meta', 'lum_meta_nonce');
    echo '<p style="color:#666"><em>Title is the question (UA). Editor content is the answer (UA). Below — Polish translations.</em></p>';
    lum_field_input($post->ID, 'q_pl', __('Question (PL)', 'luminary'));
    lum_field_input($post->ID, 'a_pl', __('Answer (PL)', 'luminary'), 'textarea');
}

/**
 * Save meta boxes.
 */
function lum_save_meta($post_id) {
    if (!isset($_POST['lum_meta_nonce']) || !wp_verify_nonce($_POST['lum_meta_nonce'], 'lum_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $allowed = ['meta1_ua', 'meta1_pl', 'meta2_ua', 'meta2_pl', 'title_pl', 'excerpt_pl', 'link_url', 'role_ua', 'role_pl', 'q_pl', 'a_pl'];
    foreach ($allowed as $k) {
        $key = '_lum_' . $k;
        if (isset($_POST['_lum_' . $k])) {
            $val = $_POST['_lum_' . $k];
            $val = is_string($val) ? wp_kses_post(wp_unslash($val)) : '';
            update_post_meta($post_id, $key, $val);
        }
    }
}
add_action('save_post', 'lum_save_meta');
