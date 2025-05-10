<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-recoleta text-darkBrown mb-8">
        <?php if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        } else {
            the_archive_title();
        } ?>
    </h1>

    <?php if (term_description()): ?>
        <div class="prose prose-lg max-w-none font-dmsans text-slateGray mb-12">
            <?php echo term_description(); ?>
        </div>
    <?php endif; ?>

    <!-- Grid Layout for Archive Posts -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if (has_post_thumbnail()): ?>
                    <div class="aspect-w-3 aspect-h-2 overflow-hidden">
                        <?php the_post_thumbnail('card-thumbnail', [
                            'class' => 'w-full h-full object-cover rounded-lg',
                            'loading' => 'lazy',
                        ]); ?>
                    </div>
                <?php endif; ?>
                <div class="p-6">
                    <!-- Category chips -->
                    <div class="flex flex-wrap gap-2 mb-3">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category):
                            if (
                                $category->parent != 0
                            ):// Only show subcategories
                                 ?>
                            <span class="inline-block px-2 py-1 text-xs font-dmsans bg-mutedPink bg-opacity-10 text-mutedPink rounded">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php endif;
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
                        $reading_time = ceil($word_count / 200);
                        echo sprintf(
                            _n(
                                '%d min read',
                                '%d min read',
                                $reading_time,
                                'travelling-cooks'
                            ),
                            $reading_time
                        );
                        ?>
                    </p>

                    <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" 
                       class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-opacity-90 transition-colors">
                        Read More
                    </a>
                </div>
            </article>
        <?php
            endwhile;
        else:
             ?>
            <p class="text-slateGray font-dmsans">No posts found.</p>
        <?php
        endif; ?>
    </div>

    <div class="mt-12">
        <?php the_posts_pagination([
            'prev_text' => '← Previous',
            'next_text' => 'Next →',
            'class' => 'pagination',
        ]); ?>
    </div>
</main>

<?php get_footer(); ?>
