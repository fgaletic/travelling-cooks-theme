<?php get_header(); ?>

<section class="intro-section bg-offWhite px-6 py-12 text-center">
    <div class="max-w-screen-md mx-auto">
        <h1 class="text-[64px] md:text-[48px] sm:text-[36px] font-recoleta text-darkBrown">
            Travelling Cooks
        </h1>
        <p class="text-lg sm:text-base font-montserrat text-darkBrown mt-4">
            Welcome to my world of travel and food, where I navigate this exciting chapter of my life in my fabulous 50ish ++
        </p>
    </div>
</section>

<section class="latest-posts px-6 py-12">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl text-slateGray font-bold font-recoleta">This Month's Featured Posts</h2>
    </div>
    <div class="blog-preview grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/ekstedt-london.png" alt="Ekstedt at the Yard" class="w-full h-48 object-cover rounded-lg">
                <div>
                    <p class="text-sm text-mutedPink font-medium font-montserrat">Food, Travel</p>
                    <h3 class="text-lg font-bold text-darkBrown font-montserrat">Amazing Scandinavian restaurant by Swedish Chef Niklas Ekstedt in London.</h3>
                </div>
            </a>
        </article>
        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/kyoto-trip.png" alt="Kyoto Trip" class="w-full h-48 object-cover rounded-lg">
                <div>
                    <p class="text-sm text-mutedPink font-medium font-montserrat">Travel, Culture</p>
                    <h3 class="text-lg font-bold text-darkBrown font-montserrat">5 Days in Kyoto - A Must Visit Destination</h3>
                </div>
            </a>
        </article>
        <article>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Articles/blueberry-muffins.png" alt="Blueberry Muffins" class="w-full h-48 object-cover rounded-lg">
                <div>
                    <p class="text-sm text-mutedPink font-medium font-montserrat">Recipes, Desserts</p>
                    <h3 class="text-lg font-bold text-darkBrown font-montserrat">Yummy and Fruity Blueberry Muffins</h3>
                </div>
            </a>
        </article>
    </div>
</section>

<section class="destinations px-6 py-12">
    <h2 class="text-2xl font-bold font-recoleta text-center mb-6">Where to next?</h2>
    <div class="flex overflow-x-auto space-x-4 p-4">
        <button class="destination-tag">Japan</button>
        <button class="destination-tag">Italy</button>
        <button class="destination-tag">Thailand</button>
        <button class="destination-tag">Mexico</button>
        <button class="destination-tag">Portugal</button>
        <button class="destination-tag">Greece</button>
        <button class="destination-tag">Costa Rica</button>
        <button class="destination-tag">Bali</button>
        <button class="destination-tag">Sri Lanka</button>
    </div>
</section>

<?php get_footer(); ?>
