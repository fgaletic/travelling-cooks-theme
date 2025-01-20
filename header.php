<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="bg-lightWhite shadow-md">
            <div class="header-container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-4">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.svg" alt="Travelling Cooks Logo" class="w-8 h-8">
                <span class="text-[32px] font-bold font-sen leading-none tracking-[-0.02em] text-redOrange">
                    Travelling Cooks
                </span>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 font-outfit text-lg text-darkGray">
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
