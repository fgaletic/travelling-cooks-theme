<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-recoleta text-darkBrown mb-4"><?php the_title(); ?></h1>
            <div class="mb-6 text-slateGray font-dmsans">
                <span>Published on <?php the_date(); ?></span>
                <span class="mx-2">|</span>
                <span>By <?php the_author(); ?></span>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
                </div>
            <?php endif; ?>
            <div class="prose prose-lg max-w-none font-dmsans text-darkBrown">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
