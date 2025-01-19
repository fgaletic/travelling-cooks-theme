<?php get_header(); ?>

<div class="archive-container px-6 py-12">
    <h1 class="text-3xl font-bold mb-6">
        <?php single_cat_title('Category: '); ?>
    </h1>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-lg font-bold mt-2"><?php the_title(); ?></h3>
                            <p class="text-sm text-gray-500 mt-1"><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
