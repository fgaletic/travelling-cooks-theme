<?php get_header(); ?>

<section class="intro-section bg-offWhite px-6 py-12 text-center">
    <div class="max-w-screen-xl mx-auto min-h-[30vh] flex flex-col justify-center items-center">
        <h1 class="text-[48px] md:text-[64px] sm:text-[36px] font-recoleta text-darkBrown">
            Welcome to my world of travel and food
        </h1>
        <p class="text-lg sm:text-xl font-dmsans text-darkBrown mt-4">
            ..where I navigate this exciting chapter of my life in my fabulous 50ish ++
        </p>
    </div>
</section>

<section class="latest-posts px-6 py-12">
    <div class="flex justify-center items-center">
        <h2 class="text-3xl text-slateGray font-bold font-recoleta">This Month's Featured Posts</h2>
    </div>
    <div class="blog-preview grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        <article class="text-center flex flex-col items-center">
            <a href="#" class="group w-full">
                <div class="image-container mb-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/northern-lights.png" alt="Ekstedt at the Yard" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-mutedPink font-medium font-recoleta">Food, Travel</p>
                    <h3 class="text-lg font-bold text-darkBrown font-recoleta">Amazing Scandinavian restaurant by Swedish Chef Niklas Ekstedt in London</h3>
                </div>
            </a>
        </article>
        <article class="text-center flex flex-col items-center">
            <a href="#" class="group w-full">
                <div class="image-container mb-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/japanese-temple.png" alt="Kyoto Trip" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-mutedPink font-medium font-recoleta">Travel, Culture</p>
                    <h3 class="text-lg font-bold text-darkBrown font-recoleta">5 Days in Kyoto - A Must Visit Destination</h3>
                </div>
            </a>
        </article>
        <article class="text-center flex flex-col items-center">
            <a href="#" class="group w-full">
                <div class="image-container mb-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/PNG/fruit-bowl.png" alt="Blueberry Muffins" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-mutedPink font-medium font-recoleta">Recipes, Desserts</p>
                    <h3 class="text-lg font-bold text-darkBrown font-recoleta">Yummy and Fruity Blueberry Muffins</h3>
                </div>
            </a>
        </article>
    </div>
</section>

<section class="destinations px-6 py-12 min-h-[30vh]">
    <div class="max-w-screen-xl mx-auto">
        <h2 class="text-5xl font-recoleta text-center mb-6">Where to next?</h2>
        <div class="flex justify-center items-center mx-auto gap-3">
            <button class="destination-chip">
                <i class="fas fa-torii-gate"></i>
                <span>Japan</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-pizza-slice"></i>
                <span>Italy</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-landmark"></i>
                <span>United Kingdom</span>
            </button>
            <button class="destination-chip">
                <i class="fas fa-beer"></i>
                <span>Belgium</span>
            </button>
        </div>
    </div>
</section>

<?php get_footer(); ?>
