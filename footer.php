<footer>
    <div class="footer-top">
        <div>
            <div class="footer-logo">
                <span<?php lum_pl_attr('logo_main', 'Luminary'); ?>><?php lum_ua('logo_main', 'Luminary'); ?></span> <em<?php lum_pl_attr('logo_sub', 'Collective'); ?>><?php lum_ua('logo_sub', 'Collective'); ?></em>
            </div>
            <p class="footer-blurb"<?php lum_pl_attr('footer_blurb', 'Luminary Collective. Zamknięta społeczność dla kobiet, które prowadzą firmy, kulturę i rozmowy swojego czasu. Zbieramy się, żeby iść dalej i precyzyjniej.'); ?>><?php lum_ua('footer_blurb', 'Luminary Collective. Закрита спільнота для жінок, які ведуть компанії, культуру й розмови свого часу. Ми збираємо одна одну, щоб рухатися далі й точніше.'); ?></p>
            <form class="newsletter" onsubmit="event.preventDefault()">
                <input type="email" placeholder="your@email.com" />
                <button type="submit"<?php lum_pl_attr('footer_news_btn', 'Zapisz się'); ?>><?php lum_ua('footer_news_btn', 'Підписатися'); ?></button>
            </form>
        </div>
        <div class="footer-col">
            <h4 data-pl="Społeczność">Спільнота</h4>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_community',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => 'lum_default_footer_community',
                'depth'          => 1,
                'items_wrap'     => '<ul>%3$s</ul>',
            ]);
            ?>
        </div>
        <div class="footer-col">
            <h4 data-pl="Dołączenie">Приєднатись</h4>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_join',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => 'lum_default_footer_join',
                'depth'          => 1,
                'items_wrap'     => '<ul>%3$s</ul>',
            ]);
            ?>
        </div>
        <div class="footer-col">
            <h4 data-pl="Kontakty">Контакти</h4>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer_contact',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => 'lum_default_footer_contact',
                'depth'          => 1,
                'items_wrap'     => '<ul>%3$s</ul>',
            ]);
            ?>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?php echo esc_html(date('Y')); ?> LUMINARY COLLECTIVE</span>
        <span<?php lum_pl_attr('footer_tag', 'RAZEM. CICHO, PRECYZYJNIE, W GÓRĘ'); ?>><?php lum_ua('footer_tag', 'РАЗОМ. ТИХО, ТОЧНО, ВГОРУ'); ?></span>
    </div>
</footer>

</div><!-- .page-frame -->

<?php wp_footer(); ?>
</body>
</html>
