<?php
if (!defined('ABSPATH')) exit;

/**
 * Register Customizer settings — all editable text + key images.
 * Each translatable text has _ua and _pl variants.
 */
function lum_customize_register($wp_customize) {
    // Helper to add UA + PL pair
    $add_pair = function($section, $base, $label, $default_ua = '', $default_pl = '', $type = 'text') use ($wp_customize) {
        $wp_customize->add_setting($base . '_ua', ['default' => $default_ua, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($base . '_ua', [
            'label' => $label . ' (UA)',
            'section' => $section,
            'type' => $type === 'textarea' ? 'textarea' : 'text',
        ]);
        $wp_customize->add_setting($base . '_pl', ['default' => $default_pl, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($base . '_pl', [
            'label' => $label . ' (PL)',
            'section' => $section,
            'type' => $type === 'textarea' ? 'textarea' : 'text',
        ]);
    };

    // === BRANDING ===
    $wp_customize->add_section('lum_branding', ['title' => __('Luminary: Branding', 'luminary'), 'priority' => 10]);
    $add_pair('lum_branding', 'logo_main', __('Logo: main word', 'luminary'), 'Luminary', 'Luminary');
    $add_pair('lum_branding', 'logo_sub', __('Logo: italic word', 'luminary'), 'Collective', 'Collective');

    // === HERO ===
    $wp_customize->add_section('lum_hero', ['title' => __('Luminary: Hero', 'luminary'), 'priority' => 20]);
    $add_pair('lum_hero', 'vertical_1', __('Vertical text — line 1', 'luminary'), 'QUIET', 'QUIET');
    $add_pair('lum_hero', 'vertical_2', __('Vertical text — line 2 (outlined)', 'luminary'), 'POWER', 'POWER');
    $add_pair('lum_hero', 'hero_eyebrow', __('Eyebrow', 'luminary'), 'Закрите коло жінок-лідерок', 'Zamknięty krąg kobiet liderek');
    $add_pair('lum_hero', 'hero_h1_a', __('Headline — line 1', 'luminary'), 'Ми не чекаємо свого часу.', 'Nie czekamy na swój czas.');
    $add_pair('lum_hero', 'hero_h1_b', __('Headline — line 2 (italic)', 'luminary'), 'Ми його формуємо.', 'Kształtujemy go.');
    $add_pair('lum_hero', 'hero_sub', __('Subheading', 'luminary'), 'Luminary Collective. Простір для жінок, які вже ведуть за собою й шукають рівних. Тут визрівають рішення, партнерства та голоси, що змінюють правила гри.', 'Luminary Collective. Przestrzeń dla kobiet, które już prowadzą za sobą innych i szukają sobie równych. Tutaj dojrzewają decyzje, partnerstwa i głosy, które zmieniają reguły gry.', 'textarea');
    $wp_customize->add_setting('hero_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label' => __('Hero image', 'luminary'), 'section' => 'lum_hero',
    ]));

    // === TESTIMONIAL ===
    $wp_customize->add_section('lum_testimonial', ['title' => __('Luminary: Testimonial card', 'luminary'), 'priority' => 25]);
    $add_pair('lum_testimonial', 'tt_label', __('Label', 'luminary'), 'Голос учасниці', 'Głos uczestniczki');
    $add_pair('lum_testimonial', 'tt_quote', __('Quote', 'luminary'), '"Це та кімната, в яку я заходжу власницею, а виходжу з відповідями, про які навіть не встигла запитати."', '"To ten pokój, do którego wchodzę jako właścicielka, a wychodzę z odpowiedziami, o które nawet nie zdążyłam zapytać."', 'textarea');
    $wp_customize->add_setting('testimonial_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'testimonial_image', [
        'label' => __('Testimonial thumbnail', 'luminary'), 'section' => 'lum_testimonial',
    ]));

    // === NAVIGATION ===
    $wp_customize->add_section('lum_nav', ['title' => __('Luminary: Navigation', 'luminary'), 'priority' => 30]);
    $add_pair('lum_nav', 'nav_programs', __('Nav: Programs', 'luminary'), 'Програми', 'Programy');
    $add_pair('lum_nav', 'nav_summits', __('Nav: Summits', 'luminary'), 'Самміти', 'Summity');
    $add_pair('lum_nav', 'nav_members', __('Nav: Members', 'luminary'), 'Учасниці', 'Uczestniczki');
    $add_pair('lum_nav', 'nav_stories', __('Nav: Stories', 'luminary'), 'Історії', 'Historie');
    $add_pair('lum_nav', 'nav_join', __('Nav: Join', 'luminary'), 'Вступ', 'Dołączenie');
    $add_pair('lum_nav', 'cta_apply', __('CTA: Apply button', 'luminary'), 'Подати заявку', 'Złóż aplikację');

    // === PROGRAMS SECTION ===
    $wp_customize->add_section('lum_programs', ['title' => __('Luminary: Programs section', 'luminary'), 'priority' => 40]);
    $add_pair('lum_programs', 'progs_eyebrow', __('Eyebrow', 'luminary'), 'Що відбувається всередині', 'Co dzieje się w środku');
    $add_pair('lum_programs', 'progs_title_a', __('Title — line 1', 'luminary'), 'Не конференції.', 'Nie konferencje.');
    $add_pair('lum_programs', 'progs_title_b', __('Title — line 2 (italic)', 'luminary'), 'Зустрічі по суті.', 'Spotkania po istocie.');
    $add_pair('lum_programs', 'progs_sub', __('Subheading', 'luminary'), 'Камерні самміти, закриті mastermind-кола й резиденції для тих, хто приймає рішення, а не спостерігає за ними.', 'Kameralne summity, zamknięte kręgi mastermind i rezydencje dla tych, które podejmują decyzje, a nie obserwują je z boku.', 'textarea');
    $add_pair('lum_programs', 'progs_link', __('Card "Learn more" text', 'luminary'), 'Дізнатись більше', 'Dowiedz się więcej');

    // === BIG QUOTE ===
    $wp_customize->add_section('lum_quote', ['title' => __('Luminary: Big quote', 'luminary'), 'priority' => 45]);
    $add_pair('lum_quote', 'quote_text', __('Quote', 'luminary'), '"Жіноче коло. Це не про підтримку слабких. Це про те, як сильні перестають нести все наодинці й починають будувати разом."', '"Krąg kobiet. To nie jest wsparcie dla słabych. To moment, w którym silne przestają nieść wszystko same i zaczynają budować razem."', 'textarea');
    $add_pair('lum_quote', 'quote_attr', __('Attribution', 'luminary'), 'ОЛЕНА ПАРК, ЗАСНОВНИЦЯ LUMINARY COLLECTIVE', 'OLENA PARK, ZAŁOŻYCIELKA LUMINARY COLLECTIVE');

    // === CRITERIA ===
    $wp_customize->add_section('lum_criteria', ['title' => __('Luminary: Criteria section', 'luminary'), 'priority' => 50]);
    $add_pair('lum_criteria', 'crit_eyebrow', __('Eyebrow', 'luminary'), 'Критерії відбору', 'Kryteria selekcji');
    $add_pair('lum_criteria', 'crit_title_a', __('Title — line 1', 'luminary'), 'Хто сідає', 'Kto siada');
    $add_pair('lum_criteria', 'crit_title_b', __('Title — line 2 (italic)', 'luminary'), 'за цей стіл', 'przy tym stole');
    $add_pair('lum_criteria', 'crit_yes_h', __('YES heading', 'luminary'), 'Це ваш простір, якщо', 'To twoja przestrzeń, jeśli');
    $add_pair('lum_criteria', 'crit_yes_items', __('YES items (one per line)', 'luminary'),
        "Ви керуєте компанією, фондом або напрямом від пʼяти років.\nПриймаєте рішення, які впливають на команди, капітал, ринок.\nШукаєте рівних, а не аудиторію для власного голосу.\nГотові говорити тихо, конкретно й без позування.",
        "Prowadzisz firmę, fundusz lub kierunek od co najmniej pięciu lat.\nPodejmujesz decyzje, które realnie wpływają na zespoły, kapitał, rynek.\nSzukasz sobie równych, a nie publiczności dla własnego głosu.\nPotrafisz mówić cicho, konkretnie, bez pozowania.",
        'textarea');
    $add_pair('lum_criteria', 'crit_no_h', __('NO heading', 'luminary'), 'Ще не час, якщо', 'Jeszcze nie teraz, jeśli');
    $add_pair('lum_criteria', 'crit_no_items', __('NO items (one per line)', 'luminary'),
        "Ви на старті шляху і шукаєте базову освіту чи коучинг.\nВам потрібна сцена, видимість або нові підписники.\nОчікуєте готові відповіді замість спільного мислення.",
        "Jesteś na początku drogi i szukasz podstawowej edukacji albo coachingu.\nPotrzebujesz sceny, widoczności lub nowych obserwujących.\nOczekujesz gotowych odpowiedzi zamiast wspólnego myślenia.",
        'textarea');

    // === MEMBERS ===
    $wp_customize->add_section('lum_members', ['title' => __('Luminary: Members section', 'luminary'), 'priority' => 55]);
    $add_pair('lum_members', 'memb_eyebrow', __('Eyebrow', 'luminary'), 'Кого ви зустрінете', 'Kogo tu spotkasz');
    $add_pair('lum_members', 'memb_title_a', __('Title — line 1', 'luminary'), 'Жінки, поруч із якими', 'Kobiety, przy których');
    $add_pair('lum_members', 'memb_title_b', __('Title — line 2 (italic)', 'luminary'), 'хочеться зростати.', 'chce się rosnąć.');
    $add_pair('lum_members', 'memb_sub', __('Subheading', 'luminary'), 'Засновниці, CEO, креативні директорки, інвесторки й авторки змін. Кожна з власною траєкторією, усі з однаковою серйозністю намірів.', 'Założycielki, CEO, dyrektorki kreatywne, inwestorki, autorki zmian. Każda z własną trajektorią, wszystkie z tą samą powagą intencji.', 'textarea');

    // === BENEFITS ===
    $wp_customize->add_section('lum_benefits', ['title' => __('Luminary: Benefits section', 'luminary'), 'priority' => 60]);
    $add_pair('lum_benefits', 'ben_eyebrow', __('Eyebrow', 'luminary'), 'Всередині Collective', 'Wewnątrz Collective');
    $add_pair('lum_benefits', 'ben_title_a', __('Title — line 1', 'luminary'), 'Те, що справді', 'To, co naprawdę');
    $add_pair('lum_benefits', 'ben_title_b', __('Title — line 2 (italic)', 'luminary'), 'змінює траєкторію', 'zmienia trajektorię');

    // === FAQ ===
    $wp_customize->add_section('lum_faq', ['title' => __('Luminary: FAQ section', 'luminary'), 'priority' => 65]);
    $add_pair('lum_faq', 'faq_eyebrow', __('Eyebrow', 'luminary'), 'Часті питання', 'Częste pytania');
    $add_pair('lum_faq', 'faq_title_a', __('Title — line 1', 'luminary'), 'Відверто', 'Szczerze');
    $add_pair('lum_faq', 'faq_title_b', __('Title — line 2 (italic)', 'luminary'), 'про членство', 'o członkostwie');

    // === JOURNAL ===
    $wp_customize->add_section('lum_journal', ['title' => __('Luminary: Journal preview', 'luminary'), 'priority' => 70]);
    $add_pair('lum_journal', 'jrn_eyebrow', __('Eyebrow', 'luminary'), 'Luminary Journal', 'Luminary Journal');
    $add_pair('lum_journal', 'jrn_title_a', __('Title — line 1', 'luminary'), 'Не лекції.', 'Nie wykłady.');
    $add_pair('lum_journal', 'jrn_title_b', __('Title — line 2 (italic)', 'luminary'), 'Редакційні матеріали.', 'Materiały redakcyjne.');
    $add_pair('lum_journal', 'jrn_sub', __('Subheading', 'luminary'), 'Портрети, поля, інтервʼю та розмови про те, як жінки ведуть компанії, капітал і культуру. Без мотиваційних постів.', 'Portrety, wywiady i rozmowy o tym, jak kobiety prowadzą firmy, kapitał i kulturę. Bez motywacyjnych postów.', 'textarea');
    $add_pair('lum_journal', 'jrn_more', __('More button', 'luminary'), 'Відкрити журнал →', 'Otwórz journal →');

    // === FINAL CTA ===
    $wp_customize->add_section('lum_cta', ['title' => __('Luminary: Final CTA', 'luminary'), 'priority' => 75]);
    $add_pair('lum_cta', 'cta_eyebrow', __('Eyebrow', 'luminary'), 'Подати заявку', 'Złóż aplikację');
    $add_pair('lum_cta', 'cta_headline_a', __('Headline — line 1', 'luminary'), '"Стіл накритий.', '"Stół jest nakryty.');
    $add_pair('lum_cta', 'cta_headline_b', __('Headline — line 2', 'luminary'), 'Місце за вами."', 'Miejsce należy do ciebie."');
    $add_pair('lum_cta', 'cta_sub', __('Subheading', 'luminary'), 'Набір у весняну когорту закривається, коли заповнюються останні місця у програмах. Додаткових хвиль цього року не буде.', 'Nabór do wiosennej kohorty zamyka się, gdy wypełnią się ostatnie miejsca w programach. Dodatkowych fal w tym roku nie będzie.', 'textarea');
    $add_pair('lum_cta', 'cta_button', __('Button text', 'luminary'), 'Залишити заявку', 'Zostaw aplikację');
    $add_pair('lum_cta', 'cta_secondary', __('Secondary text', 'luminary'), 'Розгляд заявок до 7 днів', 'Rozpatrzenie aplikacji do 7 dni');

    // === FOOTER ===
    $wp_customize->add_section('lum_footer', ['title' => __('Luminary: Footer', 'luminary'), 'priority' => 80]);
    $add_pair('lum_footer', 'footer_blurb', __('Blurb', 'luminary'), 'Luminary Collective. Закрита спільнота для жінок, які ведуть компанії, культуру й розмови свого часу. Ми збираємо одна одну, щоб рухатися далі й точніше.', 'Luminary Collective. Zamknięta społeczność dla kobiet, które prowadzą firmy, kulturę i rozmowy swojego czasu. Zbieramy się, żeby iść dalej i precyzyjniej.', 'textarea');
    $add_pair('lum_footer', 'footer_news_btn', __('Newsletter button', 'luminary'), 'Підписатися', 'Zapisz się');
    $add_pair('lum_footer', 'footer_tag', __('Tagline', 'luminary'), 'РАЗОМ. ТИХО, ТОЧНО, ВГОРУ', 'RAZEM. CICHO, PRECYZYJNIE, W GÓRĘ');
}
add_action('customize_register', 'lum_customize_register');
