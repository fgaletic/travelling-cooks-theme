<footer class="bg-offWhite py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Logo & Social Links -->
        <div class="flex flex-col gap-4">
        <a href="<?php echo home_url(); ?>" class="flex items-center gap-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TC logo.png" alt="Footer Logo" class="w-10 h-10">
                <span class="text-2xl font-bold font-buffalo text-mutedPink">Travelling Cooks</span>
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
            <ul class="space-y-2">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><a href="<?php echo home_url('/blog'); ?>">Blog</a></li>
                <li><a href="<?php echo home_url('/about-us'); ?>">About Us</a></li>
                <li><a href="<?php echo home_url('/contact'); ?>">Contact Us</a></li>
            </ul>
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
            <form class="flex flex-col gap-4">
                <input type="email" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" placeholder="Email address">
                <button class="bg-mutedPink text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</footer>