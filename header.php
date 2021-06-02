<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div>
        <header>
            <nav class="bg-secondary navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand px-3" href="#">
                    <img src="<?php echo get_theme_root_uri() . "/xy-theme/images/haha-logo.png"; ?>" width="100" alt="haha">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                $nav_list = get_terms('nav_menu')
                ?>
            </nav>
        </header>
        <div>
            <?php 
            if(function_exists('the_custom_logo')) :
                the_custom_logo();
            endif;
            ?>
    </div>
        <?php 
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            
        if(has_custom_logo()) :
            echo '<img width="50" src="'.esc_url($logo[0]).'" alt="'.get_bloginfo('name').'">';
            else:
                echo '<h1>'.get_bloginfo('name').'</h1>';    
            endif;
            ?>
