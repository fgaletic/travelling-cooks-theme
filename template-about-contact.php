<?php
/*
Template Name: About/Contact Page
*/
get_header();
?>

<main class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <?php if (is_page('contact-us')) : ?>
            <!-- Contact Us: Title & placeholder text on left, Form on right -->
            <div class="prose prose-lg max-w-none font-dmsans text-darkBrown leading-relaxed">
                <h1 class="text-4xl font-recoleta text-darkBrown mb-4">Contact Us</h1>
                <p>Have a question? Feel free to reach out. We’d love to hear from you!</p>
                <p>Drop us a message and we’ll get back to you as soon as possible.</p>
            </div>
            <div class="bg-offWhite p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-recoleta text-darkBrown mb-4">Send a Message</h2>
                <form class="space-y-4">
                    <div>
                        <label for="name" class="block text-slateGray font-dmsans mb-1">Name</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink">
                    </div>
                    <div>
                        <label for="email" class="block text-slateGray font-dmsans mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink">
                    </div>
                    <div>
                        <label for="message" class="block text-slateGray font-dmsans mb-1">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink"></textarea>
                    </div>
                    <button type="submit" class="bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors">Send Message</button>
                </form>
            </div>
        <?php else : ?>
            <!-- About Us Page: Image on Left, Text on Right -->
            <div class="rounded-lg overflow-hidden shadow-lg self-start">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="w-full h-auto object-cover">
                <?php endif; ?>
            </div>
            <div class="prose prose-lg max-w-none font-dmsans text-darkBrown leading-relaxed self-start">
                <h1 class="text-4xl font-recoleta text-darkBrown mb-4 text-left">About Us</h1>
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
