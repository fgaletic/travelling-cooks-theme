<?php get_header(); ?>

<section class="hero-section bg-gradient-to-r from-orange-50 to-white px-6 py-12">
    <div class="grid md:grid-cols-2 items-center">
        <div>
            <h1>
                Exploring the World, <br> One Dish at a Time
            </h1>
            <p>
                Join us on a journey of culinary and travel adventures.
            </p>
        </div>
        <div class="flex justify-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpg" alt="Hero Image" class="rounded-lg shadow-lg w-80">
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
        <?php endwhile; wp_reset_query(); ?>
    </div>
</section>

<?php get_footer(); ?>
