/* Gedeelde header en footer voor alle Geerstraat-pagina's */
(function () {
  const huidigePad = location.pathname.replace(/\/$/, '').split('/').pop() || 'index.html';

  function actief(href) {
    const naam = href.split('/').pop();
    return naam === huidigePad ? ' actief' : '';
  }

  // Bepaal relatief pad naar root (voor subdirectories)
  const root = '';

  const headerHTML = `
<header>
  <div class="wrap nav">
    <a class="brand" href="${root}index.html">
      <span class="badge"><img src="${root}assets/logo.png" alt="Buurtraad Geerstraat logo"></span>
      <span class="brand-txt"><b>Buurtraad Geerstraat</b><span class="sub">Vaassen</span></span>
    </a>
    <nav class="links">
      <a href="${root}index.html" class="${actief('index.html').trim()}">Home</a>
      <a href="${root}over.html" class="${actief('over.html').trim()}">Over ons</a>
      <a href="${root}fotos.html" class="${actief('fotos.html').trim()}">Foto's</a>
      <a href="${root}index.html#contact">Contact</a>
    </nav>
    <a class="cta" href="${root}index.html#contact">Doe mee</a>
    <button class="menu-btn" aria-label="Menu" onclick="toggleMenu(this)">☰ Menu</button>
  </div>
</header>`;

  const footerHTML = `
<footer>
  <div class="wrap foot">
    <a class="brand" href="${root}index.html">
      <span class="badge"><img src="${root}assets/logo.png" alt=""></span>
      <span class="brand-txt"><b>Buurtraad Geerstraat</b><span class="sub">Vaassen</span></span>
    </a>
    <div class="foot-links">
      <a class="site" href="${root}index.html">www.geerstraat.nl</a>
      <a href="${root}index.html#jaarplanner">Jaarplanner</a>
      <a href="${root}index.html#clubs">Clubs</a>
      <a href="${root}fotos.html">Foto's</a>
      <a href="${root}index.html#contact">Contact</a>
      <a href="#">Privacy verklaring</a>
    </div>
  </div>
</footer>`;

  document.getElementById('header-container').innerHTML = headerHTML;
  document.getElementById('footer-container').innerHTML = footerHTML;

  window.toggleMenu = function (btn) {
    const nav = document.querySelector('nav.links');
    const open = nav.style.display === 'flex';
    nav.style.display = open ? '' : 'flex';
    nav.style.flexDirection = 'column';
    nav.style.position = open ? '' : 'absolute';
    nav.style.top = open ? '' : '70px';
    nav.style.right = open ? '' : '20px';
    nav.style.background = open ? '' : 'var(--cream)';
    nav.style.padding = open ? '' : '12px 20px';
    nav.style.borderRadius = open ? '' : '16px';
    nav.style.boxShadow = open ? '' : '0 8px 32px rgba(0,0,0,.15)';
    nav.style.zIndex = open ? '' : '100';
    btn.textContent = open ? '☰ Menu' : '✕ Sluiten';
  };
})();
