<?php get_header(); ?>

<section class="intro-with-bg bg-offWhite px-6 py-12 text-center">
    <div class="max-w-screen-xl mx-auto min-h-[40vh] flex flex-col justify-center items-center">
        <h1 class="text-[48px] md:text-[64px] sm:text-[36px] font-recoleta text-darkBrown">
            <?php echo get_theme_mod(
                'hero_title',
                'Welcome to my world of travel and food'
            ); ?>
        </h1>
        <p class="text-lg sm:text-xl font-dmsans text-darkBrown mt-4">
            <?php echo get_theme_mod(
                'hero_subtitle',
                '..where I navigate this exciting chapter of my life in my fabulous 50ish ++'
            ); ?>
        </p>
    </div>
</section>

<section class="latest-posts px-6 py-12 pb-9">
    <div class="flex justify-center items-center">
        <h2 class="text-3xl text-slateGray font-bold font-recoleta">This Month's Featured Posts</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        <?php
        $query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
        ]);
        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post(); ?>
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                <div class="image-container">
                    <?php the_post_thumbnail('large', [
                                    'class' => 'w-full h-full object-cover',
                                ]); ?>
                </div>
                <?php endif; ?>
            </a>
            <div class="p-6">
                <h2 class="text-2xl font-recoleta text-darkBrown mb-2">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
            </div>
        </article>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<section class="destinations px-6 py-12 min-h-[30vh]">
    <div class="max-w-screen-xl mx-auto">
        <h2 class="text-5xl font-recoleta text-center mb-6">Where to next?</h2>

        <!-- Map for larger screens -->
        <div class="hidden sm:block">
            <?php get_template_part('template-parts/map-pins'); ?>
        </div>
    </div>
    </div>

    <!-- Destination chips for small screens -->
    <div class="block sm:hidden px-4 mb-6">
        <div class="flex flex-wrap justify-center items-center gap-3">
            <?php
        $destinations = get_option('destination_meta', []);

        foreach ($destinations as $destination) {
            $country = esc_html($destination['country']);
            $icon = esc_attr($destination['icon']);

            // Match tag *by name*, case-insensitive
            $tag = get_term_by('name', $country, 'post_tag');

            // Only show the chip if the tag exists and has posts
            if ($tag && $tag->count > 0) {
                $tag_link = get_tag_link($tag->term_id);
                echo "<a href='" . esc_url($tag_link) . "' class='destination-chip bg-offWhite hover:bg-mutedPink text-darkBrown border border-gray-300 px-4 py-2 rounded-full flex items-center gap-2 transition'>
                        <i class='$icon'></i>
                        <span>$country</span>
                      </a>";
            }
        }
        ?>
        </div>
    </div>
    </div>
</section>

<?php get_footer(); ?>