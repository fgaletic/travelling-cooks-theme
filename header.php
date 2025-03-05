<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="bg-white shadow-md centered-div">
        <div class="header-container">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TC Logo.png" alt="Travelling Cooks Logo" class="w-40 h-40">
                <span class="text-[100px] font-buffalo leading-none tracking-[-0.02em] text-mutedPink">
                    Travelling Cooks
                </span>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:block text-darkBrown">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-menu',
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
