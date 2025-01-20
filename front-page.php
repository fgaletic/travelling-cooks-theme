<?php get_header(); ?>

<section class="hero-section bg-gradient-to-r from-orange-50 to-white px-6 py-12">
    <div class="max-w-screen-xl mx-auto grid md:grid-cols-2 items-center">
        <!-- Text Content -->
        <div>
            <h1 class="text-[120px] md:text-[96px] sm:text-[72px] leading-[120px] md:leading-[96px] sm:leading-[72px] font-bold tracking-tight text-darkGray max-w-[775px]">
                Exploring the World, <br> One Dish at a Time
            </h1>
            <p class="text-lg sm:text-base font-outfit text-gray-700 opacity-70 mt-4 max-w-[600px]">
                Join us on a journey of culinary and travel adventures.
            </p>
        </div>

        <!-- Image -->
        <div class="flex">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero_image.svg" alt="Hero Image" class="h-auto w-full object-cover">
        </div>
    </div>
</section>

<section class="latest-posts px-6 py-12">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-domine">Latest Blog Posts</h2>
        <a href="<?php echo home_url('/blog'); ?>" class="text-orange-500 hover:underline">See all</a>
    </div>
    <div class="blog-preview grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <?php
        // Commenting out the dynamic WordPress query for now
        /*
        $latest_posts = new WP_Query(array('posts_per_page' => 6));
        while ($latest_posts->have_posts()) : $latest_posts->the_post();
        ?>
        <article>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
                <div>
                    <p><?php the_category(', '); ?></p>
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_date(); ?></p>
                </div>
            </a>
        </article>
        <?php endwhile; wp_reset_query(); 
        */
        ?>

        <!-- Hardcoded blog preview articles -->
        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/northern-lights.png" alt="Northern Lights" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Travel, Photography</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">Capturing the Northern Lights</h3>
                    <p class="text-sm text-gray-500 font-outfit">October 12, 2024</p>
                </div>
            </a>
        </article>

        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/japanese-temple.png" alt="Japanese Temple" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Travel, Culture</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">A Cultural Tour of Kyoto</h3>
                   <p class="text-sm text-gray-500 font-outfit">September 22, 2024</p>
                </div>
            </a>
        </article>

        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/vegan-tacos.png" alt="Vegan Tacos" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Recipes, Vegan</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">Vegan Tacos with Avocado Cream</h3>
                   <p class="text-sm text-gray-500 font-outfit">September 18, 2024</p>
                </div>
            </a>
        </article>

        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/thai-market.png" alt="Thai Market" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Travel, Food</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">Exploring the Street Foods of Bangkok</h3>
                   <p class="text-sm text-gray-500 font-outfit">October 3, 2024</p>
                </div>
            </a>
        </article>

        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/lava-cake.png" alt="Chocolate Lava Cake" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Recipes, Desserts</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">Decadent Chocolate Lava Cake</h3>
                    <p class="text-sm text-gray-500 font-outfit">September 15, 2024</p>
                </div>
            </a>
        </article>

        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/patagonian-landscape.png" alt="Patagonia Hiking" class="w-full h-48 object-cover">
                <div>
                    <p class="text-sm text-orange-500 font-medium font-outfit">Travel, Adventure</p>
                    <h3 class="text-lg font-bold text-gray-800 font-outfit">Hiking the Trails of Patagonia</h3>
                    <p class="text-sm text-gray-500 font-outfit">September 30, 2024</p>
                </div>
            </a>
        </article>
    </div>
</section>

<?php get_footer(); ?>