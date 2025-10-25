/*
 * Interacciones sencillas para la página de aterrizaje.  Este script gestiona
 * el menú de navegación en móviles.  Se carga al final de la plantilla.
 */
/*
 * Menú móvil accesible para la landing
 */
document.addEventListener('DOMContentLoaded', () => {
  const burger = document.querySelector('.burger');
  const nav = document.querySelector('.main-nav');

  if (!burger || !nav) return;

  // Asegura atributos ARIA coherentes HTML:
  // <button class="burger" id="burgerBtn" aria-controls="mainNav" aria-expanded="false">
  // <nav class="main-nav" id="mainNav">...</nav>
  const navId = nav.id || 'mainNav';
  const restore = () => {
    document.body.classList.remove('no-scroll');
    nav.classList.remove('open');
    burger.classList.remove('active');
    burger.setAttribute('aria-expanded', 'false');
    // devolver foco al botón
    burger.focus({ preventScroll: true });
  };

  const open = () => {
    document.body.classList.add('no-scroll');
    nav.classList.add('open');
    burger.classList.add('active');
    burger.setAttribute('aria-controls', navId);
    burger.setAttribute('aria-expanded', 'true');
    // foco al primer enlace
    const firstLink = nav.querySelector('a');
    if (firstLink) firstLink.focus({ preventScroll: true });
  };

  const toggle = () => {
    if (nav.classList.contains('open')) restore();
    else open();
  };

  burger.addEventListener('click', toggle);

  // Cerrar al hacer click en enlaces del menú
  nav.querySelectorAll('a')?.forEach(a => {
    a.addEventListener('click', restore);
  });

  // Cerrar al presionar Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && nav.classList.contains('open')) {
      restore();
    }
  });

  // Cerrar al hacer click fuera del nav y del botón
  document.addEventListener('click', (e) => {
    if (!nav.classList.contains('open')) return;
    const target = e.target;
    if (!nav.contains(target) && !burger.contains(target)) {
      restore();
    }
  });

  // Respeta reduce motion (opcional, por si tienes transiciones fuertes)
  const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (mq.matches) {
    nav.style.transition = 'none';
  }
});

// Carrusel horizontal AUTO para "Empresas destacadas"
document.addEventListener('DOMContentLoaded', () => {
  const row = document.querySelector('.featured-companies .companies-row');
  if (!row) return;

  // Cambia a true si quieres auto también en desktop
  const AUTO_ON_DESKTOP = false;
  const INTERVAL_MS = 2800; // tiempo entre slides

  const isMobile = () => window.matchMedia('(max-width: 768px)').matches;
  const shouldAuto = () => AUTO_ON_DESKTOP ? true : isMobile();

  let timer = null;
  let userInteracting = false;

  // Calcula el tamaño de paso = ancho de una tarjeta + gap
  const stepSize = () => {
    const card = row.querySelector('.company-item');
    if (!card) return 0;
    const cardW = card.getBoundingClientRect().width;
    const styles = getComputedStyle(row);
    const gap = parseFloat(styles.columnGap || styles.gap || 16);
    return Math.round(cardW + gap);
  };

  // Avanza una tarjeta con "snap" y reinicia al llegar al final
  const next = () => {
    if (!shouldAuto()) return;
    const step = stepSize();
    if (!step) return;

    const maxScroll = row.scrollWidth - row.clientWidth;
    const target = row.scrollLeft + step;

    if (target >= maxScroll - 2) {
      // reset sin “salto” (sin animación)
      const prev = row.style.scrollBehavior;
      row.style.scrollBehavior = 'auto';
      row.scrollLeft = 0;
      row.style.scrollBehavior = prev || 'smooth';
    } else {
      row.scrollTo({ left: target, behavior: 'smooth' });
    }
  };

  const start = () => {
    if (timer || !shouldAuto()) return;
    timer = setInterval(next, INTERVAL_MS);
  };

  const stop = () => {
    if (!timer) return;
    clearInterval(timer);
    timer = null;
  };

  // Pausa en interacción y reanuda después
  let resumeId = null;
  const pauseThenResume = () => {
    stop();
    if (resumeId) clearTimeout(resumeId);
    resumeId = setTimeout(() => {
      userInteracting = false;
      start();
    }, 3500);
  };

  // Interacciones del usuario (tacto/rueda/drag)
  row.addEventListener('pointerdown', () => { userInteracting = true; stop(); });
  row.addEventListener('pointerup', pauseThenResume);
  row.addEventListener('pointercancel', pauseThenResume);
  row.addEventListener('touchstart', () => { userInteracting = true; stop(); }, { passive: true });
  row.addEventListener('wheel', pauseThenResume, { passive: true });

  // Arranca y reevalúa en resize/orientación
  start();
  window.addEventListener('resize', () => { stop(); start(); });
});


// Carrusel horizontal AUTO para "Trabajos destacados" (mobile)
document.addEventListener('DOMContentLoaded', () => {
  const row = document.querySelector('.featured-jobs .jobs-grid, .featured_jobs .jobs-grid');
  if (!row) return;

  const AUTO_ON_DESKTOP = false;     // pon true si quieres también en desktop
  const INTERVAL_MS = 2800;

  const isMobile = () => window.matchMedia('(max-width: 768px)').matches;
  const shouldAuto = () => AUTO_ON_DESKTOP ? true : isMobile();

  let timer = null;
  let resumeId = null;
  let userInteracting = false;

  // tamaño de paso = ancho de una tarjeta + gap
  const stepSize = () => {
    const card = row.querySelector('.job-card');
    if (!card) return 0;
    const cardW = card.getBoundingClientRect().width;
    const styles = getComputedStyle(row);
    const gap = parseFloat(styles.columnGap || styles.gap || 16);
    return Math.round(cardW + gap);
  };

  const next = () => {
    if (!shouldAuto()) return;
    const step = stepSize();
    if (!step) return;

    const maxScroll = row.scrollWidth - row.clientWidth;
    const target = row.scrollLeft + step;

    if (target >= maxScroll - 2) {
      const prev = row.style.scrollBehavior;
      row.style.scrollBehavior = 'auto';
      row.scrollLeft = 0;
      row.style.scrollBehavior = prev || 'smooth';
    } else {
      row.scrollTo({ left: target, behavior: 'smooth' });
    }
  };

  const start = () => {
    if (timer || !shouldAuto()) return;
    timer = setInterval(next, INTERVAL_MS);
  };

  const stop = () => {
    if (!timer) return;
    clearInterval(timer);
    timer = null;
  };

  const pauseThenResume = () => {
    stop();
    if (resumeId) clearTimeout(resumeId);
    resumeId = setTimeout(() => {
      userInteracting = false;
      start();
    }, 3500);
  };

  // Pausa en interacción del usuario
  row.addEventListener('pointerdown', () => { userInteracting = true; stop(); });
  row.addEventListener('pointerup', pauseThenResume);
  row.addEventListener('pointercancel', pauseThenResume);
  row.addEventListener('touchstart', () => { userInteracting = true; stop(); }, { passive: true });
  row.addEventListener('wheel', pauseThenResume, { passive: true });

  start();
  window.addEventListener('resize', () => { stop(); start(); });
});


// Carrusel horizontal AUTO para "Testimonios" (mobile)
document.addEventListener('DOMContentLoaded', () => {
  const row = document.querySelector('.testimonials');
  if (!row) return;

  const AUTO_ON_DESKTOP = false;   // pon true si quieres también en desktop
  const INTERVAL_MS = 3000;

  const isMobile = () => window.matchMedia('(max-width: 768px)').matches;
  const shouldAuto = () => (AUTO_ON_DESKTOP ? true : isMobile());

  let timer = null;
  let resumeId = null;

  // tamaño de paso = ancho de una tarjeta + gap
  const stepSize = () => {
    const card = row.querySelector('.testimonial-card');
    if (!card) return 0;
    const w = card.getBoundingClientRect().width;
    const styles = getComputedStyle(row);
    const gap = parseFloat(styles.columnGap || styles.gap || 16);
    return Math.round(w + gap);
  };

  const next = () => {
    if (!shouldAuto()) return;
    const step = stepSize();
    if (!step) return;

    const maxScroll = row.scrollWidth - row.clientWidth;
    const target = row.scrollLeft + step;

    if (target >= maxScroll - 2) {
      const prev = row.style.scrollBehavior;
      row.style.scrollBehavior = 'auto';
      row.scrollLeft = 0;
      row.style.scrollBehavior = prev || 'smooth';
    } else {
      row.scrollTo({ left: target, behavior: 'smooth' });
    }
  };

  const start = () => {
    if (timer || !shouldAuto()) return;
    timer = setInterval(next, INTERVAL_MS);
  };

  const stop = () => {
    if (!timer) return;
    clearInterval(timer);
    timer = null;
  };

  const pauseThenResume = () => {
    stop();
    if (resumeId) clearTimeout(resumeId);
    resumeId = setTimeout(() => start(), 3500);
  };

  // Pausa en interacción del usuario
  row.addEventListener('pointerdown', stop);
  row.addEventListener('pointerup', pauseThenResume);
  row.addEventListener('pointercancel', pauseThenResume);
  row.addEventListener('touchstart', stop, { passive: true });
  row.addEventListener('wheel', pauseThenResume, { passive: true });

  start();
  window.addEventListener('resize', () => { stop(); start(); });
});
