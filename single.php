<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-recoleta text-darkBrown mb-4"><?php the_title(); ?></h1>
            <?php 
            $subtitle = get_post_meta(get_the_ID(), '_tc_post_subtitle', true);
            if ($subtitle) : ?>
                <h2 class="text-2xl text-slateGray mb-4"><?php echo esc_html($subtitle); ?></h2>
            <?php endif; ?>
            
            <div class="mb-6 text-slateGray font-dmsans">
                <span>Published on <?php the_date(); ?></span>
                <span class="mx-2">|</span>
                <span>By <?php the_author(); ?></span>
            </div>

            <?php 
            $cooking_time = get_post_meta(get_the_ID(), '_tc_cooking_time', true);
            $difficulty = get_post_meta(get_the_ID(), '_tc_difficulty', true);
            $servings = get_post_meta(get_the_ID(), '_tc_servings', true);
            $prep_time = get_post_meta(get_the_ID(), '_tc_prep_time', true);

            if ($cooking_time || $difficulty || $servings || $prep_time) : ?>
                <div class="bg-offWhite shadow-md rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <?php if ($prep_time) : ?>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-darkBrown">Prep Time</p>
                                    <p class="text-slateGray"><?php echo esc_html($prep_time); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($cooking_time) : ?>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-darkBrown">Cook Time</p>
                                    <p class="text-slateGray"><?php echo esc_html($cooking_time); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($difficulty) : ?>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-darkBrown">Difficulty</p>
                                    <p class="text-slateGray capitalize"><?php echo esc_html($difficulty); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($servings) : ?>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <span class="inline-block p-2 bg-mutedPink bg-opacity-10 rounded-lg text-mutedPink">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-darkBrown">Servings</p>
                                    <p class="text-slateGray"><?php echo esc_html($servings); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
                </div>
            <?php endif; ?>

            <?php
            // Get post type/category information
            $post_categories = get_the_category();
            $is_recipe = false;
            $is_travel = false;
            $is_review = false;

            foreach ($post_categories as $category) {
                if ($category->slug === 'recipes') $is_recipe = true;
                if ($category->slug === 'travel') $is_travel = true;
                if ($category->slug === 'reviews') $is_review = true;
            }

            // Recipe-specific meta
            if ($is_recipe) :
                $ingredients = get_post_meta(get_the_ID(), '_tc_ingredients', true);
                $tips = get_post_meta(get_the_ID(), '_tc_tips', true);
                $cuisine = get_post_meta(get_the_ID(), '_tc_cuisine', true);
                $calories = get_post_meta(get_the_ID(), '_tc_calories', true);
                $prep_time = get_post_meta(get_the_ID(), '_tc_prep_time', true);
                
                if ($ingredients || $tips) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <?php if ($ingredients) : ?>
                            <div class="bg-offWhite shadow-md p-6 rounded-lg">
                                <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Ingredients</h3>
                                <div class="space-y-2 font-dmsans text-slateGray">
                                    <?php echo wp_kses_post(nl2br($ingredients)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($tips) : ?>
                            <div class="bg-offWhite shadow-md p-6 rounded-lg">
                                <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Tips & Notes</h3>
                                <div class="space-y-2 font-dmsans text-slateGray">
                                    <?php echo wp_kses_post(nl2br($tips)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif;

            // Travel-specific meta
            elseif ($is_travel) :
                $location = get_post_meta(get_the_ID(), '_tc_location', true);
                $duration = get_post_meta(get_the_ID(), '_tc_duration', true);
                $best_time = get_post_meta(get_the_ID(), '_tc_best_time', true);
                $travel_tips = get_post_meta(get_the_ID(), '_tc_travel_tips', true);

                if ($location || $duration || $best_time || $travel_tips) : ?>
                    <div class="bg-offWhite shadow-md p-6 rounded-lg mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <?php if ($location) : ?>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-map-marker-alt text-2xl text-mutedPink"></i>
                                    <div>
                                        <div class="font-recoleta text-darkBrown">Location</div>
                                        <div class="font-dmsans text-slateGray"><?php echo esc_html($location); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($duration) : ?>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-clock text-2xl text-mutedPink"></i>
                                    <div>
                                        <div class="font-recoleta text-darkBrown">Duration</div>
                                        <div class="font-dmsans text-slateGray"><?php echo esc_html($duration); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($best_time) : ?>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-calendar-alt text-2xl text-mutedPink"></i>
                                    <div>
                                        <div class="font-recoleta text-darkBrown">Best Time to Visit</div>
                                        <div class="font-dmsans text-slateGray"><?php echo esc_html($best_time); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($travel_tips) : ?>
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Travel Tips</h3>
                                <div class="space-y-2 font-dmsans text-slateGray">
                                    <?php echo wp_kses_post(nl2br($travel_tips)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif;

            // Review-specific meta
            elseif ($is_review) :
                $rating = get_post_meta(get_the_ID(), '_tc_rating', true);
                $price_range = get_post_meta(get_the_ID(), '_tc_price_range', true);
                $pros = get_post_meta(get_the_ID(), '_tc_pros', true);
                $cons = get_post_meta(get_the_ID(), '_tc_cons', true);

                if ($rating || $price_range || $pros || $cons) : ?>
                    <div class="bg-offWhite shadow-md p-6 rounded-lg mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <?php if ($rating) : ?>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-star text-2xl text-mutedPink"></i>
                                    <div>
                                        <div class="font-recoleta text-darkBrown">Rating</div>
                                        <div class="font-dmsans text-slateGray"><?php echo esc_html($rating); ?> / 5</div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($price_range) : ?>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-dollar-sign text-2xl text-mutedPink"></i>
                                    <div>
                                        <div class="font-recoleta text-darkBrown">Price Range</div>
                                        <div class="font-dmsans text-slateGray"><?php echo esc_html($price_range); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <?php if ($pros) : ?>
                                <div>
                                    <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Pros</h3>
                                    <div class="space-y-2 font-dmsans text-slateGray">
                                        <?php echo wp_kses_post(nl2br($pros)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($cons) : ?>
                                <div>
                                    <h3 class="text-2xl font-recoleta text-darkBrown mb-4">Cons</h3>
                                    <div class="space-y-2 font-dmsans text-slateGray">
                                        <?php echo wp_kses_post(nl2br($cons)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif;
            endif; ?>

            <div class="prose prose-lg max-w-none font-dmsans text-darkBrown">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
