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

<section class="latest-posts px-6 py-12">
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
            <div class="map-wrapper relative w-full max-w-[900px] mx-auto">
                <div class="aspect-[2/1] w-full relative">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TC_Map.png"
                         alt="World Map"
                         class="absolute inset-0 w-full h-full object-cover rounded-lg shadow" />
                    
                    <!-- PINS GO HERE -->
                    <a href="/tag/japan" class="pin" style="top: 45%; left: 86%;" title="Japan">
                        <span class="pin-label">Japan</span>
                    </a>
                    <a href="/tag/united-kingdom" class="pin" style="top: 36%; left: 46%;" title="United Kingdom">
                        <span class="pin-label">UK</span>
                    </a>
                    <a href="/tag/belgium" class="pin" style="top: 38%; left: 47%;" title="Belgium">
                        <span class="pin-label">Belgium</span>
                    </a>
                    <a href="/tag/italy" class="pin" style="top: 43%; left: 50%;" title="Italy">
                        <span class="pin-label">Italy</span>
                    </a>
                    <a href="/tag/morocco" class="pin" style="top: 52%; left: 43%;" title="Morocco">
                        <span class="pin-label">Morocco</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Destination chips for small screens -->
        <div class="block sm:hidden">
            <div class="flex justify-center items-center mx-auto gap-3">
                <?php
                $destinations = get_option('destination_meta', []);

                foreach ($destinations as $destination):
                    $country = esc_html($destination['country']);
                    $icon = esc_attr($destination['icon']);

                    // Get the tag or create it if it doesn't exist
                    $tag = get_term_by('name', $country, 'post_tag');
                    if (!$tag) {
                        $tag_result = wp_insert_term($country, 'post_tag');
                        if (!is_wp_error($tag_result)) {
                            $tag = get_term_by(
                                'id',
                                $tag_result['term_id'],
                                'post_tag'
                            );
                        }
                    }

                    // Only show the link if we have a valid tag
                    if ($tag) {
                        $tag_link = get_tag_link($tag->term_id); ?>
                        <a href="<?php echo esc_url(
                            $tag_link
                        ); ?>" class="destination-chip">
                            <i class="<?php echo $icon; ?>"></i>
                            <span><?php echo $country; ?></span>
                        </a>
                    <?php
                    }
                endforeach;
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
