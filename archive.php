<?php get_header(); ?>

<header class="journal-header">
    <div class="journal-inner">
        <div class="journal-num"><?php
            if (is_category()) echo single_cat_title('', false);
            elseif (is_tag()) echo single_tag_title('', false);
            elseif (is_author()) echo get_the_author();
            else _e('Archive', 'luminary');
        ?></div>
        <div>
            <div class="journal-eyebrow"><?php
                if (is_category()) _e('Категорія', 'luminary');
                elseif (is_tag()) _e('Тег', 'luminary');
                elseif (is_author()) _e('Автор', 'luminary');
                else _e('Журнал', 'luminary');
            ?></div>
            <h1 class="journal-title"><?php
                if (is_category()) single_cat_title();
                elseif (is_tag()) single_tag_title();
                elseif (is_author()) the_archive_title();
                else the_archive_title();
            ?></h1>
            <?php if (get_the_archive_description()) : ?>
                <p class="journal-sub"><?php echo wp_kses_post(get_the_archive_description()); ?></p>
            <?php endif; ?>
        </div>
    </div>
</header>

<section class="articles">
    <div class="articles-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $cats = get_the_category();
                $tags = get_the_tags();
                $primary_cat = !empty($cats) ? $cats[0] : null;
                ?>
                <article class="article">
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

            the_posts_pagination([
                'prev_text' => __('← Новіші', 'luminary'),
                'next_text' => __('Старіші →', 'luminary'),
                'mid_size'  => 1,
            ]);
        else : ?>
            <article class="article">
                <h2 class="article-title"><?php _e('Поки нічого не знайдено.', 'luminary'); ?></h2>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
