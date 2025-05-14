<footer class="bg-offWhite py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Logo & Social Links -->
        <div class="flex flex-col gap-4 items-center sm:items-start text-center sm:text-left">
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-2 -mx-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/travelling-cooks-logo.svg"
                    alt="Footer Logo" class="w-10 h-10">
                <span class="-ml-2 text-2xl font-bold font-buffalo text-mutedPink">Travelling Cooks</span>
            </a>
            <div class="flex gap-4">
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram text-2xl text-slateGray hover:text-mutedPink"></i>
                </a>
                <a href="https://www.pinterest.com" target="_blank" aria-label="Pinterest">
                    <i class="fab fa-pinterest text-2xl text-slateGray hover:text-mutedPink"></i>
                </a>
                <a href="https://www.tiktok.com" target="_blank" aria-label="TikTok">
                    <i class="fab fa-tiktok text-2xl text-slateGray hover:text-mutedPink"></i>
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="text-lg font-bold font-recoleta mb-4">Quick Links</h4>
            <?php wp_nav_menu([
                'theme_location' => 'footer',
                'menu_class' => 'space-y-2',
                'container' => false,
                'fallback_cb' => false,
            ]); ?>
        </div>

        <!-- Follow Us -->
        <div>
            <h4 class="text-lg font-bold font-recoleta mb-4">Follow Us</h4>
            <ul class="space-y-2">
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Pinterest</a></li>
                <li><a href="#">TikTok</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="text-lg font-bold font-recoleta mb-4">Newsletter</h4>
            <p class="text-sm text-dmsans text-gray-600 mb-4">Stay updated with our latest travel and cooking
                adventures.</p>
            <form id="newsletterForm" method="POST" action="javascript:void(0);" class="flex flex-col gap-4">
                <!-- 🛡️ Honeypot field -->
                <input type="text" name="_gotcha" class="hidden" style="display:none">
                <div id="newsletterSuccess"
                    class="hidden text-green-600 font-dmsans p-2 pr-8 bg-green-100 rounded-lg shadow-sm relative flex items-center min-h-[44px]">
                    <span id="newsletterSuccessMsg" class="flex-1"></span>
                    <button type="button" id="newsletterSuccessClose"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-lg leading-none text-gray-400 hover:text-gray-700 px-1"
                        aria-label="Close">&times;</button>
                </div>
                <input type="email" name="email" required
                    class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300"
                    placeholder="Email address">
                <button type="submit" class="bg-mutedPink text-white py-2 px-4 rounded-lg hover:bg-darkBrown">
                    Subscribe
                </button>
            </form>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("newsletterForm");
                const successBox = document.getElementById("newsletterSuccess");
                const successMsg = document.getElementById("newsletterSuccessMsg");
                const closeBtn = document.getElementById("newsletterSuccessClose");

                form.addEventListener("submit", async function(e) {
                    e.preventDefault();
                    const formData = new FormData(form);

                    try {
                        // Replace the Formspree endpoint below with your own Formspree form ID!
                        // See https://formspree.io/ for instructions.
                        const res = await fetch("https://formspree.io/f/xwpoapnw", {
                            method: "POST",
                            body: formData,
                            headers: {
                                Accept: "application/json"
                            }
                        });

                        if (res.ok) {
                            successMsg.textContent = "Thanks for subscribing!";
                            successBox.classList.remove("hidden");
                            successBox.classList.add("fade-in-up", "show");
                            form.reset();
                        } else {
                            successMsg.textContent =
                                "Oops! Something went wrong. Please try again.";
                            successBox.classList.remove("hidden");
                            successBox.classList.replace("text-green-600", "text-red-600");
                            successBox.classList.replace("bg-green-100", "bg-red-100");
                        }
                    } catch (err) {
                        successMsg.textContent = "Network error. Please try again later.";
                        successBox.classList.remove("hidden");
                        successBox.classList.replace("text-green-600", "text-red-600");
                        successBox.classList.replace("bg-green-100", "bg-red-100");
                    }
                });

                closeBtn.addEventListener("click", function() {
                    successBox.classList.add("hidden");
                });
            });
            </script>
        </div>
    </div>
</footer>

<!-- Bottom Footer Bar -->
<div class="bg-gray-50 py-2 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 items-start">
        <div class="text-center sm:text-left text-xs text-gray-500">
            &copy; <?php echo date('Y'); ?> Travelling Cooks. All rights reserved.
            <span class="block text-[10px] text-gray-400 mt-1">
                Website by <a href="https://allio.li" target="_blank" rel="noopener"
                    class="hover:text-mutedPink underline">Allioli – Web App Studio</a>
            </span>
        </div>
        <div class="flex gap-2 mt-1 sm:mt-0 text-xs text-gray-400">
            <a href="/privacy-policy" class="hover:text-mutedPink">Privacy Policy</a>
            <a href="/terms-of-service" class="hover:text-mutedPink">Terms of Service</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create the button
    var button = document.createElement('button');
    button.innerHTML = '<i class="fas fa-arrow-up"></i>';
    button.className =
        'back-to-top hidden fixed bottom-4 right-4 bg-mutedPink hover:bg-darkBrown text-white p-3 rounded-full shadow-lg transition-all';
    document.body.appendChild(button);

    // Show/hide button based on scroll position
    window.onscroll = function() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    };

    // Scroll to top when clicked
    button.onclick = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
});
</script>