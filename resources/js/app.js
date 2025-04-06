// console.log("🔥 app.js is being executed!");

document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('primary-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

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
});
