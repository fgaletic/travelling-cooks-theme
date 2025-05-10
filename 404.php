<?php get_header(); ?>

<section class="py-6 md:py-12 lg:py-16 text-center">
    <div class="max-w-lg mx-auto">
        <h1 class="text-4xl font-recoleta text-darkBrown mb-4">Oops!</h1>
        <p class="text-base font-dmsans text-slateGray mb-4">
            <?php _e('The page you are looking for doesn’t exist or has been moved.', 'travelling-cooks'); ?>
        </p>
        <a href="<?php echo home_url(); ?>" class="inline-block bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-darkBrown transition-colors">
            <?php _e('Back to Home', 'travelling-cooks'); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>