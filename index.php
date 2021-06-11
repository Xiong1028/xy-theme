<?php get_header(); ?>

<div class="container">
  <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
      <div>
            <?php the_content('[Read more]', false); ?>
      </div>
            <?php
        endwhile;
    endif;
    ?>
</div>

<<<<<<< HEAD

=======
>>>>>>> 023450a142e581160a9fe9b4f3ec8d1aa9782fc6

<?php get_footer(); ?>
