<?php get_header(); ?>

<div class="container">
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
