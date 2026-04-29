<?php
/**
 * Generic page template — used for any Page that doesn't have a specific template.
 * (page-blog.php overrides this for the Blog page.)
 */
get_header();
while (have_posts()) : the_post(); ?>

<header class="page-header">
    <div class="page-header-inner">
        <div class="page-header-num"><?php _e('Page', 'luminary'); ?></div>
        <div>
            <h1 class="page-header-title"><?php the_title(); ?></h1>
        </div>
    </div>
</header>

<article class="page-content">
    <div class="page-content-inner">
        <?php if (has_post_thumbnail()) : ?>
            <div class="page-content-hero">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>
        <div class="page-content-body">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<?php endwhile;
get_footer();
