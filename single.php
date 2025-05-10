<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if (have_posts()):
        while (have_posts()):

            the_post();
            // Get post type/category information
            $post_categories = get_the_category();
            $is_recipe = false;
            $is_travel = false;
            $is_review = false;

            foreach ($post_categories as $category) {
                if ($category->slug === 'recipes') {
                    $is_recipe = true;
                }
                if ($category->slug === 'travel') {
                    $is_travel = true;
                }
                if ($category->slug === 'reviews') {
                    $is_review = true;
                }
            }
            ?>

    <article class="max-w-3xl mx-auto">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs text-sm text-slateGray mb-4">
            <a href="<?php echo home_url(); ?>" class="hover:underline text-mutedPink">Home</a>
            <?php if (is_category() || is_single()): ?>
            <span class="mx-2">/</span>
            <?php
                    $category = get_the_category();
                    if ($category) {
                        $first_category = $category[0];
                        echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '" class="hover:underline text-mutedPink">' . esc_html($first_category->name) . '</a>';
                    }
                    ?>
            <?php endif; ?>
            <?php if (is_single()): ?>
            <span class="mx-2">/</span>
            <span><?php the_title(); ?></span>
            <?php endif; ?>
        </div>
        <!-- Clean header without card styling -->
        <h1 class="text-4xl font-recoleta text-darkBrown mb-4"><?php the_title(); ?></h1>

        <?php if (
                $is_recipe &&
                ($subtitle = get_post_meta(
                    get_the_ID(),
                    '_tc_post_subtitle',
                    true
                ))
            ): ?>
        <h2 class="text-2xl text-slateGray mb-4"><?php echo esc_html(
                    $subtitle
                ); ?></h2>
        <?php endif; ?>

        <div class="text-sm text-slateGray font-dmsans mb-8">
            <span>Published on <?php the_date(); ?></span>
            <span class="mx-2">|</span>
            <span>By <?php the_author(); ?></span>
        </div>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()): ?>
        <div class="mb-8">
            <?php the_post_thumbnail('landscape', [
                'class' => 'w-full h-auto rounded-lg',
            ]); ?>
        </div>
        <?php endif; ?>

        <!-- Post Type Specific Content -->
        <?php // Recipe details
            if ($is_recipe):
                $cooking_time = get_post_meta(
                    get_the_ID(),
                    '_tc_cooking_time',
                    true
                );
                $difficulty = get_post_meta(
                    get_the_ID(),
                    '_tc_difficulty',
                    true
                );
                $servings = get_post_meta(get_the_ID(), '_tc_servings', true);
                $prep_time = get_post_meta(get_the_ID(), '_tc_prep_time', true);
                $ingredients = get_post_meta(get_the_ID(), '_tc_ingredients', true);

                if ($cooking_time || $difficulty || $servings || $prep_time): ?>
        <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php if ($prep_time): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium font-recoleta text-darkBrown">Prep Time</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $prep_time
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($cooking_time): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium font-recoleta text-darkBrown">Cook Time</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $cooking_time
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($difficulty): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium font-recoleta text-darkBrown">Difficulty</p>
                        <p class="text-slateGray capitalize"><?php echo esc_html(
                                            $difficulty
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($servings): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium font-recoleta text-darkBrown">Servings</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $servings
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif;

                if ($ingredients): ?>
        <!-- Ingredients Block -->
        <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Ingredients</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">
                <?php
                $ingredients_array = explode("\n", $ingredients);
                foreach ($ingredients_array as $ingredient):
                    if (trim($ingredient)): ?>
                <div class="flex items-start space-x-3">
                    <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-mutedPink mt-2"></span>
                    <p class="flex-1 font-dmsans text-slateGray"><?php echo esc_html(
                                            trim($ingredient)
                                        ); ?></p>
                </div>
                <?php endif;
                endforeach;
                ?>
            </div>
        </div>
        <?php endif;

                // Travel details

                // Review details
            elseif ($is_travel):
                $location = get_post_meta(get_the_ID(), '_tc_location', true);
                $duration = get_post_meta(get_the_ID(), '_tc_duration', true);
                $best_season = get_post_meta(
                    get_the_ID(),
                    '_tc_best_season',
                    true
                );
                $cost_rating = get_post_meta(
                    get_the_ID(),
                    '_tc_cost_rating',
                    true
                );
                $highlights = get_post_meta(
                    get_the_ID(),
                    '_tc_highlights',
                    true
                );

                if (
                    $location ||
                    $duration ||
                    $best_season ||
                    $cost_rating ||
                    $highlights
                ): ?>
        <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
            <!-- Quick Info Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php if ($location): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Location</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $location
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($duration): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Duration</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $duration
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($best_season): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Best Season</p>
                        <p class="text-slateGray capitalize"><?php echo esc_html(
                                            $best_season
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($cost_rating): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Cost Level</p>
                        <p class="text-slateGray capitalize"><?php echo esc_html(
                                            $cost_rating
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($highlights): ?>
        </div> <!-- closes the 4-column card -->

        <!-- Separate Highlights Card -->
        <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
            <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Trip Highlights</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">
                <?php
                            $highlights_array = explode("\n", $highlights);
                            foreach ($highlights_array as $highlight):
                                if (trim($highlight)): ?>
                <div class="flex items-start space-x-3">
                    <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-mutedPink mt-2"></span>
                    <p class="flex-1 font-dmsans text-slateGray"><?php echo esc_html(
                                            trim($highlight)
                                        ); ?></p>
                </div>
                <?php endif;
                            endforeach;
                            ?>
            </div>
        </div>
        <?php endif; ?>
        </div>
        <?php endif;
            elseif ($is_review):
                $product_name = get_post_meta(
                    get_the_ID(),
                    '_tc_product_name',
                    true
                );
                $rating = get_post_meta(get_the_ID(), '_tc_rating', true);
                $price = get_post_meta(get_the_ID(), '_tc_price', true);
                $brand = get_post_meta(get_the_ID(), '_tc_brand', true);

                if ($rating || $price || $brand): ?>
        <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if ($rating): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976-2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Rating</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $rating
                                        ); ?> / 5</p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($price): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Price</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $price
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($brand): ?>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-darkBrown">Brand</p>
                        <p class="text-slateGray"><?php echo esc_html(
                                            $brand
                                        ); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif;

                $pros = get_post_meta(get_the_ID(), '_tc_pros', true);
                $cons = get_post_meta(get_the_ID(), '_tc_cons', true);

                if ($pros || $cons): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <?php if ($pros): ?>
            <div class="bg-offWhite shadow-md p-6 rounded-lg">
                <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Pros</h3>
                <div class="grid grid-cols-1 gap-y-3">
                    <?php
                                    $pros_array = explode("\n", $pros);
                                    foreach ($pros_array as $pro):
                                        if (trim($pro)): ?>
                    <div class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-mutedPink mt-2"></span>
                        <p class="flex-1 font-dmsans text-slateGray"><?php echo esc_html(
                                                    trim($pro)
                                                ); ?></p>
                    </div>
                    <?php endif;
                                    endforeach;
                                    ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($cons): ?>
            <div class="bg-offWhite shadow-md p-6 rounded-lg">
                <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Cons</h3>
                <div class="grid grid-cols-1 gap-y-3">
                    <?php
                                    $cons_array = explode("\n", $cons);
                                    foreach ($cons_array as $con):
                                        if (trim($con)): ?>
                    <div class="flex items-start space-x-3">
                        <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-mutedPink mt-2"></span>
                        <p class="flex-1 font-dmsans text-slateGray"><?php echo esc_html(
                                                    trim($con)
                                                ); ?></p>
                    </div>
                    <?php endif;
                                    endforeach;
                                    ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif;
            endif; ?>

        <!-- Main Content -->
        <div class="prose prose-lg max-w-none font-dmsans text-darkBrown mb-8">
            <?php the_content(); ?>
        </div>

        <!-- Author Box -->
        <div class="bg-offWhite rounded-lg shadow-md p-6 mt-12">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <?php echo get_avatar(
                            get_the_author_meta('ID'),
                            64,
                            '',
                            '',
                            ['class' => 'rounded-full']
                        ); ?>
                </div>
                <div>
                    <p class="text-darkBrown font-recoleta text-lg">
                        Written by <a href="<?php echo get_author_posts_url(
                                get_the_author_meta('ID')
                            ); ?>" class="text-mutedPink hover:underline">
                            <?php the_author(); ?>
                        </a>
                    </p>
                    <p class="text-slateGray font-dmsans text-sm mt-1">
                        <?php echo get_the_author_meta('description') ?:
                                'I love travel, art (especially exhibitions in Brussels), and when I\'m not eating out, I\'m usually cooking up something delicious.'; ?>
                    </p>
                </div>
            </div>
        </div>

    </article>
    <?php
        endwhile;
    endif; ?>
</main>

<?php get_footer(); ?>