<?php
/*
Template Name: About/Contact Page
*/
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        <?php if (is_page('contact-us')): ?>
        <!-- Contact Us: Title & placeholder text on left, Form on right -->
        <div class="prose prose-lg max-w-none font-dmsans text-darkBrown leading-relaxed">
            <h1 class="text-4xl font-recoleta text-darkBrown mb-4">Contact Us</h1>
            <p>Have a question? Feel free to reach out. We’d love to hear from you!</p>
            <p>Drop us a message and we’ll get back to you as soon as possible.</p>
        </div>
        <div class="bg-offWhite p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-recoleta text-darkBrown mb-4">Send a Message</h2>
            <!-- Replace the Formspree endpoint below with your own Formspree form ID! -->
            <!-- See https://formspree.io/ for instructions. -->
            <form id="contactForm" method="POST" action="javascript:void(0);" class="space-y-4">
                <!-- 🛡️ Honeypot field -->
                <input type="text" name="_gotcha" class="hidden" style="display:none">
                <div id="formSuccess" class="hidden text-green-600 font-dmsans p-4 bg-green-100 rounded-lg shadow-sm">
                </div>

                <div>
                    <label for="name" class="block text-slateGray font-dmsans mb-1">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink" />
                </div>

                <div>
                    <label for="email" class="block text-slateGray font-dmsans mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink" />
                </div>

                <div>
                    <label for="message" class="block text-slateGray font-dmsans mb-1">Message</label>
                    <textarea id="message" name="message" rows="4" required
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-mutedPink"></textarea>
                </div>

                <button type="submit"
                    class="bg-mutedPink text-white font-dmsans py-2 px-4 rounded-lg hover:bg-orange-600 transition-colors">
                    Send Message
                </button>
            </form>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.getElementById("contactForm");
                const successMsg = document.getElementById("formSuccess");

                form.addEventListener("submit", async function(e) {
                    e.preventDefault();

                    const formData = new FormData(form);

                    try {
                        const res = await fetch("https://formspree.io/f/meogvoek", {
                            method: "POST",
                            body: formData,
                            headers: {
                                Accept: "application/json"
                            }
                        });

                        if (res.ok) {
                            successMsg.textContent = "Thanks! Your message was sent successfully.";
                            successMsg.classList.remove("hidden");
                            successMsg.classList.add("fade-in-up", "show");
                            form.reset();
                            successMsg.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        } else {
                            successMsg.textContent =
                                "Oops! Something went wrong. Please try again later.";
                            successMsg.classList.remove("hidden");
                            successMsg.classList.replace("text-green-600", "text-red-600");
                            successMsg.classList.replace("bg-green-100", "bg-red-100");
                            successMsg.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    } catch (err) {
                        successMsg.textContent = "Network error. Please try again later.";
                        successMsg.classList.remove("hidden");
                        successMsg.classList.replace("text-green-600", "text-red-600");
                        successMsg.classList.replace("bg-green-100", "bg-red-100");
                        successMsg.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            </script>

        </div>
        <?php else: ?>
        <!-- About Us Page: Image on Left, Text on Right -->
        <div class="rounded-lg overflow-hidden shadow-lg self-start">
            <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url(
                        'large'
                    ); ?>" alt="<?php the_title(); ?>" class="w-full h-auto object-cover">
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