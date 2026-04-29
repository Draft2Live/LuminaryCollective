<?php
/**
 * Template Name: Luminary Journal
 * Blog listing page. Assign to a page with slug "blog".
 */
get_header();
?>

<header class="journal-header">
    <div class="journal-inner">
        <div class="journal-num">Journal</div>
        <div>
            <div class="journal-eyebrow"<?php lum_pl_attr('jrn_eyebrow', 'Luminary Journal'); ?>><?php lum_ua('jrn_eyebrow', 'Luminary Journal'); ?></div>
            <h1 class="journal-title">
                <span<?php lum_pl_attr('jrn_title_a', 'Spojrzenie od środka.'); ?>><?php lum_ua('jrn_title_a', 'Погляд зсередини.'); ?></span><br>
                <em<?php lum_pl_attr('jrn_title_b', 'Bez patosu.'); ?>><?php lum_ua('jrn_title_b', 'Без пафосу.'); ?></em>
            </h1>
            <p class="journal-sub"<?php lum_pl_attr('jrn_sub', ''); ?>><?php lum_ua('jrn_sub', ''); ?></p>
        </div>
    </div>
</header>

<?php
$cats = get_categories(['hide_empty' => false, 'orderby' => 'name']);
if (!empty($cats)) : ?>
<section class="filters">
    <div class="filters-inner">
        <button class="chip chip--active" data-filter="all"><?php _e('Усі', 'luminary'); ?></button>
        <?php foreach ($cats as $c) : if ($c->slug === 'uncategorized') continue; ?>
            <button class="chip" data-filter="<?php echo esc_attr($c->slug); ?>"><?php echo esc_html($c->name); ?></button>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<section class="articles">
    <div class="articles-grid">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $q = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'paged'          => $paged,
        ]);

        if ($q->have_posts()) :
            while ($q->have_posts()) : $q->the_post();
                $cats = get_the_category();
                $tags = get_the_tags();
                $primary_cat = !empty($cats) ? $cats[0] : null;
                ?>
                <article class="article" data-cat="<?php echo $primary_cat ? esc_attr($primary_cat->slug) : ''; ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="article-thumb"><?php the_post_thumbnail('medium_large'); ?></a>
                    <?php endif; ?>
                    <div class="article-meta">
                        <?php if ($primary_cat) : ?>
                            <a href="<?php echo esc_url(get_category_link($primary_cat)); ?>" class="cat" style="color:inherit;text-decoration:none"><?php echo esc_html($primary_cat->name); ?></a>
                            <span class="sep">·</span>
                        <?php endif; ?>
                        <span class="date"><?php echo esc_html(get_the_date('j F Y')); ?></span>
                        <span class="sep">·</span>
                        <span class="read"><?php echo esc_html(luminary_reading_time()); ?> <?php _e('хв', 'luminary'); ?></span>
                    </div>
                    <h2 class="article-title">
                        <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none"><?php the_title(); ?></a>
                    </h2>
                    <p class="article-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p>
                    <div class="article-footer">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="article-author" style="color:inherit;text-decoration:none">
                            <?php
                            $author = get_the_author();
                            $role = get_the_author_meta('description');
                            echo esc_html($author);
                            if ($role) echo ' · ' . esc_html($role);
                            ?>
                        </a>
                        <?php if ($tags) : ?>
                            <div class="article-tags">
                                <?php foreach (array_slice($tags, 0, 3) as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="tag-chip">#<?php echo esc_html($tag->name); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile;

            echo '<div class="articles-pagination">';
            echo paginate_links([
                'total'     => $q->max_num_pages,
                'current'   => $paged,
                'prev_text' => __('← Новіші', 'luminary'),
                'next_text' => __('Старіші →', 'luminary'),
                'mid_size'  => 1,
            ]);
            echo '</div>';
            wp_reset_postdata();
        else : ?>
            <article class="article">
                <div class="article-meta"><span class="cat">Journal</span></div>
                <h2 class="article-title"><?php _e('Поки жодної статті.', 'luminary'); ?></h2>
                <p class="article-excerpt"><?php _e('Перша публікація зʼявиться тут. Опублікуйте запис у WP admin → Записи.', 'luminary'); ?></p>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
