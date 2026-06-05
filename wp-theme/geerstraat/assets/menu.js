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
