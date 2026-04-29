<?php
if (!defined('ABSPATH')) exit;

/**
 * Inject data-pl="…" attribute on each <a> from menu item meta `_lum_menu_pl`.
 */
function lum_nav_menu_link_attributes($atts, $item) {
    $pl = get_post_meta($item->ID, '_lum_menu_pl', true);
    if ($pl !== '') $atts['data-pl'] = esc_attr($pl);
    if (!isset($atts['class'])) $atts['class'] = '';
    $atts['class'] = trim($atts['class'] . ' nav-item');
    return $atts;
}
add_filter('nav_menu_link_attributes', 'lum_nav_menu_link_attributes', 10, 2);

/**
 * Add Polish-label field to the menu item editor.
 * (Available since WP 5.4 via wp_nav_menu_item_custom_fields hook.)
 */
function lum_menu_item_pl_field($item_id, $item) {
    $pl = get_post_meta($item_id, '_lum_menu_pl', true);
    ?>
    <p class="field-lum-pl description description-wide">
        <label for="lum-menu-pl-<?php echo esc_attr($item_id); ?>">
            <?php _e('Polish label (data-pl)', 'luminary'); ?><br>
            <input type="text"
                   id="lum-menu-pl-<?php echo esc_attr($item_id); ?>"
                   class="widefat code"
                   name="lum_menu_pl[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($pl); ?>" />
            <span class="description"><?php _e('Optional. Polish translation for this nav link. Used by the language switcher.', 'luminary'); ?></span>
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'lum_menu_item_pl_field', 10, 2);

/**
 * Save the Polish label.
 */
function lum_save_menu_item_pl($menu_id, $menu_item_db_id) {
    if (isset($_POST['lum_menu_pl'][$menu_item_db_id])) {
        $val = sanitize_text_field(wp_unslash($_POST['lum_menu_pl'][$menu_item_db_id]));
        if ($val === '') {
            delete_post_meta($menu_item_db_id, '_lum_menu_pl');
        } else {
            update_post_meta($menu_item_db_id, '_lum_menu_pl', $val);
        }
    }
}
add_action('wp_update_nav_menu_item', 'lum_save_menu_item_pl', 10, 2);

/**
 * Fallback when no menu is assigned to the 'primary' location.
 * Renders the same default nav with bilingual data-pl attributes.
 */
function lum_default_primary_menu() {
    $blog = get_page_by_path('blog');
    $blog_url = $blog ? get_permalink($blog) : home_url('/blog/');
    ?>
    <ul class="nav-links">
        <li><a href="<?php echo esc_url(home_url('/#programs')); ?>" class="nav-item" data-pl="Programy">Програми</a></li>
        <li><a href="#" class="nav-item" data-pl="Summity">Самміти</a></li>
        <li><a href="<?php echo esc_url(home_url('/#members')); ?>" class="nav-item" data-pl="Uczestniczki">Учасниці</a></li>
        <li><a href="<?php echo esc_url($blog_url); ?>" class="nav-item<?php if (is_home() || is_archive() || is_single() || (is_page() && get_post_field('post_name') === 'blog')) echo ' active'; ?>" data-pl="Historie">Історії</a></li>
        <li><a href="<?php echo esc_url(home_url('/#cta')); ?>" class="nav-item" data-pl="Dołączenie">Вступ</a></li>
    </ul>
    <?php
}

/**
 * Footer menu fallbacks — render hardcoded list when no menu is assigned.
 */
function lum_default_footer_community() {
    $blog = get_page_by_path('blog');
    $blog_url = $blog ? get_permalink($blog) : home_url('/blog/');
    ?>
    <ul>
        <li><a href="#" data-pl="Filozofia">Філософія</a></li>
        <li><a href="<?php echo esc_url(home_url('/#programs')); ?>" data-pl="Programy">Програми</a></li>
        <li><a href="<?php echo esc_url(home_url('/#members')); ?>" data-pl="Uczestniczki">Учасниці</a></li>
        <li><a href="<?php echo esc_url($blog_url); ?>" data-pl="Journal">Журнал</a></li>
    </ul>
    <?php
}

function lum_default_footer_join() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url(home_url('/#cta')); ?>" data-pl="Aplikacja">Заявка</a></li>
        <li><a href="#" data-pl="Kryteria selekcji">Критерії відбору</a></li>
        <li><a href="#" data-pl="Składka członkowska">Членський внесок</a></li>
        <li><a href="#" data-pl="Częste pytania">Часті питання</a></li>
    </ul>
    <?php
}

function lum_default_footer_contact() {
    ?>
    <ul>
        <li><a href="mailto:hello@luminarycollective.com">hello@luminarycollective.com</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">LinkedIn</a></li>
        <li><a href="#">Substack</a></li>
    </ul>
    <?php
}
