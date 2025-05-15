document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.getElementById('primary-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const header = document.querySelector(".header");
  const headerLinks = header ? header.querySelectorAll("a") : [];

  function adjustBodyPadding() {
    if (!header) return;

    const isMenuOpen = mobileMenu?.classList.contains('active');
    const rawHeight = header.offsetHeight;

    // Only clamp height if menu is closed — avoid locking in expanded height
    const headerHeight = isMenuOpen
      ? rawHeight
      : Math.max(100, Math.min(rawHeight, 220));

    const paddingTop = headerHeight + 32;
    document.body.style.setProperty('padding-top', `${paddingTop}px`, 'important');
  }

  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', function () {
      mobileMenu.classList.toggle('active');

      menuToggle.innerHTML = mobileMenu.classList.contains('active')
        ? `<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
           </svg>`
        : `<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
           </svg>`;

      adjustBodyPadding();
    });
  }

  window.addEventListener("load", adjustBodyPadding);
  window.addEventListener("resize", adjustBodyPadding);
  window.addEventListener("scroll", function () {
    if (!header) return;

    if (window.scrollY > 50) {
      header.classList.add("scrolled");
      headerLinks.forEach(link => link.classList.add("scrolled"));
    } else {
      header.classList.remove("scrolled");
      headerLinks.forEach(link => link.classList.remove("scrolled"));
    }

    adjustBodyPadding();
  });

  if (window.ResizeObserver && header) {
    const resizeObserver = new ResizeObserver(() => {
      adjustBodyPadding();
    });
    resizeObserver.observe(header);
  }
});
