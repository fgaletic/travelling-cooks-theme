<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-recoleta text-darkBrown mb-8">Blog</h1>

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
                    <h2 class="text-2xl font-recoleta text-darkBrown mb-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="text-slateGray font-dmsans mb-4"><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-darkBrown transition-colors">Read More</a>
                </div>
            </article>
        <?php
            endwhile;
        else:
             ?>
            <p>No posts available.</p>
        <?php
        endif; ?>
    </div>

    <div class="mt-12">
        <?php the_posts_pagination(); ?>
    </div>
</main>

<?php get_footer(); ?>
