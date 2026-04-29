<?php get_header(); ?>

<header class="journal-header">
    <div class="journal-inner">
        <div class="journal-num"><?php _e('Search', 'luminary'); ?></div>
        <div>
            <div class="journal-eyebrow"><?php _e('Результати пошуку', 'luminary'); ?></div>
            <h1 class="journal-title">"<?php echo esc_html(get_search_query()); ?>"</h1>
        </div>
    </div>
</header>

<section class="articles">
    <div class="articles-grid">
        <?php if (have_posts()) :
            while (have_posts()) : the_post();
                $cats = get_the_category();
                $cat_name = !empty($cats) ? $cats[0]->name : '';
                ?>
                <article class="article">
                    <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;display:block">
                        <div class="article-meta">
                            <?php if ($cat_name) : ?><span class="cat"><?php echo esc_html($cat_name); ?></span><span class="sep">·</span><?php endif; ?>
                            <span class="date"><?php echo esc_html(get_the_date('j F Y')); ?></span>
                        </div>
                        <h2 class="article-title"><?php the_title(); ?></h2>
                        <p class="article-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p>
                    </a>
                </article>
            <?php endwhile;
        else : ?>
            <article class="article">
                <h2 class="article-title"><?php _e('Нічого не знайдено.', 'luminary'); ?></h2>
                <p class="article-excerpt"><?php _e('Спробуйте інший запит або перейдіть до журналу.', 'luminary'); ?></p>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
