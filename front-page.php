<?php get_header(); ?>

<!-- ============== HERO ============== -->
<section class="hero">
    <div class="vertical-text">
        <span<?php lum_pl_attr('vertical_1', 'QUIET'); ?>><?php lum_ua('vertical_1', 'QUIET'); ?></span>
        <span class="outlined"<?php lum_pl_attr('vertical_2', 'POWER'); ?>><?php lum_ua('vertical_2', 'POWER'); ?></span>
    </div>
    <div class="hero-subject"></div>
    <div class="hero-content">
        <span class="hero-eyebrow"<?php lum_pl_attr('hero_eyebrow', 'Zamknięty krąg kobiet liderek'); ?>><?php lum_ua('hero_eyebrow', 'Закрите коло жінок-лідерок'); ?></span>
        <h1>
            <span<?php lum_pl_attr('hero_h1_a', 'Nie czekamy na swój czas.'); ?>><?php lum_ua('hero_h1_a', 'Ми не чекаємо свого часу.'); ?></span><br>
            <em<?php lum_pl_attr('hero_h1_b', 'Kształtujemy go.'); ?>><?php lum_ua('hero_h1_b', 'Ми його формуємо.'); ?></em>
        </h1>
        <p class="hero-sub"<?php lum_pl_attr('hero_sub', ''); ?>><?php lum_ua('hero_sub', ''); ?></p>
    </div>
    <div class="testimonial-card">
        <div class="testimonial-thumb">
            <div class="play-icon"></div>
        </div>
        <div class="testimonial-label"<?php lum_pl_attr('tt_label', 'Głos uczestniczki'); ?>><?php lum_ua('tt_label', 'Голос учасниці'); ?></div>
        <div class="testimonial-quote"<?php lum_pl_attr('tt_quote', ''); ?>><?php lum_ua('tt_quote', ''); ?></div>
        <div class="social-row">
            <div class="social-dot">in</div>
            <div class="social-dot">ig</div>
            <div class="social-dot">x</div>
        </div>
    </div>
</section>

<!-- ============== PROGRAMS ============== -->
<section id="programs">
    <div class="section-head" data-num="01">
        <div class="section-eyebrow"<?php lum_pl_attr('progs_eyebrow', 'Co dzieje się w środku'); ?>><?php lum_ua('progs_eyebrow', 'Що відбувається всередині'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('progs_title_a', 'Nie konferencje.'); ?>><?php lum_ua('progs_title_a', 'Не конференції.'); ?></span><br>
            <em<?php lum_pl_attr('progs_title_b', 'Spotkania po istocie.'); ?>><?php lum_ua('progs_title_b', 'Зустрічі по суті.'); ?></em>
        </h2>
        <p class="section-sub"<?php lum_pl_attr('progs_sub', ''); ?>><?php lum_ua('progs_sub', ''); ?></p>
    </div>
    <div class="programs-grid">
        <?php
        $programs = new WP_Query([
            'post_type' => 'lum_program',
            'posts_per_page' => 4,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
        $i = 1;
        if ($programs->have_posts()) :
            while ($programs->have_posts()) : $programs->the_post();
                $pid = get_the_ID();
                $title_pl = get_post_meta($pid, '_lum_title_pl', true);
                $excerpt_pl = get_post_meta($pid, '_lum_excerpt_pl', true);
                $m1_ua = get_post_meta($pid, '_lum_meta1_ua', true);
                $m1_pl = get_post_meta($pid, '_lum_meta1_pl', true);
                $m2_ua = get_post_meta($pid, '_lum_meta2_ua', true);
                $m2_pl = get_post_meta($pid, '_lum_meta2_pl', true);
                $link  = get_post_meta($pid, '_lum_link_url', true) ?: '#';
                ?>
                <div class="program-card">
                    <div class="program-image pc-<?php echo $i; ?>"></div>
                    <div class="program-body">
                        <div class="program-meta">
                            <span<?php if ($m1_pl) echo ' data-pl="' . esc_attr($m1_pl) . '"'; ?>><?php echo esc_html($m1_ua); ?></span><span<?php if ($m2_pl) echo ' data-pl="' . esc_attr($m2_pl) . '"'; ?>><?php echo esc_html($m2_ua); ?></span>
                        </div>
                        <h3 class="program-title"<?php if ($title_pl) echo ' data-pl="' . esc_attr($title_pl) . '"'; ?>><?php the_title(); ?></h3>
                        <p class="program-desc"<?php if ($excerpt_pl) echo ' data-pl="' . esc_attr($excerpt_pl) . '"'; ?>><?php echo esc_html(get_the_excerpt()); ?></p>
                        <a href="<?php echo esc_url($link); ?>" class="program-link"<?php lum_pl_attr('progs_link', 'Dowiedz się więcej'); ?>><?php lum_ua('progs_link', 'Дізнатись більше'); ?></a>
                    </div>
                </div>
                <?php $i++;
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<!-- ============== QUOTE ============== -->
<section class="quote-section">
    <p class="big-quote"<?php lum_pl_attr('quote_text', ''); ?>><?php lum_ua('quote_text', ''); ?></p>
    <div class="quote-attr"<?php lum_pl_attr('quote_attr', ''); ?>><?php lum_ua('quote_attr', ''); ?></div>
</section>

<!-- ============== CRITERIA ============== -->
<section class="criteria-section">
    <div class="section-head" data-num="02">
        <div class="section-eyebrow"<?php lum_pl_attr('crit_eyebrow', 'Kryteria selekcji'); ?>><?php lum_ua('crit_eyebrow', 'Критерії відбору'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('crit_title_a', 'Kto siada'); ?>><?php lum_ua('crit_title_a', 'Хто сідає'); ?></span><br>
            <em<?php lum_pl_attr('crit_title_b', 'przy tym stole'); ?>><?php lum_ua('crit_title_b', 'за цей стіл'); ?></em>
        </h2>
    </div>
    <div class="criteria-grid">
        <div class="criteria-col yes">
            <h3<?php lum_pl_attr('crit_yes_h', 'To twoja przestrzeń, jeśli'); ?>><?php lum_ua('crit_yes_h', 'Це ваш простір, якщо'); ?></h3>
            <ul>
                <?php
                $yes_ua = explode("\n", get_theme_mod('crit_yes_items_ua', ''));
                $yes_pl = explode("\n", get_theme_mod('crit_yes_items_pl', ''));
                foreach ($yes_ua as $idx => $line) {
                    $line = trim($line);
                    if (!$line) continue;
                    $pl_line = isset($yes_pl[$idx]) ? trim($yes_pl[$idx]) : '';
                    echo '<li' . ($pl_line ? ' data-pl="' . esc_attr($pl_line) . '"' : '') . '>' . esc_html($line) . '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="criteria-col no">
            <h3<?php lum_pl_attr('crit_no_h', 'Jeszcze nie teraz, jeśli'); ?>><?php lum_ua('crit_no_h', 'Ще не час, якщо'); ?></h3>
            <ul>
                <?php
                $no_ua = explode("\n", get_theme_mod('crit_no_items_ua', ''));
                $no_pl = explode("\n", get_theme_mod('crit_no_items_pl', ''));
                foreach ($no_ua as $idx => $line) {
                    $line = trim($line);
                    if (!$line) continue;
                    $pl_line = isset($no_pl[$idx]) ? trim($no_pl[$idx]) : '';
                    echo '<li' . ($pl_line ? ' data-pl="' . esc_attr($pl_line) . '"' : '') . '>' . esc_html($line) . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</section>

<!-- ============== MEMBERS ============== -->
<section class="members-section" id="members">
    <div class="section-head" data-num="03">
        <div class="section-eyebrow"<?php lum_pl_attr('memb_eyebrow', 'Kogo tu spotkasz'); ?>><?php lum_ua('memb_eyebrow', 'Кого ви зустрінете'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('memb_title_a', 'Kobiety, przy których'); ?>><?php lum_ua('memb_title_a', 'Жінки, поруч із якими'); ?></span><br>
            <em<?php lum_pl_attr('memb_title_b', 'chce się rosnąć.'); ?>><?php lum_ua('memb_title_b', 'хочеться зростати.'); ?></em>
        </h2>
        <p class="section-sub"<?php lum_pl_attr('memb_sub', ''); ?>><?php lum_ua('memb_sub', ''); ?></p>
    </div>
    <div class="members-grid">
        <?php
        $members = new WP_Query([
            'post_type' => 'lum_member',
            'posts_per_page' => 12,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
        if ($members->have_posts()) :
            while ($members->have_posts()) : $members->the_post();
                $mid = get_the_ID();
                $role_ua = get_post_meta($mid, '_lum_role_ua', true);
                $role_pl = get_post_meta($mid, '_lum_role_pl', true);
                $img_url = get_the_post_thumbnail_url($mid, 'large');
                if (!$img_url) $img_url = get_post_meta($mid, '_lum_image_url', true);
                ?>
                <div class="member-card">
                    <?php if ($img_url) : ?><img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
                    <div class="member-overlay">
                        <div class="member-name"><?php the_title(); ?></div>
                        <div class="member-role"<?php if ($role_pl) echo ' data-pl="' . esc_attr($role_pl) . '"'; ?>><?php echo esc_html($role_ua); ?></div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</section>

<!-- ============== BENEFITS ============== -->
<section class="benefits-section">
    <div class="section-head" data-num="04">
        <div class="section-eyebrow"<?php lum_pl_attr('ben_eyebrow', 'Wewnątrz Collective'); ?>><?php lum_ua('ben_eyebrow', 'Всередині Collective'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('ben_title_a', 'To, co naprawdę'); ?>><?php lum_ua('ben_title_a', 'Те, що справді'); ?></span><br>
            <em<?php lum_pl_attr('ben_title_b', 'zmienia trajektorię'); ?>><?php lum_ua('ben_title_b', 'змінює траєкторію'); ?></em>
        </h2>
    </div>
    <div class="benefits-grid">
        <?php
        $benefits = new WP_Query([
            'post_type' => 'lum_benefit',
            'posts_per_page' => 12,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
        if ($benefits->have_posts()) :
            while ($benefits->have_posts()) : $benefits->the_post();
                $bid = get_the_ID();
                $t_pl = get_post_meta($bid, '_lum_title_pl', true);
                $d_pl = get_post_meta($bid, '_lum_excerpt_pl', true);
                ?>
                <div class="benefit">
                    <div class="benefit-dot"></div>
                    <h4<?php if ($t_pl) echo ' data-pl="' . esc_attr($t_pl) . '"'; ?>><?php the_title(); ?></h4>
                    <p<?php if ($d_pl) echo ' data-pl="' . esc_attr($d_pl) . '"'; ?>><?php echo esc_html(get_the_excerpt()); ?></p>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</section>

<!-- ============== FAQ ============== -->
<section class="faq-section">
    <div class="section-head" data-num="05">
        <div class="section-eyebrow"<?php lum_pl_attr('faq_eyebrow', 'Częste pytania'); ?>><?php lum_ua('faq_eyebrow', 'Часті питання'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('faq_title_a', 'Szczerze'); ?>><?php lum_ua('faq_title_a', 'Відверто'); ?></span><br>
            <em<?php lum_pl_attr('faq_title_b', 'o członkostwie'); ?>><?php lum_ua('faq_title_b', 'про членство'); ?></em>
        </h2>
    </div>
    <div class="faq-list">
        <?php
        $faqs = new WP_Query([
            'post_type' => 'lum_faq',
            'posts_per_page' => 30,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);
        if ($faqs->have_posts()) :
            while ($faqs->have_posts()) : $faqs->the_post();
                $fid = get_the_ID();
                $q_pl = get_post_meta($fid, '_lum_q_pl', true);
                $a_pl = get_post_meta($fid, '_lum_a_pl', true);
                ?>
                <div class="faq-item">
                    <div class="faq-q"<?php if ($q_pl) echo ' data-pl="' . esc_attr($q_pl) . '"'; ?>><?php the_title(); ?></div>
                    <div class="faq-a"<?php if ($a_pl) echo ' data-pl="' . esc_attr($a_pl) . '"'; ?>><?php echo esc_html(wp_strip_all_tags(get_the_content())); ?></div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</section>

<!-- ============== JOURNAL PREVIEW ============== -->
<section class="journal-section" id="stories">
    <div class="section-head" data-num="06">
        <div class="section-eyebrow"<?php lum_pl_attr('jrn_eyebrow', 'Luminary Journal'); ?>><?php lum_ua('jrn_eyebrow', 'Luminary Journal'); ?></div>
        <h2 class="section-title">
            <span<?php lum_pl_attr('jrn_title_a', 'Nie wykłady.'); ?>><?php lum_ua('jrn_title_a', 'Не лекції.'); ?></span><br>
            <em<?php lum_pl_attr('jrn_title_b', 'Materiały redakcyjne.'); ?>><?php lum_ua('jrn_title_b', 'Редакційні матеріали.'); ?></em>
        </h2>
        <p class="section-sub"<?php lum_pl_attr('jrn_sub', ''); ?>><?php lum_ua('jrn_sub', ''); ?></p>
    </div>
    <div class="journal-grid">
        <?php
        $journal_q = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3, 'post_status' => 'publish']);
        if ($journal_q->have_posts()) :
            while ($journal_q->have_posts()) : $journal_q->the_post();
                $cats = get_the_category();
                $cat_name = !empty($cats) ? $cats[0]->name : 'Journal';
                ?>
                <a href="<?php the_permalink(); ?>" class="journal-card">
                    <div class="j-meta">
                        <span class="j-cat"><?php echo esc_html($cat_name); ?></span>
                        <span class="j-sep">·</span>
                        <span><?php echo esc_html(luminary_reading_time()); ?> <?php _e('хв', 'luminary'); ?></span>
                    </div>
                    <h3 class="j-title"><?php the_title(); ?></h3>
                    <p class="j-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
            <p style="opacity:0.6"><?php _e('Поки жодного запису в журналі. Опублікуйте перший у Posts → Add New.', 'luminary'); ?></p>
        <?php endif; ?>
    </div>
    <?php $blog = get_page_by_path('blog'); ?>
    <div class="journal-more">
        <a href="<?php echo $blog ? esc_url(get_permalink($blog)) : '#'; ?>"<?php lum_pl_attr('jrn_more', 'Otwórz journal →'); ?>><?php lum_ua('jrn_more', 'Відкрити журнал →'); ?></a>
    </div>
</section>

<!-- ============== FINAL CTA ============== -->
<section class="cta-section" id="cta">
    <div class="cta-eyebrow"<?php lum_pl_attr('cta_eyebrow', 'Złóż aplikację'); ?>><?php lum_ua('cta_eyebrow', 'Подати заявку'); ?></div>
    <h2 class="cta-headline">
        <span<?php lum_pl_attr('cta_headline_a', '"Stół jest nakryty.'); ?>><?php lum_ua('cta_headline_a', '"Стіл накритий.'); ?></span><br>
        <span<?php lum_pl_attr('cta_headline_b', 'Miejsce należy do ciebie."'); ?>><?php lum_ua('cta_headline_b', 'Місце за вами."'); ?></span>
    </h2>
    <p class="cta-sub"<?php lum_pl_attr('cta_sub', ''); ?>><?php lum_ua('cta_sub', ''); ?></p>
    <button class="cta-big-button"<?php lum_pl_attr('cta_button', 'Zostaw aplikację'); ?>><?php lum_ua('cta_button', 'Залишити заявку'); ?></button>
    <div class="cta-secondary"<?php lum_pl_attr('cta_secondary', 'Rozpatrzenie aplikacji do 7 dni'); ?>><?php lum_ua('cta_secondary', 'Розгляд заявок до 7 днів'); ?></div>
</section>

<?php get_footer(); ?>
