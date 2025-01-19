<?php get_header(); ?>

<div class="page-content px-6 py-12">
    <?php
    while (have_posts()) : the_post();
    ?>
    <article class="prose max-w-none">
        <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
        <div class="mt-6">
            <?php the_content(); ?>
        </div>
    </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
