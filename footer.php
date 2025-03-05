<footer class="bg-offWhite py-12">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Logo & Social Links -->
        <div class="flex flex-col gap-4">
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TC logo.png" alt="Footer Logo" class="w-10 h-10">
                <span class="text-lg font-bold font-recoleta text-mutedPink">Travelling Cooks</span>
            </a>
            <div class="flex gap-4">
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Social_media_2/facebook.svg" alt="Facebook" class="w-6 h-6"></a>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Social_media_2/instagram.svg" alt="Instagram" class="w-6 h-6"></a>
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/Social_media_2/twitter.svg" alt="Twitter" class="w-6 h-6"></a>
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
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Pinterest</a></li>
                <li><a href="#">Twitter</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="text-lg font-bold font-buffalo mb-4">Travelling Cooks</h4>
            <p class="text-sm text-montserrat text-gray-600 mb-4">Stay updated with our latest travel and cooking adventures.</p>
            <form class="flex flex-col gap-4">
                <input type="email" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300" placeholder="Email address">
                <button class="bg-mutedPink text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</footer>