// console.log("🔥 app.js is being executed!");

document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('primary-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const header = document.querySelector(".header");
    const headerLinks = header.querySelectorAll("a"); // Select all <a> elements inside the header

    menuToggle.addEventListener('click', function () {
        mobileMenu.classList.toggle('active');

        // Change icon dynamically
        if (mobileMenu.classList.contains('active')) {
            menuToggle.innerHTML = `<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                  </svg>`;
        } else {
            menuToggle.innerHTML = `<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                  </svg>`;
        }
    });

    function adjustBodyPadding() {
        if (!header) return;
        const headerHeight = header.offsetHeight;
        document.body.style.paddingTop = `${headerHeight}px`;
    }

    window.addEventListener("load", adjustBodyPadding);
    window.addEventListener("resize", adjustBodyPadding);
    window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
            headerLinks.forEach(link => link.classList.add("scrolled")); // Add scrolled to all <a>
        } else {
            header.classList.remove("scrolled");
            headerLinks.forEach(link => link.classList.remove("scrolled")); // Remove scrolled from all <a>
        }
        adjustBodyPadding(); // Recalculate on scroll
    });
});
