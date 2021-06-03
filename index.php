<?php get_header(); ?>

<div class="container">
    <?php
    $sticky = get_option('sticky_posts');
    $query = new WP_Query('p=' . $sticky[0]);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
    ?>
            <a href="<?php the_permalink(); ?>"><?php the_title('<h1>', '</h1>'); ?> </a>
    <?php
        endwhile;
    endif;
    ?>
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
    ?>
            <a href="<?php the_permalink(); ?>"><?php the_title('<h3 class="my-2 text-primary">', '</h3>'); ?></a>
            <p>
                <?php the_content('[Read more]', false); ?>
            </p>
    <?php
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>
