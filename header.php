<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/app.js?ver=<?php echo time(); ?>"></script>
</head>

<body <?php body_class(); ?>>

    <header class="header fixed top-0 left-0 w-full bg-white shadow-md z-50 transition-all duration-300">
        <div class="header-container">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="flex items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/travelling-cooks-logo.svg'"
                    alt="Travelling Cooks Logo"
                    class="logo-img w-16 h-16 md:w-32 md:h-32 flex-shrink-0 transition-all duration-300">
                <span
                    class="logo-text -ml-5 text-[64px] md:text-[84px] font-buffalo leading-none text-center tracking-[-0.02em] text-mutedPink transition-all duration-300">
                    Travelling Cooks
                </span>
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button id="primary-menu-toggle"
                class="text-gray-800 focus:outline-none absolute right-4 top-4 md:hidden z-50">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden md:block text-darkBrown">
                <?php wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav-menu flex space-x-6',
                'fallback_cb' => false,
            ]); ?>
            </nav>
        </div>

        <!-- Mobile Navigation (Hidden by Default) -->
        <div id="mobile-menu"
            class="hidden md:hidden font-dmsans absolute top-16 left-0 w-full bg-white shadow-md p-6 z-40">
            <?php wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'flex flex-col space-y-4 text-lg',
            'fallback_cb' => false,
        ]); ?>
        </div>
    </header>