<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="bg-white shadow-md">
            <div class="header-container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-4">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TC Logo.png" alt="Travelling Cooks Logo" class="w-20 h-20">
                <span class="text-[50px] font-bold font-satisfy leading-none tracking-[-0.02em] text-mutedPink">
                    Travelling Cooks
                </span>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 font-montserrat text-lg text-darkBrown">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex space-x-8',
                    'fallback_cb' => false
                ));
                ?>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button id="primary-menu-toggle" class="text-gray-800 md:hidden focus:outline-none">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>
