(function () {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var ICON_PREV = '<svg class="rq-hero-fotos__icon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path d="M14.5 5.5 8 12l6.5 6.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  var ICON_NEXT = '<svg class="rq-hero-fotos__icon" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path d="M9.5 5.5 16 12l-6.5 6.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  var ICON_PAUSE = '<svg class="rq-hero-fotos__icon rq-icon-pause" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><path d="M7.5 5.5h2.6v13H7.5zM13.9 5.5h2.6v13h-2.6z" fill="#ffffff"/></svg>';
  var ICON_PLAY = '<svg class="rq-hero-fotos__icon rq-icon-play" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><path d="M8.5 5.8 18 12 8.5 18.2z" fill="#ffffff"/></svg>';

  function ensureSvg(btn, html) {
    if (!btn || btn.querySelector('svg')) return;
    btn.textContent = '';
    btn.insertAdjacentHTML('beforeend', html);
  }

  function ensureDots(controls, count) {
    var dots = controls.querySelector('.rq-hero-fotos__dots');
    if (!dots) {
      dots = document.createElement('div');
      dots.className = 'rq-hero-fotos__dots';
      dots.setAttribute('aria-hidden', 'true');
      controls.appendChild(dots);
    }
    dots.setAttribute('aria-hidden', 'true');
    while (dots.children.length < count) {
      var dot = document.createElement('span');
      dot.className = 'rq-hero-fotos__dot';
      dots.appendChild(dot);
    }
    return dots;
  }

  function init(root) {
    var figures = Array.prototype.slice.call(root.querySelectorAll(':scope > figure'));
    if (figures.length < 2) return;

    var btnPrev = root.querySelector('[data-rq-foto="prev"]');
    var btnPause = root.querySelector('[data-rq-foto="pause"]');
    var btnNext = root.querySelector('[data-rq-foto="next"]');
    var controls = root.querySelector('.rq-hero-fotos__controles');
    if (!btnPrev || !btnPause || !btnNext || !controls) return;

    ensureSvg(btnPrev, ICON_PREV);
    ensureSvg(btnNext, ICON_NEXT);
    if (!btnPause.querySelector('svg')) {
      btnPause.textContent = '';
      btnPause.insertAdjacentHTML('beforeend', ICON_PAUSE + ICON_PLAY);
    }
    btnPrev.removeAttribute('title');
    btnNext.removeAttribute('title');
    btnPause.removeAttribute('title');

    var dots = ensureDots(controls, figures.length);

    var index = 0;
    var activeAt = figures.findIndex(function (fig) {
      return fig.classList.contains('is-active');
    });
    if (activeAt >= 0) index = activeAt;

    function visibleIndex() {
      var best = index;
      var bestOp = -1;
      figures.forEach(function (fig, i) {
        var op = parseFloat(window.getComputedStyle(fig).opacity);
        if (isNaN(op)) op = 0;
        if (op > bestOp) {
          bestOp = op;
          best = i;
        }
      });
      return best;
    }

    function paintDots() {
      Array.prototype.forEach.call(dots.children, function (dot, n) {
        dot.classList.toggle('is-current', n === index);
      });
    }

    function setActive(i) {
      index = ((i % figures.length) + figures.length) % figures.length;
      figures.forEach(function (fig, n) {
        fig.classList.toggle('is-active', n === index);
      });
      paintDots();
    }

    function syncActiveFromVisibility() {
      setActive(visibleIndex());
    }

    /* Ciclo de 12 s com duas fotos: a ativa começa visível (delay 0)
       e a outra entra na metade (-6 s), como o CSS 05f. */
    function alignDelays() {
      figures.forEach(function (fig, n) {
        var delay = (index === 0)
          ? (n === 1 ? '-6s' : '0s')
          : (n === index ? '0s' : '-6s');
        fig.style.animationDelay = delay;
      });
    }

    /* Reinicia a animação sem quadro em branco: .is-holding reusa
       a rede 05g (.is-active / first-child) enquanto animation:none. */
    function restartAligned() {
      root.classList.add('is-holding');
      figures.forEach(function (fig) { fig.style.animation = 'none'; });
      void root.offsetWidth;
      figures.forEach(function (fig) { fig.style.animation = ''; });
      alignDelays();
      root.classList.remove('is-holding');
    }

    function setPauseUi(paused) {
      btnPause.setAttribute('aria-pressed', paused ? 'true' : 'false');
      btnPause.setAttribute('aria-label', paused ? 'Retomar' : 'Pausar');
    }

    function enterManual(i) {
      setActive(i);
      alignDelays();
      root.classList.add('is-paused');
      setPauseUi(true);
    }

    function resumeAuto() {
      // Confirma .is-active na foto que estava/está visível.
      syncActiveFromVisibility();
      alignDelays();
      restartAligned();
      root.classList.remove('is-paused');
      setPauseUi(false);
    }

    // Durante o ciclo automático, mantém .is-active na foto mais visível
    // (preserva a correta ao entrar com mouse/teclado antes de qualquer clique).
    window.setInterval(function () {
      if (root.classList.contains('is-paused')) return;
      if (root.matches(':hover') || root.classList.contains('is-holding')) return;
      syncActiveFromVisibility();
    }, 200);

    root.addEventListener('mouseenter', function () {
      syncActiveFromVisibility();
      alignDelays();
    });
    root.addEventListener('focusin', syncActiveFromVisibility);

    btnPause.addEventListener('click', function () {
      if (root.classList.contains('is-paused')) {
        resumeAuto();
      } else {
        enterManual(visibleIndex());
      }
    });

    btnPrev.addEventListener('click', function () {
      var i = root.classList.contains('is-paused') ? index - 1 : visibleIndex() - 1;
      enterManual(i);
    });

    btnNext.addEventListener('click', function () {
      var i = root.classList.contains('is-paused') ? index + 1 : visibleIndex() + 1;
      enterManual(i);
    });

    function placeOverlay() {
      var img = figures[0].querySelector('img');
      if (!img) return;
      var imgRect = img.getBoundingClientRect();
      var rootRect = root.getBoundingClientRect();
      if (imgRect.width < 1 || imgRect.height < 1) return;
      controls.style.top = (imgRect.top - rootRect.top) + 'px';
      controls.style.left = (imgRect.left - rootRect.left) + 'px';
      controls.style.width = imgRect.width + 'px';
      controls.style.height = imgRect.height + 'px';
      controls.style.aspectRatio = 'auto';
      controls.style.paddingBottom = '0';
    }

    setActive(index);
    alignDelays();
    setPauseUi(false);
    placeOverlay();
    window.addEventListener('resize', placeOverlay);
    window.addEventListener('load', placeOverlay);
    figures.forEach(function (fig) {
      var img = fig.querySelector('img');
      if (img && !img.complete) img.addEventListener('load', placeOverlay);
    });
  }

  function boot() {
    document.querySelectorAll('.rq-hero-fotos').forEach(init);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
