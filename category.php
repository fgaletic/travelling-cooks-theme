<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-recoleta text-darkBrown mb-8">
        <?php
        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        }
        ?>
    </h1>

    <?php
    // Store the initial query
    $main_query = $wp_query;
    $category = get_queried_object();

    // Get subcategories if they exist
    $subcategories = get_categories([
        'parent' => $category->term_id,
        'hide_empty' => true
    ]);

    // Show subcategories if they exist
    if (!empty($subcategories)) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php foreach ($subcategories as $subcat) : 
                // Get the first post image from this subcategory to use as thumbnail
                $subcat_posts = get_posts([
                    'category' => $subcat->term_id,
                    'posts_per_page' => 1,
                    'meta_key' => '_thumbnail_id'
                ]);
                $thumbnail_url = get_the_post_thumbnail_url($subcat_posts[0], 'card-thumbnail');
            ?>
                <a href="<?php echo get_category_link($subcat->term_id); ?>" 
                   class="relative h-[300px] rounded-lg overflow-hidden group">
                    <?php if ($thumbnail_url) : ?>
                        <img src="<?php echo $thumbnail_url; ?>" 
                             alt="<?php echo $subcat->name; ?>"
                             class="w-full h-full object-cover">
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-all flex items-center justify-center">
                        <h2 class="text-3xl font-recoleta text-white text-center px-4">
                            <?php echo $subcat->name; ?>
                        </h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php
    // Special layout for main categories
    if (is_category(['travel', 'recipes', 'reviews'])) :
    ?>
        <!-- Featured Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php
            $featured_args = array(
                'category_name' => $category->slug,
                'posts_per_page' => 6,
                'meta_key' => 'featured_post',
                'meta_value' => 'yes'
            );
            $featured_query = new WP_Query($featured_args);

            if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post();
            ?>
                <div class="flip-card h-[300px]">
                    <div class="flip-card-inner relative w-full h-full">
                        <div class="flip-card-front absolute w-full h-full">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('card-thumbnail', ['class' => 'w-full h-full object-cover rounded-lg']); ?>
                                <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg flex items-center justify-center">
                                    <h2 class="text-3xl font-recoleta text-white text-center px-4"><?php the_title(); ?></h2>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flip-card-back absolute w-full h-full bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-recoleta text-darkBrown mb-4"><?php the_title(); ?></h2>
                            <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

    <?php if (is_category('reviews')) : 
        // Get featured reviews
        $featured_reviews = get_posts([
            'category_name' => 'reviews',
            'meta_key' => '_tc_featured_review',
            'meta_value' => '1',
            'posts_per_page' => 5
        ]);

        if (!empty($featured_reviews)) : ?>
            <section class="mb-16">
                <h2 class="text-3xl font-recoleta text-darkBrown mb-6">Top Recommendations</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($featured_reviews as $post) : setup_postdata($post);
                        $rating = get_post_meta($post->ID, '_tc_rating', true);
                        $price = get_post_meta($post->ID, '_tc_price', true);
                        $quick_note = get_post_meta($post->ID, '_tc_quick_note', true);
                        $affiliate_link = get_post_meta($post->ID, '_tc_affiliate_link_amazon', true);
                    ?>
                        <article class="bg-white rounded-lg shadow-md overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="aspect-w-3 aspect-h-2 overflow-hidden">
                                    <?php the_post_thumbnail('card-thumbnail', [
                                        'class' => 'w-full h-full object-cover rounded-lg',
                                        'loading' => 'lazy'
                                    ]); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <!-- Rating and Price -->
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex text-mutedPink">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <span class="<?php echo $i <= $rating ? 'text-mutedPink' : 'text-gray-300'; ?>">★</span>
                                        <?php endfor; ?>
                                    </div>
                                    <?php if ($price) : ?>
                                        <span class="text-slateGray font-medium"><?php echo esc_html($price); ?></span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="text-xl font-recoleta text-darkBrown mb-2">
                                    <?php 
                                    $short_title = get_post_meta($post->ID, '_tc_short_title', true);
                                    if ($short_title) {
                                        echo esc_html($short_title);
                                    } else {
                                        the_title();
                                    } 
                                    ?>
                                </h3>

                                <?php if ($quick_note) : ?>
                                    <p class="text-sm text-mutedPink italic mb-4"><?php echo esc_html($quick_note); ?></p>
                                <?php endif; ?>

                                <div class="flex gap-3">
                                    <a href="<?php the_permalink(); ?>" 
                                       class="inline-block px-4 py-2 bg-mutedPink bg-opacity-10 text-mutedPink rounded-lg hover:bg-opacity-20 transition-colors">
                                        Read Review
                                    </a>
                                    <?php if ($affiliate_link) : ?>
                                        <a href="<?php echo esc_url($affiliate_link); ?>" 
                                           target="_blank" 
                                           rel="nofollow sponsored" 
                                           class="inline-block px-4 py-2 bg-mutedPink text-white rounded-lg hover:bg-opacity-90 transition-colors">
                                            Check Price
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php 
                    endforeach;
                    wp_reset_postdata(); 
                    ?>
                </div>
            </section>
        <?php endif;
    endif; ?>

    <h2 class="text-3xl font-recoleta text-darkBrown mb-8">All <?php echo $category->name; ?></h2>
    <?php endif; ?>

    <!-- Standard Grid Layout for All Posts -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        if ($main_query->have_posts()) : while ($main_query->have_posts()) : $main_query->the_post();
        ?>
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-w-3 aspect-h-2 overflow-hidden">
                        <?php the_post_thumbnail('card-thumbnail', [
                            'class' => 'w-full h-full object-cover rounded-lg',
                            'loading' => 'lazy'
                        ]); ?>
                    </div>
                <?php endif; ?>
                <div class="p-6">
                    <!-- Category chips -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) :
                            if ($category->parent != 0) : // Only show subcategories
                        ?>
                            <span class="inline-block px-2 py-1 text-xs font-dmsans bg-mutedPink bg-opacity-10 text-mutedPink rounded">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>

                    <h2 class="text-2xl font-recoleta text-darkBrown mb-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <!-- Reading time estimate -->
                    <p class="text-sm text-slateGray mb-3">
                        <i class="fas fa-clock mr-1"></i>
                        <?php 
                        $content = get_the_content();
                        $word_count = str_word_count(strip_tags($content));
                        $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
                        echo sprintf(_n('%d min read', '%d min read', $reading_time, 'travelling-cooks'), $reading_time);
                        ?>
                    </p>

                    <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors">Read More</a>
                </div>
            </article>
        <?php endwhile;
        endif;
        ?>
    </div>

    <div class="mt-12">
        <?php the_posts_pagination(); ?>
    </div>
</main>

<?php get_footer(); ?>