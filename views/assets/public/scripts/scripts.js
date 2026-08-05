/* =====================================================
   Running Power — Interactive Scripts
   ===================================================== */

// http://localhost:8080/acme-3am/api/faqs/category/6
async function fetchFAQs() {
  const response = await fetch("http://localhost:8080/acme-3am/api/faqs/category/6");
  //console.log(response);
  const faqs = await response.json();
  //console.log(faqs.data);
  const listFaqs = document.querySelector("#list-faqs");

  faqs.data.forEach(faq => {
    console.log(faq.answer, faq.question);
    const faqItem = document.createElement("faq-item");
    faqItem.innerHTML = `
        <dt>
            <button class="faq-question" aria-expanded="false">
               <span>${faq.question}</span>
               <i data-lucide="plus" class="w-5 h-5 faq-icon text-surface-gray" aria-hidden="true"></i>
            </button>
        </dt>
            <dd class="faq-answer">
            <p>${faq.answer}</p>
        </dd>
        `;
    listFaqs.appendChild(faqItem);
  });

  // Inicializa os ícones Lucide nos novos elementos
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
}



document.addEventListener('DOMContentLoaded', () => {

  initScrollAnimations();
  initMobileMenu();
  initFAQ();
  initSmoothScroll();
  initCounterAnimation();
  initHeaderScroll();
});

/* ---- Scroll-triggered animations ---- */
function initScrollAnimations() {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReducedMotion) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    },
    { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
  );

  document.querySelectorAll('.animate-on-scroll').forEach((el) => observer.observe(el));
}

/* ---- Mobile Menu ---- */
function initMobileMenu() {
  const btn = document.getElementById('mobile-menu-btn');
  const menu = document.getElementById('mobile-menu');
  const closeBtn = document.getElementById('mobile-menu-close');
  const links = menu?.querySelectorAll('a');

  if (!btn || !menu) return;

  const open = () => {
    menu.classList.add('open');
    document.body.style.overflow = 'hidden';
    btn.setAttribute('aria-expanded', 'true');
  };

  const close = () => {
    menu.classList.remove('open');
    document.body.style.overflow = '';
    btn.setAttribute('aria-expanded', 'false');
  };

  btn.addEventListener('click', () => {
    menu.classList.contains('open') ? close() : open();
  });

  closeBtn?.addEventListener('click', close);

  links?.forEach((link) => {
    link.addEventListener('click', close);
  });
}

/* ---- FAQ Accordion ---- */
function initFAQ() {
  const listFaqs = document.querySelector("#list-faqs");
  if (!listFaqs) return;

  // Event delegation: escuta cliques no <dl> para capturar botões adicionados dinamicamente
  listFaqs.addEventListener("click", (e) => {
    const btn = e.target.closest(".faq-question");
    if (!btn) return;

    const expanded = btn.getAttribute("aria-expanded") === "true";
    const item = btn.closest("faq-item");
    const answer = item ? item.querySelector(".faq-answer") : null;

    if (!answer) return;

    btn.setAttribute("aria-expanded", !expanded);
    answer.classList.toggle("open", !expanded);
  });

  fetchFAQs();

}

/* ---- Smooth Scroll for anchor links ---- */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const href = anchor.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        const headerOffset = 80;
        const top = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });
}

/* ---- Counter Animation ---- */
function initCounterAnimation() {
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length === 0) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.getAttribute('data-count'), 10);
          const suffix = el.getAttribute('data-suffix') || '';
          const duration = 2000;
          const start = performance.now();

          const animate = (now) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * target);
            el.textContent = current.toLocaleString('pt-BR') + suffix;
            if (progress < 1) {
              requestAnimationFrame(animate);
            } else {
              el.textContent = target.toLocaleString('pt-BR') + suffix;
            }
          };

          requestAnimationFrame(animate);
          observer.unobserve(el);
        }
      });
    },
    { threshold: 0.5 }
  );

  counters.forEach((el) => observer.observe(el));
}

/* ---- Header background on scroll ---- */
function initHeaderScroll() {
  const header = document.getElementById('header');
  if (!header) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 10) {
      header.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
    } else {
      header.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
    }
  }, { passive: true });
}
