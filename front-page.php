<?php get_header(); ?>

<section class="intro-section bg-offWhite px-6 py-12 text-center">
    <div class="max-w-screen-xl mx-auto margin-top:[25rem] min-h-[30vh] flex flex-col justify-center items-center">
        <h1 class="text-[48px] md:text-[64px] sm:text-[36px] font-recoleta text-darkBrown">
            Welcome to my world of travel and food
        </h1>
        <p class="text-lg sm:text-xl font-dmsans text-darkBrown mt-4">
            ..where I navigate this exciting chapter of my life in my fabulous 50ish ++
        </p>
    </div>
</section>

<section class="latest-posts px-6 py-12">
    <div class="flex justify-center items-center">
        <h2 class="text-3xl text-slateGray font-bold font-recoleta">This Month's Featured Posts</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        <?php
        $args = array(
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC', // Display the newest posts first
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                     <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="image-container">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="p-6">
                        <h2 class="text-2xl font-recoleta text-darkBrown mb-2">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors">Read More</a>
                    </div>
                </article>
        <?php
            endwhile;
            wp_reset_postdata(); // Restore original Post Data
        else :
            echo '<p>No posts found</p>';
        endif;
        ?>
    </div>
</section>

<section class="destinations px-6 py-12 min-h-[30vh]">
    <div class="max-w-screen-xl mx-auto">
        <h2 class="text-5xl font-recoleta text-center mb-6">Where to next?</h2>
        <div class="flex justify-center items-center mx-auto gap-3">
            <button class="destination-chip">
                <i class="fas fa-torii-gate"></i>
                <span>Japan</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-pizza-slice"></i>
                <span>Italy</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-landmark"></i>
                <span>United Kingdom</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-beer"></i>
                <span>Belgium</span>
            </button>
        </div>
    </div>
</section>

<?php get_footer(); ?>
