<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://api.fontshare.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="page-frame">

<nav class="top-nav">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
        <span<?php lum_pl_attr('logo_main', 'Luminary'); ?>><?php lum_ua('logo_main', 'Luminary'); ?></span> <span class="italic-word"<?php lum_pl_attr('logo_sub', 'Collective'); ?>><?php lum_ua('logo_sub', 'Collective'); ?></span>
    </a>
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'nav-links',
        'fallback_cb'    => 'lum_default_primary_menu',
        'depth'          => 1,
    ]);
    ?>
    <div class="nav-right">
        <?php lum_render_language_switcher(); ?>
        <a href="<?php echo esc_url(home_url('/#cta')); ?>" class="cta-pill"<?php lum_pl_attr('cta_apply', 'Złóż aplikację'); ?>><?php lum_ua('cta_apply', 'Подати заявку'); ?></a>
    </div>
</nav>
