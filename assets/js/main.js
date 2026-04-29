(() => {
  // ============= I18N (UA <-> PL) =============
  // Every translatable element has data-pl="..." attribute baked by PHP.
  // When Polylang is active, body has class "lum-polylang-active" and the
  // switcher renders as <a> links (not <button>) — skip JS swap, Polylang
  // serves the right language directly.
  const polylangActive = document.body.classList.contains('lum-polylang-active') ||
                         document.querySelector('.lang-switch--polylang');

  if (!polylangActive) {
    const elements = Array.from(document.querySelectorAll('[data-pl]'));
    const original = new Map();
    elements.forEach(el => original.set(el, el.innerHTML));

    const setLang = (lang) => {
      document.documentElement.lang = lang === 'pl' ? 'pl' : 'uk';
      elements.forEach(el => {
        if (lang === 'pl') {
          el.innerHTML = el.dataset.pl;
        } else if (original.has(el)) {
          el.innerHTML = original.get(el);
        }
      });
      document.querySelectorAll('.lang-btn').forEach(b => {
        b.classList.toggle('lang-btn--active', b.dataset.lang === lang);
      });
      try { localStorage.setItem('lum_lang', lang); } catch(e) {}
    };

    document.querySelectorAll('.lang-btn').forEach(b => {
      // Skip <a> links (Polylang switcher) — only attach to <button>
      if (b.tagName !== 'BUTTON') return;
      b.addEventListener('click', () => setLang(b.dataset.lang));
    });

    let saved = 'ua';
    try { saved = localStorage.getItem('lum_lang') || 'ua'; } catch(e) {}
    if (saved === 'pl') setLang('pl');
  }

  // ============= SCROLL REVEAL =============
  const setupReveal = () => {
    const targets = document.querySelectorAll('section, .member-card, .benefit, .faq-item, .journal-card, .program-card, .article');
    targets.forEach(el => el.classList.add('reveal'));
    requestAnimationFrame(() => {
      const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            e.target.classList.add('in');
            io.unobserve(e.target);
          }
        });
      }, { rootMargin: '0px 0px -5% 0px', threshold: 0.01 });
      targets.forEach(el => io.observe(el));
      // Safety net
      setTimeout(() => {
        targets.forEach(el => {
          const r = el.getBoundingClientRect();
          if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('in');
        });
      }, 200);
    });
  };
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupReveal);
  } else {
    setupReveal();
  }

  // ============= BLOG FILTER CHIPS =============
  document.querySelectorAll('.chip').forEach(chip => {
    chip.addEventListener('click', () => {
      document.querySelectorAll('.chip').forEach(c => c.classList.remove('chip--active'));
      chip.classList.add('chip--active');
      const f = chip.dataset.filter;
      document.querySelectorAll('.article').forEach(a => {
        a.style.display = (f === 'all' || a.dataset.cat === f) ? '' : 'none';
      });
    });
  });
})();
