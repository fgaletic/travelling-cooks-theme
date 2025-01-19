<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="bg-lightWhite shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="flex items-center gap-2">
                <div class="w-6 h-6 bg-redOrange rounded-full"></div>
                <span class="text-[28px] font-bold font-sen leading-none tracking-[-0.04em] lowercase text-redOrange">
                    Travelling Cooks
                </span>
            </a>
            <!-- Navigation -->
            <nav class="flex space-x-8 font-outfit text-lg text-darkGray">
                <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex space-x-8',
                'fallback_cb' => false
            ));
            ?>
            </nav>
        </div>
    </header>