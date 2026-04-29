<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $cats = get_the_category();
    $cat_name = !empty($cats) ? $cats[0]->name : '';
    $cat_link = !empty($cats) ? get_category_link($cats[0]->term_id) : '';
?>

<header class="journal-header">
    <div class="journal-inner">
        <div class="journal-num">
            <?php if ($cat_link) : ?>
                <a href="<?php echo esc_url($cat_link); ?>" style="color:inherit;text-decoration:none"><?php echo esc_html($cat_name); ?></a>
            <?php else : ?>
                <?php _e('Journal', 'luminary'); ?>
            <?php endif; ?>
        </div>
        <div>
            <div class="journal-eyebrow">
                <?php echo esc_html(get_the_date('j F Y')); ?>
                <span style="opacity:0.5"> · </span>
                <?php echo esc_html(luminary_reading_time()); ?> <?php _e('хв', 'luminary'); ?>
            </div>
            <h1 class="journal-title"><?php the_title(); ?></h1>
            <p class="journal-sub" style="margin-top: 32px; font-style: italic; color: #8B7355;">
                <?php
                $author = get_the_author();
                $role = get_the_author_meta('description');
                echo esc_html($author);
                if ($role) echo ' · ' . esc_html($role);
                ?>
            </p>
        </div>
    </div>
</header>

<article class="single-article">
    <div class="single-article-inner">
        <?php if (has_post_thumbnail()) : ?>
            <div class="single-article-hero">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <div class="single-article-body">
            <?php the_content(); ?>
        </div>

        <footer class="single-article-meta">
            <?php
            $cats_list = get_the_category_list(', ');
            $tags_list = get_the_tag_list('', ', ');
            ?>
            <?php if ($cats_list) : ?>
                <div class="single-article-taxrow">
                    <span class="single-article-tax-label"><?php _e('Категорія', 'luminary'); ?></span>
                    <span class="single-article-tax-value"><?php echo $cats_list; ?></span>
                </div>
            <?php endif; ?>
            <?php if ($tags_list) : ?>
                <div class="single-article-taxrow">
                    <span class="single-article-tax-label"><?php _e('Теги', 'luminary'); ?></span>
                    <span class="single-article-tax-value"><?php echo $tags_list; ?></span>
                </div>
            <?php endif; ?>
            <div class="single-article-taxrow">
                <span class="single-article-tax-label"><?php _e('Автор', 'luminary'); ?></span>
                <span class="single-article-tax-value">
                    <?php
                    $author_url = get_author_posts_url(get_the_author_meta('ID'));
                    ?>
                    <a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html(get_the_author()); ?></a>
                    <?php if ($bio = get_the_author_meta('description')) : ?>
                        <span class="single-article-author-bio"><?php echo esc_html($bio); ?></span>
                    <?php endif; ?>
                </span>
            </div>
            <div class="single-article-taxrow">
                <span class="single-article-tax-label"><?php _e('Опубліковано', 'luminary'); ?></span>
                <span class="single-article-tax-value"><time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('j F Y')); ?></time></span>
            </div>
        </footer>
    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>
