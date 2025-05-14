<footer class="bg-offWhite py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Logo & Social Links -->
        <div class="flex flex-col gap-4">
        <a href="<?php echo home_url(); ?>" class="flex items-center gap-2 -mx-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/travelling-cooks-logo.svg'" alt="Footer Logo" class="w-10 h-10">
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
            <p class="text-sm text-dmsans text-gray-600 mb-4">Stay updated with our latest travel and cooking adventures.</p>

            <?php if (class_exists('GFForms')): ?>
                <!-- Gravity Forms Integration -->
                <?php 
                // To use Gravity Forms, uncomment the line below and replace "1" with your Gravity Form ID.
                // echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); 
                ?>
                <p class="text-sm text-gray-500 italic">Gravity Forms is active. Add your form shortcode above.</p>
            <?php else: ?>
                <!-- Fallback Form -->
                <form class="flex flex-col gap-4">
                    <input type="email" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" placeholder="Email address">
                    <button class="bg-mutedPink text-white py-2 px-4 rounded-lg hover:bg-darkBrown">
                        Subscribe
                    </button>
                </form>
                <!-- <p class="text-sm text-gray-500 italic">Gravity Forms is not active. Using fallback form.</p> -->
            <?php endif; ?>
        </div>
    </div>
</footer>

<!-- Bottom Footer Bar -->
<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
        <div>
            &copy; <?php echo date(
                'Y'
            ); ?> Travelling Cooks. All rights reserved.
        </div>
        <div class="flex gap-4 mt-2 sm:mt-0">
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
    button.className = 'back-to-top hidden fixed bottom-4 right-4 bg-mutedPink hover:bg-darkBrown text-white p-3 rounded-full shadow-lg transition-all';
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
        window.scrollTo({top: 0, behavior: 'smooth'});
    };
});
</script>