<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- TWO-PART HEADER -->
    <header class="womenfirst-header">
        <!-- Main Header -->
        <div class="main-header">
            <div class="header-container">
                <!-- Logo -->
                <div class="logo">
                    <?php if (has_custom_logo()): ?>
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                            <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="custom-logo">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">The Women First</a>
                    <?php endif; ?>
                </div>

                <!-- Main Navigation -->
                <nav class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'menu_class' => 'main-nav',
                        'container' => false,
                        'fallback_cb' => false
                    ));
                    ?>
                </nav>

                <!-- Shop Button -->
                <div class="header-actions">
                    <a href="/shop" class="shop-button">SHOP</a>
                </div>
            </div>
        </div>

        <!-- Sub Header - 6 Category Buttons -->
        <div class="sub-header">
            <div class="sub-header-container">
                <nav class="category-navigation">
                    <?php
                    if (has_nav_menu('category-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'category-menu',
                            'menu_class' => 'category-nav',
                            'container' => false
                        ));
                    } else {
                        womenfirst_category_fallback_menu();
                    }
                    ?>
                </nav>
            </div>
        </div>
    </header>

    <main class="site-content">