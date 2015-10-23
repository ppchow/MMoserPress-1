<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage mmoser
 * @since mmoser
 */
get_header();

if(pll_current_language()=="en"){
  $goback_link = "/services/";
}else{
  $goback_link = "/cn/services/";
}


?>
<div class="row">
    <div class="large-12 columns">
        <ul class="tabs-mm">
          <li><a href="<?php echo get_permalink(); ?>" class="active"><?php the_title() ?></a></li>
         <!-- <li class="right"> <a href="<?php echo get_site_url().$goback_link; ?>">&larr; back </a></li> -->
         <li class="single-languagelink right">
			<?php dynamic_sidebar("header-sidebar-1"); ?>
		</li>
        </ul>
        <article class="post">
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
		</article>
    </div>
</div>
<?php get_footer(); ?>
<?php get_footer(); ?>