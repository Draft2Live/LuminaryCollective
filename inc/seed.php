<?php
if (!defined('ABSPATH')) exit;

/**
 * On theme activation: seed default CPT items so the site has working content out of the box.
 * Uses an option flag to avoid double-seeding on reactivation.
 */
function lum_seed_content() {
    if (get_option('lum_seeded_v1')) return;

    $base = get_template_directory_uri() . '/assets/images';

    // Programs
    $programs = [
        [
            'title' => 'Mastermind',
            'title_pl' => 'Mastermind',
            'excerpt' => 'Замкнене коло з одинадцяти рівних. Щотижнева відповідальність, два ретрити, живі робочі кейси. Ви приходите з питанням, виходите з рішенням і одинадцятьма союзницями.',
            'excerpt_pl' => 'Zamknięty krąg jedenastu równych sobie. Cotygodniowa odpowiedzialność, dwa zjazdy, praca na żywych przypadkach. Wchodzisz z pytaniem, wychodzisz z decyzją i jedenastoma sojuszniczkami.',
            'meta1_ua' => '6 місяців', 'meta1_pl' => '6 miesięcy',
            'meta2_ua' => 'Група з 12', 'meta2_pl' => 'Grupa 12 osób',
            'image' => $base . '/program-mastermind.png',
        ],
        [
            'title' => 'Private Mentorship',
            'title_pl' => 'Private Mentorship',
            'excerpt' => 'Senior-менторка, яка вже пройшла саме ваш поворот і памʼятає його в деталях. Щомісячні сесії та відкритий канал між ними для розмов, які не ведуть на загал.',
            'excerpt_pl' => 'Senior mentorka, która przeszła dokładnie ten zakręt co ty i pamięta go w szczegółach. Comiesięczne sesje oraz otwarty kanał pomiędzy nimi, dla rozmów, które nie wychodzą na zewnątrz.',
            'meta1_ua' => '12 місяців', 'meta1_pl' => '12 miesięcy',
            'meta2_ua' => 'Один на один', 'meta2_pl' => 'Jeden na jeden',
            'image' => $base . '/program-mentorship.png',
        ],
        [
            'title' => 'Executive Circle',
            'title_pl' => 'Executive Circle',
            'excerpt' => 'Для тих, хто вже на вершині й озирається на наступне покоління. Розмови про владу, спадкоємність і legacy. За зачиненими дверима, між рівними.',
            'excerpt_pl' => 'Dla tych, które są już na szczycie i patrzą na kolejne pokolenie. Rozmowy o władzy, sukcesji i legacy. Za zamkniętymi drzwiami, między równymi.',
            'meta1_ua' => 'Безстрокове членство', 'meta1_pl' => 'Członkostwo bezterminowe',
            'meta2_ua' => 'C-suite', 'meta2_pl' => 'C-suite',
            'image' => $base . '/program-executive.png',
        ],
        [
            'title' => 'Founders Lab',
            'title_pl' => 'Founders Lab',
            'excerpt' => 'Operator clinics, закриті зустрічі з інвесторами, робота над реальними пітчами й наймами. Кімнати, до яких зазвичай потрапляєш за рекомендацією. Тут ви вже всередині.',
            'excerpt_pl' => 'Operator clinics, zamknięte spotkania z inwestorami, praca nad realnymi pitchami i rekrutacjami. Pokoje, do których zwykle wchodzi się z polecenia. Tu jesteś już w środku.',
            'meta1_ua' => '9 місяців', 'meta1_pl' => '9 miesięcy',
            'meta2_ua' => 'Засновниці seed–Series B', 'meta2_pl' => 'Założycielki seed–Series B',
            'image' => $base . '/program-founders.png',
        ],
    ];
    foreach ($programs as $i => $p) {
        $id = wp_insert_post([
            'post_title' => $p['title'],
            'post_excerpt' => $p['excerpt'],
            'post_status' => 'publish',
            'post_type' => 'lum_program',
            'menu_order' => $i,
        ]);
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_lum_title_pl', $p['title_pl']);
            update_post_meta($id, '_lum_excerpt_pl', $p['excerpt_pl']);
            update_post_meta($id, '_lum_meta1_ua', $p['meta1_ua']);
            update_post_meta($id, '_lum_meta1_pl', $p['meta1_pl']);
            update_post_meta($id, '_lum_meta2_ua', $p['meta2_ua']);
            update_post_meta($id, '_lum_meta2_pl', $p['meta2_pl']);
            update_post_meta($id, '_lum_link_url', '#');
            // Image as URL stored — frontend will use it as background-image
            update_post_meta($id, '_lum_image_url', $p['image']);
        }
    }

    // Members
    $members = [
        ['name' => 'Amara Okafor', 'role_ua' => 'COO · Meridian Capital', 'role_pl' => 'COO · Meridian Capital', 'image' => $base . '/member-1.png'],
        ['name' => 'Sofía Navarro-Ruiz', 'role_ua' => 'Co-founder & CEO · Lumen Bioscience', 'role_pl' => 'Co-founder & CEO · Lumen Bioscience', 'image' => $base . '/member-2.png'],
        ['name' => 'Катерина Беркут', 'role_ua' => 'Managing Partner · North Star Ventures', 'role_pl' => 'Managing Partner · North Star Ventures', 'image' => $base . '/member-3.png'],
        ['name' => 'Naomi Tanaka', 'role_ua' => 'Global Creative Director · Orene Atelier', 'role_pl' => 'Global Creative Director · Orene Atelier', 'image' => $base . '/member-4.png'],
    ];
    foreach ($members as $i => $m) {
        $id = wp_insert_post([
            'post_title' => $m['name'],
            'post_status' => 'publish',
            'post_type' => 'lum_member',
            'menu_order' => $i,
        ]);
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_lum_role_ua', $m['role_ua']);
            update_post_meta($id, '_lum_role_pl', $m['role_pl']);
            update_post_meta($id, '_lum_image_url', $m['image']);
        }
    }

    // Benefits
    $benefits = [
        ['t' => 'Приватний канал', 't_pl' => 'Prywatny kanał', 'd' => 'Закритий чат без скриншотів, де ставлять питання, які не ставлять публічно.', 'd_pl' => 'Zamknięty czat bez zrzutów ekranu, w którym zadaje się pytania, których nie zadaje się publicznie.'],
        ['t' => 'Річний самміт', 't_pl' => 'Doroczny summit', 'd' => 'Три дні офлайн у камерному форматі: робочі сесії, розмови один на один, тиша.', 'd_pl' => 'Trzy dni offline w kameralnym formacie: sesje robocze, rozmowy jeden na jeden, cisza.'],
        ['t' => 'Доступ до менторок', 't_pl' => 'Dostęp do mentorek', 'd' => 'Прямий контакт із жінками, які пройшли масштаб, екзити, кризи управління.', 'd_pl' => 'Bezpośredni kontakt z kobietami, które przeszły skalę, exity i kryzysy zarządcze.'],
        ['t' => 'Резиденції', 't_pl' => 'Rezydencje', 'd' => 'Короткі виїзди в Європі для глибокої роботи над конкретним запитом або рішенням.', 'd_pl' => 'Krótkie wyjazdy w Europie, głęboka praca nad konkretnym pytaniem lub decyzją.'],
        ['t' => 'Інвесторські кола', 't_pl' => 'Kręgi inwestorskie', 'd' => 'Зустрічі з LP, фондами і бізнес-ангелками всередині спільноти, без пітч-театру.', 'd_pl' => 'Spotkania z LP, funduszami i aniołami biznesu wewnątrz społeczności, bez pitch-teatru.'],
        ['t' => 'Партнерські умови', 't_pl' => 'Warunki partnerskie', 'd' => 'Юридичні, фінансові, психотерапевтичні сервіси на закритих для учасниць умовах.', 'd_pl' => 'Usługi prawne, finansowe i psychoterapeutyczne na zamkniętych dla uczestniczek warunkach.'],
    ];
    foreach ($benefits as $i => $b) {
        $id = wp_insert_post([
            'post_title' => $b['t'],
            'post_excerpt' => $b['d'],
            'post_status' => 'publish',
            'post_type' => 'lum_benefit',
            'menu_order' => $i,
        ]);
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_lum_title_pl', $b['t_pl']);
            update_post_meta($id, '_lum_excerpt_pl', $b['d_pl']);
        }
    }

    // FAQ
    $faqs = [
        ['q' => 'Скільки це коштує?', 'q_pl' => 'Ile to kosztuje?', 'a' => 'Вартість членства обговорюємо індивідуально після першої розмови. Вона залежить від програми і формату участі, і ми говоримо про це відкрито.', 'a_pl' => 'Koszt członkostwa omawiamy indywidualnie po pierwszej rozmowie. Zależy od programu i formatu udziału, mówimy o tym otwarcie.'],
        ['q' => 'Як проходить відбір?', 'q_pl' => 'Jak wygląda selekcja?', 'a' => 'Заявка, коротка розмова з командою, потім знайомство з двома діючими учасницями. Повний цикл займає два-три тижні.', 'a_pl' => 'Aplikacja, krótka rozmowa z zespołem, następnie poznanie dwóch aktywnych uczestniczek. Cały cykl zajmuje dwa do trzech tygodni.'],
        ['q' => 'А якщо я не встигатиму брати активну участь?', 'q_pl' => 'A jeśli nie zdążę aktywnie uczestniczyć?', 'a' => 'Від вас очікують присутності на ключових подіях року. Решта форматів опціональна, і багато учасниць включаються хвилями, залежно від циклу в бізнесі.', 'a_pl' => 'Oczekujemy obecności na kluczowych wydarzeniach roku. Reszta formatów jest opcjonalna, wiele uczestniczek włącza się falami, zależnie od cyklu w biznesie.'],
        ['q' => 'Англійська обовʼязкова?', 'q_pl' => 'Czy angielski jest obowiązkowy?', 'a' => 'Основна мова спільноти українська. Частина резиденцій і зустрічей з міжнародними гостями проходить англійською, вільне володіння бажане, але не критичне.', 'a_pl' => 'Podstawowym językiem społeczności jest polski. Część rezydencji i spotkań z gośćmi międzynarodowymi odbywa się po angielsku, swobodna znajomość jest mile widziana, ale nie krytyczna.'],
        ['q' => 'Це ще одна "жіноча" тусовка?', 'q_pl' => 'Czy to kolejna "kobieca" tusowka?', 'a' => 'Ні. Тут немає мотиваційних спікерок, рожевих панелей і розмов про баланс. Є жінки, які оперують бюджетами і ризиками на тому ж рівні, що й ви.', 'a_pl' => 'Nie. Nie ma tu mówczyń motywacyjnych, różowych paneli ani rozmów o balansie. Są kobiety, które operują budżetami i ryzykami na tym samym poziomie co ty.'],
    ];
    foreach ($faqs as $i => $f) {
        $id = wp_insert_post([
            'post_title' => $f['q'],
            'post_content' => $f['a'],
            'post_status' => 'publish',
            'post_type' => 'lum_faq',
            'menu_order' => $i,
        ]);
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_lum_q_pl', $f['q_pl']);
            update_post_meta($id, '_lum_a_pl', $f['a_pl']);
        }
    }

    // Default categories
    $cats = ['Leadership', 'Power', 'Craft', 'Rituals', 'Money', 'Culture'];
    foreach ($cats as $name) {
        if (!term_exists($name, 'category')) wp_insert_term($name, 'category');
    }

    // Blog page
    $page = get_page_by_path('blog');
    if (!$page) {
        wp_insert_post([
            'post_title' => 'Journal',
            'post_name' => 'blog',
            'post_status' => 'publish',
            'post_type' => 'page',
            'page_template' => 'page-blog.php',
        ]);
    }

    // Home page (set as front)
    $home = get_page_by_path('home');
    if (!$home) {
        $home_id = wp_insert_post([
            'post_title' => 'Home',
            'post_name' => 'home',
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
        if ($home_id && !is_wp_error($home_id)) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home_id);
            $blog_p = get_page_by_path('blog');
            if ($blog_p) update_option('page_for_posts', $blog_p->ID);
        }
    }

    // ============ MENUS ============
    $blog_p = get_page_by_path('blog');
    $blog_url = $blog_p ? get_permalink($blog_p) : home_url('/blog/');
    $locations = get_theme_mod('nav_menu_locations');
    if (!is_array($locations)) $locations = [];

    $seed_menu = function($name, $location, $items) use (&$locations) {
        $existing = wp_get_nav_menu_object($name);
        if ($existing) {
            $locations[$location] = $existing->term_id;
            return;
        }
        $menu_id = wp_create_nav_menu($name);
        if (is_wp_error($menu_id)) return;
        foreach ($items as $i => $it) {
            $item_id = wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title'    => $it['title'],
                'menu-item-url'      => $it['url'],
                'menu-item-status'   => 'publish',
                'menu-item-position' => $i + 1,
            ]);
            if (!is_wp_error($item_id) && !empty($it['pl'])) {
                update_post_meta($item_id, '_lum_menu_pl', $it['pl']);
            }
        }
        $locations[$location] = $menu_id;
    };

    $seed_menu('Primary', 'primary', [
        ['title' => 'Програми', 'url' => home_url('/#programs'), 'pl' => 'Programy'],
        ['title' => 'Самміти', 'url' => '#', 'pl' => 'Summity'],
        ['title' => 'Учасниці', 'url' => home_url('/#members'), 'pl' => 'Uczestniczki'],
        ['title' => 'Історії', 'url' => $blog_url, 'pl' => 'Historie'],
        ['title' => 'Вступ', 'url' => home_url('/#cta'), 'pl' => 'Dołączenie'],
    ]);

    $seed_menu('Footer Community', 'footer_community', [
        ['title' => 'Філософія', 'url' => '#', 'pl' => 'Filozofia'],
        ['title' => 'Програми', 'url' => home_url('/#programs'), 'pl' => 'Programy'],
        ['title' => 'Учасниці', 'url' => home_url('/#members'), 'pl' => 'Uczestniczki'],
        ['title' => 'Журнал', 'url' => $blog_url, 'pl' => 'Journal'],
    ]);

    $seed_menu('Footer Join', 'footer_join', [
        ['title' => 'Заявка', 'url' => home_url('/#cta'), 'pl' => 'Aplikacja'],
        ['title' => 'Критерії відбору', 'url' => '#', 'pl' => 'Kryteria selekcji'],
        ['title' => 'Членський внесок', 'url' => '#', 'pl' => 'Składka członkowska'],
        ['title' => 'Часті питання', 'url' => '#', 'pl' => 'Częste pytania'],
    ]);

    $seed_menu('Footer Contact', 'footer_contact', [
        ['title' => 'hello@luminarycollective.com', 'url' => 'mailto:hello@luminarycollective.com', 'pl' => ''],
        ['title' => 'Instagram', 'url' => '#', 'pl' => ''],
        ['title' => 'LinkedIn', 'url' => '#', 'pl' => ''],
        ['title' => 'Substack', 'url' => '#', 'pl' => ''],
    ]);

    set_theme_mod('nav_menu_locations', $locations);

    update_option('lum_seeded_v1', 1);
}
add_action('after_switch_theme', 'lum_seed_content');
