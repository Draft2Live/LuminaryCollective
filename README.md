# Luminary Collective — WordPress тема

Класична WordPress-тема. PHP 7.4+, WP 6.0+. Опціональна сумісність із Polylang.

## Що нового в цьому випуску

1. **WordPress-меню в шапці і підвалі.** Чотири локації меню (`primary`, `footer_community`, `footer_join`, `footer_contact`) — створюй їх у **Appearance → Menus** і призначай за локацією. Якщо меню не призначене, рендериться запасний хардкод-варіант із `data-pl` атрибутами для UA/PL.

2. **Polylang language switcher.** Інтегровано в шапку. Поки плагін Polylang не встановлено — працює стара JS-кнопка UA/PL із `data-pl`-атрибутами. Як тільки Polylang активовано та налаштовано хоча б дві мови — шапка автоматично починає рендерити правильні полінкі через `pll_the_languages()` (між мовами зберігається відповідник посту/сторінки). Розмітка — та сама `.lang-switch / .lang-btn`, тому весь CSS залишається на місці.

3. **Повноцінний блог.** Стандартний WP `Post`. Категорії, теги, автор, дата, читацький час, обкладинки, пагінація — на:
   - `archive.php` — категорії, теги, автор, пошук, дата
   - `single.php` — одна стаття + meta-блок (категорія, теги, автор, дата) + коментарі
   - `page-blog.php` (Template Name: *Luminary Journal*) — кастомна сторінка-журнал із фільтрами по категоріях

## Встановлення

1. **Appearance → Themes → Add New → Upload Theme** → залий zip → Activate.
2. **Settings → Permalinks → Post name** (інакше `/blog/` не працюватиме).
3. **Settings → Reading → Homepage displays → A static page → Homepage: Home** (створи сторінку `Home`).
4. Створи сторінку `Blog` зі slug `blog` і Template = *Luminary Journal*.

## Меню (Appearance → Menus)

| Locаtion                       | Куди іде                                  |
|--------------------------------|--------------------------------------------|
| Primary (header)               | основна навігація шапки                    |
| Footer column 1: Community     | перша колонка футера (Спільнота)           |
| Footer column 2: Join          | друга колонка футера (Приєднатись)         |
| Footer column 3: Contact       | третя колонка футера (Контакти)            |

Якщо хочеш UA/PL-перемикання БЕЗ Polylang — у редакторі пункту меню є додаткове поле **Polish label (data-pl)**. JS-перемикач підставляє цей переклад на льоту. Полю стає неактуальним після підключення Polylang.

## Polylang (опціонально)

1. Встанови плагін **Polylang** (free).
2. **Languages → Languages** → додай Українську (uk) як дефолт і Польську (pl).
3. Для кожної сторінки/посту створи переклад через стовпчик мов.
4. Шапка автоматично почне рендерити справжній перемикач на крос-мовні permalinks (markup той самий — UA / PL у вигляді `.lang-btn`).

## Блог — чек-лист

- ✅ Тип матеріалу: built-in WordPress `post`
- ✅ Категорії й теги — стандартні (`category`, `post_tag`)
- ✅ Шаблони: `index.php`, `archive.php` (всі архіви), `category.php` / `tag.php` / `author.php` (через `archive.php`), `single.php`, `search.php`, `page-blog.php`
- ✅ На фронті показується: автор (з посиланням на `author.php`), категорія, теги, дата, reading time, обкладинка
- ✅ Пагінація (`the_posts_pagination` / `paginate_links`)
- ✅ Коментарі (стандартні WP)
- ✅ Polylang-сумісно (translations прив'язуються до самого WP_Post)

## Файли

```
luminarycollective/
├── style.css                ← заголовок теми + посилання на main.css
├── functions.php
├── header.php               ← з Polylang switcher
├── footer.php               ← 3 колонки на wp_nav_menu
├── front-page.php
├── page.php
├── page-blog.php            ← Template "Luminary Journal"
├── single.php               ← пост: автор, категорія, теги, коментарі
├── archive.php              ← всі архіви: автор, категорія, теги
├── search.php
├── index.php
├── inc/
│   ├── template-helpers.php ← lum_render_language_switcher() та інші
│   ├── menu.php             ← фолбеки для всіх 4 локацій + data-pl поле
│   ├── cpt.php              ← CPT для programs/members/summits
│   ├── customizer.php       ← усі тексти редагуються в Customizer
│   └── seed.php             ← демо-наповнення
├── assets/
│   ├── css/main.css
│   ├── js/main.js           ← UA/PL JS-перемикач (фолбек без Polylang)
│   └── images/              ← зображення
└── languages/               ← .po/.mo для перекладів
```
