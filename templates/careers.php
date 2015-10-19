<?php
/**
* Template Name: Careers
*/
get_header(); 

?>

<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active"><?php echo the_title() ?></a></li>
          <li class="right"></li>
        </ul>
        <?php
    // Start the loop.
    while ( have_posts() ) : the_post();
      /*
       * Include the post format-specific template for the content. If you want to
       * use this in a child theme, then include a file called called content-___.php
       * (where ___ is the post format) and that will be used instead.
       */
      the_content();
    // End the loop.
    endwhile;
    ?>
    </div>
</div>

<?php get_footer(); ?>
